@extends('app.layout',['active_menu'=>'drivers_management','active_menu_list'=>'create'])

@section('custom-css')
<link rel="stylesheet" href="{{ asset("modules/bootstrap-daterangepicker/daterangepicker.css") }}">
@endsection

@section('content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>New Driver</h1>
        </div>
        {{-- <p class="section-lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur ex deleniti ipsam esse, facere, ratione saepe tempore explicabo officiis ab fuga minima corrupti vero, amet est dolorum unde maxime fugit!</p> --}}
        <div class="section-body">
        	<div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Driver Form</h4>
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
                            <form action="{{ route('driver_create') }}" method="POST">
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
                                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}">
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
                                    <label>Joined At</label>
                                    <input type="text" class="form-control" id="joined_at" name="joined_at" value="{{ old('joined_at') }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Submit
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
    $('#dob,#joined_at,#left_at').daterangepicker({
        format:"yyyy-mm-dd",
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
        autoUpdateInput:false
    });

    $('#dob').change(function(event) {
        
        var start = moment($(this).val());
        var end = moment(new Date());        
        var duration = moment.duration(end.diff(start));
        var years = duration.asYears();

        $('#age').val(Math.floor(years)+" years old");
    });
</script>
@endsection
