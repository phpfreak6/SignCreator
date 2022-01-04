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
                    {{ title_case($module_name) }} Management Dashboard
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

        <div class="row mt-4">
            <div class="col">
                <form method="post" action="{{ route('backend.artwork.update') }}" class="form-horizontal" role="form">
                    {!! csrf_field() !!}
					<input type="hidden" value="{{ $artwork->id }}" name="id">
					<div class="card card-accent-primary">
						<div class="card-header">
							<i class="fas fa-pen"></i>
							Edit template
						</div>
						<div class="card-body">
							<div class="form-group row">
								<label class="col-md-2 form-control-label" for="nickname">Nickname</label>
								<div class="col-md-10">
									<input class="form-control" type="text" name="nickname" id="nickname" value="{{ $artwork->nickname }}" placeholder="Nickname" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 form-control-label" for="name">Name</label>
								<div class="col-md-10">
									<input class="form-control" type="text" name="name" id="name" placeholder="Name" value="{{ $artwork->name }}" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 form-control-label" for="pdf_width">PDF Width (mm)</label>
								<div class="col-md-10">
									<input class="form-control" type="number" name="pdf_width" id="pdf_width" placeholder="Width" value="{{ $artwork->pdf_width }}" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 form-control-label" for="pdf_height">PDF Height (mm)</label>
								<div class="col-md-10">
									<input class="form-control" type="number" name="pdf_height" id="pdf_height" placeholder="Height" value="{{ $artwork->pdf_height }}" required="">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-2 form-control-label" for="template_width">Template Width (px)</label>
								<div class="col-md-10">
									<input class="form-control" type="number" name="template_width" id="template_width" placeholder="Width" value="{{ $artwork->template_width }}" required="">
								</div>
							</div>
						</div>
					</div>

                    <div class="row m-b-md">
                        <div class="col-md-12">
                            <button class="btn-primary btn">
                                <i class='fas fa-save'></i> Update
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
    </div>
</div>
@stop
