@extends('frontend.layouts.app')
@section('title')
Jobs Create
@stop
@section('content')
<div class="content-page">
    <div class="page-header-image" data-parallax="true"></div>
    <div class="content-center">
        <div class="container">
            <h3 class="title text-center">
                 <i class=""></i> {{ __('jobs.title') }}
            </h3>
            
           @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

            {{ html()->form('POST', route('frontend.jobs.store'))->class('form-horizontal job_new_form')->acceptsFiles()->open() }}
                  
                <div class="form-group row">
                 {{ html()->label(__('Select User'))->class('col-md-4 form-control-label')->for('property_address') }}

					<div class=col-md-8>
						<select class="form-control" name ="user_id">
							<option value="0" disabled>Select User</option>
			
							@foreach(\App\Models\User::getUsersEmail() as $key => $value)
							    <option value="{{$key}}" >{{$value}}</option>   
							@endforeach
						</select>
					</div>
				</div> 
                  
				<div class="form-group row">
					{{ html()->label(__('jobs.property_address'))->class('col-md-4 form-control-label')->for('property_address') }}
					<div class="col-md-8">
						{{ html()->text('pro_address')
							->class('form-control pro_address')
							->placeholder(__('jobs.property_address'))
							->attribute('maxlength', 191)
							->required() }}
					</div>
				</div><!--form-group-->
				
					<input type="hidden" name="suburb" id="suburb">
					<input type="hidden" name="post_code" id="post_code">
					<input type="hidden" name="state" id="state">
					<input type="hidden" name="latitude" id="latitude">
					<input type="hidden" name="longitude" id="longitude">

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
                        {{ html()->label(__('jobs.sign_options'))->class('col-md-4 form-control-label')->for('sign_options') }}
                        <div class="col-md-8">
                           	{{ html()->select('sign_options', Config::get('constant.sign_options'))
							->placeholder(__('jobs.sign_options'))
							->class('form-control select2')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.size'))->class('col-md-4 form-control-label')->for('size') }}
                        <div class="col-md-8">
                           	{{ html()->select('size', Config::get('constant.size'))
							->placeholder(__('jobs.size'))
							->class('form-control')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					
					<div class="form-group row">
                        {{ html()->label(__('jobs.orientation'))->class('col-md-4 form-control-label')->for('orientation') }}
                        <div class="col-md-8">
                           	{{ html()->select('orientation', Config::get('constant.orientation'))
							->placeholder(__('jobs.orientation'))
							->class('form-control')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.listing_type'))->class('col-md-4 form-control-label')->for('listing_type') }}
                        <div class="col-md-8">
                           	{{ html()->select('listing_type', Config::get('constant.listing_type'))
							->placeholder(__('jobs.listing_type'))
							->class('form-control')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.quantity'))->class('col-md-4 form-control-label')->for('quantity') }}
                        <div class="col-md-8">
                           	{{ html()->text('quantity')
							->placeholder(__('jobs.quantity'))
							->class('form-control')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.v_board'))->class('col-md-4 form-control-label')->for('v_board') }}
                        <div class="col-md-8">
                           	{{ html()->select('v_board', Config::get('constant.v_board'))
							->placeholder('V Board')
							->class('form-control')
							->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.overlays'))->class('col-md-4 form-control-label')->for('overlays') }}
                         <div class="col-md-8">
                            {{ html()->text('overlays')
                                ->class('form-control')
                                ->placeholder(__('jobs.overlays'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.install_notes'))->class('col-md-4 form-control-label')->for('install_notes') }}
                         <div class="col-md-8">
                            {{ html()->text('install_notes')
                                ->class('form-control')
                                ->placeholder(__('jobs.install_notes'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('terms_conditions')->required()->value('0') }}
                        </div>
                    </div>
					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.marketing_confirm'))->class('col-md-4 form-control-label')->for('marketing_confirm') }}
                        <div class="col-md-8">
							{{ html()->checkbox('marketting_confirm')->required()->value('0') }}
                        </div>
                    </div>
					<!--form-group-->
                    <div class="form-group row">
                        {{ html()->label(__('jobs.installation_statement'))->class('col-md-4 form-control-label')->for('marketing_confirm') }}
                         <div class="col-md-8">
						 {{ html()->checkbox('installation_statement')->required()->value('0') }}
                        </div>
                    </div>
					<!--form-group-->	
					<div class="alert alert-danger" id="install_check" style="display:none"></div>

					<!--form-group-->
					<div class="form-group row">
                        {{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
                        <div class="col-md-8">
							<button type="button" class="install_pic_check" id="install_pic_check" value="1">Add Photos</button> 
							<input type="hidden" name="install_pic_check" value="1">
							<div class="pkf-insimg"></div>
						</div>
                    </div>
					
					<!--form-group-->
                    <div class="form-group row check_box_fm">
                       <div class="col-md-8">
						 {{ html()->file('install_pic[]')->class('install_pic')->id('install_pic')->multiple() }}
                        </div>   
                    </div>
					
					<div class="form-group row">
						{{ html()->label(__('jobs.installation_method'))->class('col-md-4 form-control-label')->for('installation_method') }}
						<div class="col-md-8">{{ html()->select('installation_method',
							Config::get('constant.installation_method')) ->placeholder(__('jobs.installation_method'))
							->class('form-control') ->required() }}
						</div>
					</div>
					
					<!--form-group-->
					<div class="form-group row">
						{{ html()->label(__('jobs.preferred_install_date'))->class('col-md-4 form-control-label')->for('preferred_install_date') }}
						 <div class="col-md-8">
						    <div class="install_error" style="color:red;display:none"></div>
							<input type="text" name="preferred_install_date" class="form-control preferred_install_date" id="preferred_install_date" placeholder="dd/mm/yyyy" required> 
						</div>
					</div><!--form-group-->
					<div class="form-group row add_extra_box">
					    <div class="col-md-12"><h3 class="text-center add_txt_ex">ADDITIONAL EXTRAS</h3></div>
					    <div class="col-md-6"><label>ANTI-GRAFITI LAMINATION</label> {{ html()->checkbox('anti_grafiti_lamin') }}</div>
					    <div class="col-md-6" style="display:none">
							<label>FLAG HOLDER UP TO 32MM (+$0+GST)</label> {{
							html()->checkbox('flag_holder') }}
						</div>
						<div class="col-md-6"><label>FLAG HOLDER UP TO 32MM (+$0+GST)</label>
							{{ html()->hidden('flag_holder')->value('0') }}
							{{ html()->select('flag_holders', Config::get('constant.flag_holders'))->placeholder('None')->class('form-control') }}
						</div>
					    <div class="col-md-6"><label>SOLAR SPOTLIGHT</label> {{ html()->checkbox('solor_spot') }}</div>
						
					</div>
					
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
<style>
/* .install_pic{
	display: block !important;
	opacity: 1 !important;
} */
</style>
  