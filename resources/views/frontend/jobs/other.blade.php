@extends('frontend.layouts.app')

@section('title')
Job Edit
@stop
@section('content')

<div class="content-page">
    <div class="page-header-image" data-parallax="true">
    </div>
    <div class="content-center">
        <div class="container">
           @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			 {{ html()->modelForm($job, 'POST', url('othertask',$job->id))->class('form-horizontal')->open() }}
                    <div class="form-group row">
                        {{ html()->label(__('jobs.property_address'))->class('col-md-4 form-control-label')->for('property_address') }}
                        <div class="col-md-8">
                            {{ html()->textarea('pro_address')
                                ->class('form-control')
                                ->placeholder(__('jobs.property_address'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div><!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('jobs.property_type'))->class('col-md-4 form-control-label')->for('property_type') }}
                        <div class="col-md-8">
                           	{{ html()->select('pro_type', Config::get('constant.prop_type'))
							->placeholder(__('jobs.property_type'))
							->class('form-control select2')
							->required() }}
                        </div>
                    </div><!--form-group-->
					
					<div class="form-group row">
                        {{ html()->label(__('jobs.sign_type'))->class('col-md-4 form-control-label')->for('sign_type') }}
                        <div class="col-md-8">
                           	{{ html()->select('sign_type', Config::get('constant.sign_type'))
							->placeholder(__('jobs.sign_type'))
							->class('form-control select2')
							->required() }}
                        </div>
                    </div><!--form-group-->
					
					<div class="form-group row">
                        {{ html()->label(__('jobs.size'))->class('col-md-4 form-control-label')->for('size') }}
                        <div class="col-md-8">
                           	{{ html()->select('size', Config::get('constant.size'))
							->placeholder(__('jobs.size'))
							->class('form-control')
							->required() }}
                        </div>
                    </div><!--form-group-->
					
					<div class="form-group row">
                        {{ html()->label(__('jobs.orientation'))->class('col-md-4 form-control-label')->for('orientation') }}
                        <div class="col-md-8">
                           	{{ html()->select('orientation', Config::get('constant.orientation'))
							->placeholder(__('jobs.orientation'))
							->class('form-control')
							->required() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.listing_type'))->class('col-md-4 form-control-label')->for('listing_type') }}
                        <div class="col-md-8">
                           	{{ html()->select('listing_type', Config::get('constant.listing_type'))
							->placeholder(__('jobs.listing_type'))
							->class('form-control')
							->required() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.quantity'))->class('col-md-4 form-control-label')->for('quantity') }}
                        <div class="col-md-8">
                           	{{ html()->text('quantity')
							->placeholder(__('jobs.quantity'))
							->class('form-control')
							->required()->readonly() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.v_board'))->class('col-md-4 form-control-label')->for('v_board') }}
                        <div class="col-md-8">
                           	{{ html()->select('v_board', Config::get('constant.v_board'))
							->placeholder('V Board')
							->class('form-control')
							->required() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.overlays'))->class('col-md-4 form-control-label')->for('overlays') }}
                         <div class="col-md-8">
                            {{ html()->text('overlays')
                                ->class('form-control')
                                ->placeholder(__('jobs.overlays'))
                                ->attribute('maxlength', 191)
                                ->required()->readonly() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.install_notes'))->class('col-md-4 form-control-label')->for('install_notes') }}
                         <div class="col-md-8">
                            {{ html()->text('install_notes')
                                ->class('form-control')
                                ->placeholder(__('jobs.install_notes'))
                                ->attribute('maxlength', 191)
                                ->required()->readonly() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('terms_conditions')->disabled() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.marketing_confirm'))->class('col-md-4 form-control-label')->for('marketing_confirm') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('marketting_confirm')->disabled() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('install_pic_check')->disabled() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.anti_grafiti_lami'))->class('col-md-4 form-control-label')->for('anti_grafiti_lami') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('anti_grafiti_lamin')->disabled() }}
                        </div>
                    </div><!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.flag_holder'))->class('col-md-4 form-control-label')->for('flag_holder') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('flag_holder')->disabled() }}
                        </div>
                    </div><!--form-group-->
					
					<div class="form-group row">
                        {{ html()->label(__('jobs.solor_spotlight'))->class('col-md-4 form-control-label')->for('solor_spotlight') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('solor_spot')->disabled() }}
                        </div>
                    </div><!--form-group-->
					
					
					<div class="form-group row">
						<label class="col-md-4 form-control-label" for="v_board">Note For Other Job</label>
						<div class="col-md-8">
						{{ html()->textarea('other_note')
                                ->class('form-control')
                                ->placeholder('Enter Note')
                                ->attribute('maxlength', 191)
                                ->required() }} 
						 
					    </div>
					</div><!--form-group-->
					<input type="hidden" value="{{$job->id}}" name="parent_id">
					
					
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
								{{ html()->button($text = "<i class='fas fa-plus-circle'></i> Create", $type = 'submit')->class('btn btn-success') }}
							</div>
                        </div>
                        <div class="col-6">
                            <div class="float-right">
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning" onclick="history.back(-1)"><i class="fas fa-reply"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}
        </div>
    </div>
</div>

@endsection