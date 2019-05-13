@extends('app.layout',['active_menu'=>'drivers_management','active_menu_list'=>'lists'])

@section('custom-css')
<link rel="stylesheet" href="{{ asset("modules/datatables/datatables.min.css") }}">
<link rel="stylesheet" href="{{ asset("modules/datatables/Responsive-2.2.1/css/responsive.bootstrap4.min.css") }}">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Driver Lists</h1>
        </div>
        <div class="section-body">
        	<div class="card">
                <div class="card-header">
                    {{-- <h4>{{ __('product.lists.title') }}</h4> --}}
                    <a href="{{ route('driver_create') }}" class="btn btn-primary">
                        Add new
                    </a>
                </div>
                <div class="card-body">
                	<div class="table-responsive">
                		<table class="table table-striped table-md" id="driver_lists_table">
                			<thead>
                				<tr>
                					<th>#</th>
                					<th>Name</th>
                					{{-- <th>Nickname</th> --}}
                					<th>Code</th>
                					{{-- <th>Position</th> --}}
                					{{-- <th>Vehicle Code</th> --}}
                					<th>DOB</th>
                					<th>Joined At</th>
                					{{-- <th>Left At</th> --}}
                					<th>Action</th>
                				</tr>
                			</thead>
                			<tbody>
                			</tbody>
                		</table>
                	</div>
                </div>
			</div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="viewDriverDetails">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Driver Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Details for : <span id="driver_name"> - </span>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Nickname</td>
                                <td id="driver_nickname"> - </td>
                            </tr>
                            <tr>
                                <td>Position</td>
                                <td id="driver_position"> - </td>
                            </tr>
                            <tr>
                                <td>Vehicle code</td>
                                <td id="driver_vehicle_code"> - </td>
                            </tr>
                            <tr>
                                <td>Left at</td>
                                <td id="driver_left_at"> - </td>
                            </tr>
                            <tr>
                                <td>Duration with company</td>
                                <td id="duration_with_company"> - </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" onclick="resetModalTableAndClose()">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="{{ asset("modules/datatables/datatables.min.js") }}"></script>
<script src="{{ asset("modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js") }}"></script>

<script>

    
	var table = $('#driver_lists_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('driver_anydata') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'drv_name', name: 'drv_name' },
            // { data: 'drv_nickname', name: 'drv_nickname' },
            { data: 'drv_code', name: 'drv_code' },
            // { data: 'drv_position', name: 'drv_position' },
            // { data: 'drv_vehiclecode', name: 'drv_vehiclecode' },
            { data: 'dob', name: 'dob', width: "20%" },
            { data: 'join_at', name: 'join_at' },
            // { data: 'left_at', name: 'left_at' },
            { data: 'action', name: 'action' },
        ]
    });


    @if (request()->rowid)
        
        localStorage.setItem('previous_table_page',{{ request()->rowid }});

        $('#driver_lists_table').on('init.dt', function(event) {
            
            setTimeout(function(){

                $('a[data-dt-idx={{ request()->rowid }}]').trigger('click');
            },100);
            
        });
    @else
        localStorage.setItem('previous_table_page',1);
    @endif

    $('#driver_lists_table').on('page.dt', function(event) {
        
        var info = table.page.info();
        localStorage.setItem('previous_table_page',(info.page+1));
    });

    function showModalAndDriverDetails(id) {

        Http.get('drivers/'+id+'/view',{},function(response) {

            l(response);
            
            $('#driver_name').html(response.data.drv_name);
            $('#driver_nickname').html(response.data.drv_nickname);
            $('#driver_position').html(response.data.drv_position);
            $('#driver_vehicle_code').html(response.data.drv_vehiclecode);
            $('#driver_left_at').html((response.data.drv_lefton==null || response.data.drv_lefton=="0000-00-00 00:00:00" ? "-" : response.data.drv_lefton));
            $('#duration_with_company').html(response.data.duration_with_company);
            
            $('#viewDriverDetails').modal('show');

        },function(error) {
            
            alert(error.responseJSON.message);
            l(error);
        });
    }
    function resetModalTableAndClose() {
        
        $('#driver_name,#driver_nickname,#driver_position,#driver_vehicle_code,#driver_left_at,#duration_with_company').html(' - ');
        $('#viewDriverDetails').modal('hide');
    }
</script>
@endsection
