<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Entity\Driver;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class DriverDatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('drivers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'nickname' => 'required',
            'code' => 'required|unique:dummy_driver,drv_code',
            'dob' => 'required',
        ],[
            'dob.required' => 'The date of birth field is required',
        ]);

        $driver = new Driver();
        $driver->drv_name = $request->name;
        $driver->drv_nickname = $request->nickname;
        $driver->drv_code = $request->code;
        $driver->drv_dob = date('Y-m-d',strtotime($request->dob));

        $driver->save();

        session()->flash('success', 'New driver successfully created.');
        return redirect()->route('driver_lists');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            
            $driver = Driver::findOrFail($id);

            if ($driver->drv_lefton=="0000-00-00 00:00:00" || $driver->drv_lefton==null){

                $duration = Carbon::parse(date("Y-m-d",strtotime($driver->drv_joinon)))->diffForHumans(date('Y-m-d'));
            } else {
                
                $duration = Carbon::parse(date("Y-m-d",strtotime($driver->drv_lefton)))->diffForHumans(date("Y-m-d",strtotime($driver->drv_joinon)));
            }

            $driver->duration_with_company = $duration;

            return response()->json([
                'status' => true,
                'data' => $driver
            ],Response::HTTP_OK);

        } catch (ModelNotFoundException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Record not found.'
            ],Response::HTTP_NOT_FOUND);

        } catch (Exception $e) {
            
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            
            $driver = Driver::findOrFail($id);

            return view('drivers.edit',[
                'driver' => $driver
            ]);

        } catch (ModelNotFoundException $e) {

            session()->flash('error', $e->getMessage());
            return redirect()->route('driver_lists');

        } catch (Exception $e) {
            
            session()->flash('error', $e->getMessage());
            return redirect()->route('driver_lists');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'nickname' => 'required',
            'drv_code' => [
                'required',
                Rule::unique('dummy_driver')->where(function($query) use($id,$request) {
                    $query->where('id', '!=', $id)
                    ->where('drv_code',$request->code);
                })
            ],
            'dob' => 'required|date',
        ],[
            'dob.required' => 'The date of birth field is required',
        ]);

        try {
            
            $driver = Driver::findOrFail($id);
            $driver->drv_name = $request->name;
            $driver->drv_nickname = $request->nickname;
            $driver->drv_code = $request->drv_code;
            $driver->drv_dob = date('Y-m-d',strtotime($request->dob));
            $driver->drv_position = $request->position;
            $driver->drv_vehiclecode = $request->vehicle_code;
            $driver->drv_joinon = date('Y-m-d',strtotime($request->joined_at));
            $driver->drv_lefton = date('Y-m-d',strtotime($request->left_at));

            $driver->save();

            session()->flash('success', 'Driver successfully updated.');
            return redirect()->route('driver_lists',['rowid' => $request->previous_table_page]);

        } catch (ModelNotFoundException $e) {

            session()->flash('error', $e->getMessage());
            return redirect()->route('driver_edit');
            
        } catch (Exception $e) {
            
            session()->flash('error', $e->getMessage());
            return redirect()->route('driver_edit');
        }
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return Datatables::of(Driver::query())
        ->addColumn('join_at', function ($driver) {
            
            if ($driver->drv_joinon=="0000-00-00 00:00:00" || $driver->drv_joinon=="1970-01-01 00:00:00") {
                
                return " - ";
            }
            else {

                return date('Y-m-d',strtotime($driver->drv_joinon));
            }
        })
        ->addColumn('dob', function ($driver) {
            
            if ($driver->drv_dob=="0000-00-00") {
                
                return " - ";
            }
            else {

                return $driver->drv_dob." | ".Carbon::parse($driver->drv_dob)->diffInYears(date('Y-m-d'))." years old";
            }
        })
        ->addColumn('action', function ($driver) {
            return '
            <a href="'.route('driver_edit',[$driver->id]).'" class="btn btn-info"><i class="fas fa fa-edit"></i> Edit</a>
            <a href="javascript:;" class="btn btn-info" onclick="showModalAndDriverDetails('.$driver->id.')"><i class="fas fa fa-search-plus"></i> View</a>
            ';
        })
        ->make(true);
    }
}
