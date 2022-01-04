@extends('frontend.layouts.app') @section('title') Jobs Create @stop
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
					<li>{{ $error }}</li> @endforeach
				</ul>
			</div>
			@endif 
			{{ html()->form('POST',route('frontend.jobs.store'))->class('form-horizontal job_new_form')->acceptsFiles()->open() }} @role('super admin')
			<div class="form-group row">
				{{ html()->label(__('Select User'))->class('col-md-4
				form-control-label')->for('property_address') }}

				<div class="col-md-8">
					<select class="form-control" name="user_id" required>
						<option value="0" disabled>Select User</option>

						@foreach(\App\Models\User::getUsersEmail() as $key => $value)
						<option value="{{$key}}">{{$value}}</option> @endforeach
					</select>
				</div>
			</div>
			@endrole

			<div class="form-group row">
				{{ html()->label(__('jobs.property_address'))->class('col-md-4
				form-control-label')->for('property_address') }}
				<div class="col-md-8">{{ html()->text('pro_address')
					->class('form-control pro_address')
					->placeholder(__('jobs.property_address')) ->attribute('maxlength',
					191) ->required() }}</div>

			</div>
			<!--form-group-->

			<input type="hidden" name="suburb" id="suburb">
			<input type="hidden" name="post_code" id="post_code">
			<input type="hidden" name="state" id="state">
			<input type="hidden" name="latitude" id="latitude">
			<input type="hidden" name="longitude" id="longitude">

			<div class="form-group row">
				{{ html()->label(__('jobs.property_type'))->class('col-md-4
				form-control-label')->for('property_type') }}
				<div class="col-md-8">{{ html()->select('pro_type',
					Config::get('constant.prop_type'))
					->placeholder(__('jobs.property_type')) ->class('form-control
					select2') ->required() }}
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.sign_type'))->class('col-md-4	form-control-label')->for('sign_type') }}
				<div class="col-md-8">{{ html()->select('sign_type',Config::get('constant.sign_type'))
					->placeholder(__('jobs.sign_type')) ->class('form-control select2')
					->required() }}
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.sign_options'))->class('col-md-4 form-control-label')->for('sign_options') }}
				<div class="col-md-8">
					{{ html()->select('sign_options', Config::get('constant.sign_options'))
					->placeholder(__('jobs.sign_options'))
					->class('form-control select2')
					->required() }}
				</div>
			</div><!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.size'))->class('col-md-4
				form-control-label')->for('size') }}
				<div class="col-md-8">{{ html()->select('size',
					Config::get('constant.size')) ->placeholder(__('jobs.size'))
					->class('form-control') ->required() }}
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.orientation'))->class('col-md-4
				form-control-label')->for('orientation') }}
				<div class="col-md-8">{{ html()->select('orientation',
					Config::get('constant.orientation'))
					->placeholder(__('jobs.orientation')) ->class('form-control')
					->required() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.listing_type'))->class('col-md-4 form-control-label')->for('listing_type') }}
				<div class="col-md-8">{{ html()->select('listing_type',
					Config::get('constant.listing_type'))
					->placeholder(__('jobs.listing_type')) ->class('form-control')
					->required() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.quantity'))->class('col-md-4 form-control-label')->for('quantity') }}
				<div class="col-md-8">{{ html()->text('quantity')
					->placeholder(__('jobs.quantity')) ->class('form-control')
					->required() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.v_board'))->class('col-md-4 form-control-label')->for('v_board') }}
				<div class="col-md-8">{{ html()->select('v_board',
					Config::get('constant.v_board')) ->placeholder('V Board')
					->class('form-control') ->required() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.agent_nameplate'))->class('col-md-4 form-control-label')->for('agent_nameplate') }}
				<div class="col-md-8">{{ html()->text('agent_nameplate')
					->placeholder(__('jobs.agent_nameplate')) ->class('form-control')
					->required() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.overlays'))->class('col-md-4 form-control-label')->for('overlays') }}
				<div class="col-md-8">{{ html()->text('overlays')->class('form-control') ->placeholder(__('jobs.overlays'))
					->attribute('maxlength', 191) }}
				</div>
			</div>
			
			<div class="form-group row">
				{{ html()->label(__('jobs.textboard_information'))->class('col-md-4	form-control-label')->for('textboard_information') }}
				<div class="col-md-8">
					{{ html()->textarea('textboard_information')->class('form-control')->placeholder(__('TEXTBOARD INFORMATION')) }}
				</div>
			</div>
			
			<!--form-group-->

			<div class="alert alert-danger" id="install_check" style="display: none"></div>
			<div class="form-group row check_box_fm">
				{{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
				<div class="col-md-8">
					<button type="button" class="install_pic_check" id="install_pic_check" value="1">Add Photos</button>
					<input type="hidden" name="install_pic_check" value="1">
					<div class="pkf-insimg"></div>
						<br> <span>If no, installation will be at our discretion.
							Relocation fees may apply</span>
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.install_notes'))->class('col-md-4	form-control-label')->for('install_notes') }}
				<div class="col-md-8">{{ html()->textarea('install_notes')
					->class('form-control') ->placeholder(__('jobs.install_notes'))
					->attribute('maxlength', 191) }}
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
					<input type="text" name="preferred_install_date" class="form-control preferred_install_date" id="preferred_install_date" placeholder="dd/mm/yyyy"> 
				</div>
			</div>
			<!--form-group-->
			
			<!--form-group-->
			<div class="form-group row">
			   {{ html()->label(__('jobs.artwork_request'))->class('col-md-4 form-control-label')->for('artwork_request') }}
				<div class="col-md-8">
					{{ html()->select('artwork_type',
					Config::get('constant.artwork_type'))->placeholder('Artwork Type')
					->class('form-control') ->required() }}
				</div>
			</div>
			
			<div class="artwork_template" style="display: none">
				<div class="form-group row">
				   {{ html()->label(__('jobs.artwork_template'))->class('col-md-4 form-control-label')->for('artwork_template') }}
					<div class="col-md-8">
						<select class="form-control artwork_template" name="artwork_template" id="artwork_template">
							<option value="0">Select Template</option>
							@foreach($templates as $key => $value)
							
							<?php //echo "<pre>"; print_r($value['artworktemplates']['name']); die;?>
								<option value="{{$value['artworktemplates']['id']}}">{{$value['artworktemplates']['name']}}</option> 
							@endforeach
						</select>
						<button style="display:none; color: #fff;"" type="button" id="editArtwork" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Artwork</button>
						<input type="hidden" name="artwork_template_img" id="artwork_template_img" value="">
						<input type="hidden" name="artwork_template_markup" id="artwork_template_markup" value="">
						<input type="hidden" name="artwork_template_pdf" id="artwork_template_pdf" value="">
					</div>
				</div>
				
				<div class="form-group row">
					{{ html()->label('APPROVE ARTWORK')->class('col-md-4 form-control-label')->for('artwork_ready_checkbox') }}
					<div class="col-md-8">
						<input type="checkbox" name="artwork_ready_checkbox" id="artwork_ready_checkbox" value="1"> <span>(Tick mark if Artwork is Ready to Print)</span>
					</div>
				</div><!--form-group-->
			</div>
			<div class="alert alert-danger" id="reference_check" style="display: none"></div>
			
			<div class="form-group row check_box_fm upload_artwork_file" style="display: none">
				{{ html()->label(__('jobs.upload_artwork'))->class('col-md-4
				form-control-label')->for('reference_pic_check') }}
				<div class="col-md-8">
					<button type="button" class="reference_pic_check" id="reference_pic_check" value="1">Add Artwork</button>
					<input type="hidden" name="reference_pic_check" value="1">
					<div class="pkf-img"></div>
				</div>
			</div>
			
			<div class="form-group row">
				{{ html()->label(__('jobs.send_email_to'))->class('col-md-4 form-control-label')->for('send_email_to') }}
				<div class="col-md-8">
					<input type="text" name="send_email_to" class="form-control" id="send_email_to" placeholder="Email Address"> 
				</div>
			</div>
						
			<!--form-group-->
			<h4>Please confirm you agree to our:</h4>
			<div class="form-group row check_box_fm">
				{{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
				<div class="col-md-8">
					{{html()->radio()->name('terms_conditions')->checked()->value('0')}} Yes 
					{{html()->radio()->name('terms_conditions')->value('1')}} No
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row check_box_fm">
				{{ html()->label(__('jobs.marketing_confirm'))->class('col-md-4	form-control-label')->for('marketing_confirm') }}
				<div class="col-md-8">
					{{html()->radio()->name('marketting_confirm')->checked()->value('0')}} Yes 
					{{html()->radio()->name('marketting_confirm')->value('1')}} No
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row check_box_fm">
				{{ html()->label(__('jobs.installation_statement'))->class('col-md-4 form-control-label')->for('installation_statement') }}
				<div class="col-md-8">
					{{html()->radio()->name('installation_statement')->checked()->value('0')}} Yes 
					{{html()->radio()->name('installation_statement')->value('1')}} No	
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row check_box_fm">
				<div class="col-md-8">{{
					html()->file('install_pic[]')->class('install_pic')->id('install_pic')->multiple() }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row check_box_fm">
				<div class="col-md-8">{{
					html()->file('reference_pic[]')->class('reference_pic')->id('reference_pic')->multiple() }}
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row add_extra_box">
				<div class="col-md-12">
					<h3 class="text-center add_txt_ex">ADDITIONAL EXTRAS</h3>
				</div>
				<div class="col-md-6">
					<label>ANTI-GRAFFITI LAMINATION (+$10+GST) </label> 
					{{ html()->checkbox('anti_grafiti_lamin') }}
				</div>
				<div class="col-md-6" style="display:none">
					<label>FLAG HOLDER UP TO 32MM (+$0+GST)</label> {{ html()->checkbox('flag_holder') }}
				</div>
				<div class="col-md-6"><label>FLAG HOLDER UP TO 32MM (+$0+GST)</label>
					{{ html()->hidden('flag_holder')->value('0') }}
					{{ html()->select('flag_holders', Config::get('constant.flag_holders'))->placeholder('None')->class('form-control') }}
				</div>
				@role('super admin')
					<div class="col-md-6">
						<label>SOLAR SPOTLIGHT</label> {{ html()->checkbox('solor_spot') }}
					</div>
				@endrole
			</div>
			@role('user') 
				<input type="hidden" id="login_user_id" name="user_id" value="<?php echo Auth::User()->id;	?>"> 
			@endrole
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<button type="button" class="btn btn-danger" onclick="history.back(-1)">Cancel</button>
					</div>
				</div>
				<div class="col-6">
					<div class="float-right">
						<div class="form-group">
							{{ html()->button($text = "<i class='fas fa-plus-circle'></i>
							Create", $type = 'submit')->class('btn btn-success') }}
						</div>
					</div>
				</div>
			</div>
			{{ html()->form()->close() }}
			
		</div>
	</div>
</div>

<!--  Artwork Editor Js  -->
<script src='https://cdn.tiny.cloud/1/hi67nxm44q61qduaekpk5tbsbc8htm4ejhinobbttakeokk7/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
<script src="https://unpkg.com/cropperjs"></script>
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>

<!--  Artwork modal -->
<div class="modal fade in" id="artworkModel" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content" id="modal_content">
			<div class="modal-header">
				<h2 class="text-center">Artwork Editor</h2>
				<div class="switch_btn_design o-switch btn-group" data-toggle="buttons" role="group">
					<label class="btn btn-secondary active">
						<input type="radio" name="editor_type" id="option1" value="0" class="radio_btn1" checked> Basic
					</label>
					<label class="btn btn-secondary">
						<input type="radio" name="editor_type" id="option2" class="radio_btn2" value="1"> Advanced
					</label>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="cut_iframe_gap" value="">
				<textarea id="artwork_editor" name="mytextarea">
				</textarea>      
			</div>
			<div class="modal-footer">
				<span class="success_msg" style="display:none;">Artwork Saved Successfully!</span>
				<span class="err_msg" style="display:none;">Artwork dimension should be same!</span>
				<button type="button" style="margin-right: 30px; color: #fff;" id="downloadArtwork" class="btn btn-danger"><i class='fas fa-download'></i> Download Artwork</button>
				<button type="button" id="uploadArtwork" class="btn btn-primary">Save Artwork</button>
			</div>
		</div>
	</div>
</div>

<!--  Artwork image crop modal -->
<div class="modal fade artwork_editor_crop" id="artwork_editor_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Crop Image</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-8">
							<img src="" id="uploaded_img" />
						</div>
						<div class="col-md-4">
							<div class="preview"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<img src="{{ asset('img/loader.gif') }}" class="loader" style="display:none;">
				<button type="button" id="crop" class="btn btn-primary">Crop</button>
			</div>
		</div>
	</div>
</div>

@endsection