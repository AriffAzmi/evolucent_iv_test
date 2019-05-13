@extends('app.layout',['active_menu'=>'drivers_management','active_menu_list'=>'create'])

@section('custom-css')
<link rel="stylesheet" href="{{ asset("modules/bootstrap-daterangepicker/daterangepicker.css") }}">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Driver</h1>
        </div>
        {{-- <p class="section-lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur ex deleniti ipsam esse, facere, ratione saepe tempore explicabo officiis ab fuga minima corrupti vero, amet est dolorum unde maxime fugit!</p> --}}
        <div class="section-body">
        	<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Driver Form</h4>
                        </div>
                        <div class="card-body">
                            @if (session('error') || count($errors) > 0)
                            <div class="alert alert-danger error-div">
                                @if (session('error'))

                                    {{ session('error') }}
                                @else
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            @endif
                            <form action="{{ route('driver_edit',[$driver->id]) }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>Name <span class="text-danger">(as in NRIC)</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nickname</label>
                                            <input type="text" class="form-control" id="nickname" name="nickname" value="{{ old('nickname') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Code</label>
                                            <input type="text" class="form-control" id="drv_code" name="drv_code" value="{{ old('code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Position</label>
                                            <select name="position" id="position" class="form-control">
                                                <option value="LIMO DRIVER">LIMO DRIVER</option>
                                                <option value="TAXI DRIVER">TAXI DRIVER</option>
                                                <option value="VAN DRIVER">VAN DRIVER</option>
                                                <option value="TAXI BACKUP">TAXI BACKUP</option>
                                                <option value="ALPHARD DRIVER">ALPHARD DRIVER</option>
                                                <option value="BUDGET LIMO">BUDGET LIMO</option>
                                                <option value="SHUTTLE DRIVER">SHUTTLE DRIVER</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Vehicle Code</label>
                                            <input type="text" class="form-control" id="vehicle_code" name="vehicle_code" value="{{ old('vehicle_code') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Date of Birth</label>
                                            <input type="text" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Age</label>
                                            <input type="text" class="form-control" id="age" name="age" value="{{ old('age') }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Joined At</label>
                                            <input type="text" class="form-control" id="joined_at" name="joined_at" value="{{ old('joined_at') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Left At</label>
                                            <input type="text" class="form-control" id="left_at" name="left_at" value="{{ old('left_at') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Duration</label>
                                            <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="previous_table_page" id="previous_table_page">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-info btn-lg" onclick="backToList()">
                                        Back
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
        </div>
    </section>
</div>
@endsection

@section('custom-js')
<script src="{{ asset("modules/bootstrap-daterangepicker/daterangepicker.js") }}"></script>
<script>

    $('#name').val('{{ $driver->drv_name }}');
    $('#nickname').val('{{ $driver->drv_nickname }}');
    $('#drv_code').val('{{ $driver->drv_code }}');
    $('#position').val('{{ $driver->drv_position }}');
    $('#vehicle_code').val('{{ $driver->drv_vehiclecode }}');

    @if ($driver->drv_dob=="0000-00-00")
        
        $('#dob').val('');
    @else
        $('#dob').val('{{ $driver->drv_dob }}');
        getAge();
    @endif


    @if ($driver->drv_joinon=="0000-00-00 00:00:00" || $driver->drv_joinon==null)
    
        $('#joined_at').val('');
    @else
        $('#joined_at').val('{{ date('Y-m-d',strtotime($driver->drv_joinon)) }}');
    @endif

    @if ($driver->drv_lefton=="0000-00-00 00:00:00" || $driver->drv_lefton==null)
        $('#left_at').val('');
    @else
        $('#left_at').val('{{ date('Y-m-d',strtotime($driver->drv_lefton)) }}');
    @endif

    @if ($driver->drv_lefton=="0000-00-00 00:00:00" || $driver->drv_lefton==null)

        $('#duration').val('{{ \Carbon\Carbon::parse(date("Y-m-d",strtotime($driver->drv_joinon)))->diffForHumans(date('Y-m-d')) }}');
    @else
        
        $('#duration').val('{{ \Carbon\Carbon::parse(date("Y-m-d",strtotime($driver->drv_lefton)))->diffForHumans(date("Y-m-d",strtotime($driver->drv_joinon))) }}');
    @endif

    $('#previous_table_page').val(localStorage.getItem('previous_table_page'));

    $('#dob').daterangepicker({
        format:"yyyy-mm-dd",
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
        autoUpdateInput:false
    }, function(chosen_date) {
        $('#dob').val(chosen_date.format('YYYY-MM-DD'));
    });

    $('#joined_at').daterangepicker({
        format:"yyyy-mm-dd",
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
        autoUpdateInput:false
    }, function(chosen_date) {
        $('#joined_at').val(chosen_date.format('YYYY-MM-DD'));
    });

    $('#left_at').daterangepicker({
        format:"yyyy-mm-dd",
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
        autoUpdateInput:false
    }, function(chosen_date) {
        $('#left_at').val(chosen_date.format('YYYY-MM-DD'));
    });

    $('#dob').change(function(event) {
        
        var start = moment($(this).val());
        var end = moment(new Date());        
        var duration = moment.duration(end.diff(start));
        var years = duration.asYears();

        $('#age').val(Math.floor(years)+" years old");
    });

    function getAge() {
        
        var start = moment($('#dob').val());
        var end = moment(new Date());        
        var duration = moment.duration(end.diff(start));
        var years = duration.asYears();

        $('#age').val(Math.floor(years)+" years old");
    }

    function backToList() {

        location.href='{{ route('driver_lists') }}?rowid='+localStorage.getItem('previous_table_page');
    }
</script>
@endsection
