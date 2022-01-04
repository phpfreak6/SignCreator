@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.dashboard')!!}"><i class="icon-speedometer"></i> Dashboard</a></li>
<li class="breadcrumb-item active"><i class="{{ $module_icon }}"></i> {{ $module_title }}</li>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">{{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ title_case($module_name) }} Management
                </div>
            </div>
            <!--/.col-->
            <div class="col-4">
                <div class="float-right">
                    <div class="btn-group" role="group" aria-label="Toolbar button groups">

                    </div>
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->
        <div class="row mt-4 custom_artwork_temp">
            <div class="col">
                 <div class="card card-accent-primary">
					<div class="card-header">
						<i class="fa fa-edit"></i>
						Update Job User
					</div>
					<div class="card-body">	
						<form method="post" action="{{ route('backend.jobs.import-jobs') }}" class="form-horizontal" role="form" enctype="multipart/form-data">
							{!! csrf_field() !!}					
							<div class="row">
								<div class="col">
									<div class="form-group ">
										<label for="meta_site_name"> <strong>Upload CSV file</label>
										<input type="file" name="import_file"  class="form-control" id="import_file" accept=".csv" >
									</div>
								</div>						 
							</div>
							<div class="row m-b-md">
								<div class="col-md-12">
									<button class="btn-primary btn">
										<i class="fas fa-save"></i> Upload
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	
@stop
