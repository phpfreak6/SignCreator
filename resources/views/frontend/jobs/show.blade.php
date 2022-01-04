<?php
use App\Models\Installer;
?>
@extends('frontend.layouts.app') @section('title') Job View @stop
@section('content')

<div class="content-page">
	<div class="content-center">
		<div class="container show_data_txt_container">
		@if(Auth::user()->hasRole('installer'))
			<h3 class="mapOpen" onclick="mapOpen('<?=$job->jobs->latitude;?>' , '<?=$job->jobs->longitude;?>')">(Job ID #{{ $job->jobs->id }}) {{ $job->jobs->pro_address }}</h3>
		@endif
		<!--  google map open on job view (address click) -->
		<script type="text/javascript">
		function mapOpen(lat,long) {
			window.open('http://maps.google.co.uk/maps?q='+lat+ ',' +long);
		}
		</script>		
		
		@if(Auth::user()->hasRole('super admin') || Auth::user()->hasRole('user') ||Auth::user()->hasRole('print'))
			<h3>(Job ID #{{ $job->id }}) {{ $job->pro_address }} @role('super
					admin') | {{ $job->suburb }}| {{ $job->post_code}}| {{ $job->state
					}} @endrole
			</h3>
			
			<div class="form-group row">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="arrow-steps">
							<div class="step">
								<span>Requested</span>
							</div>
							<div class="step">
								<span>Artwork Created</span>
							</div>
							<div class="step">
								<span>Artwork Approved</span>
							</div>
							<div class="step">
								<span>Printed</span>
							</div>
							<div class="step">
								<span>Installed</span>
							</div>
							<div class="step">
								<span>Removal Request</span>
							</div>
							<div class="step">
								<span>Removed</span>
							</div>
							<div class="step">
								<span>Task Requested</span>
							</div>
							<div class="step">
								<span>Not Installed</span>
							</div>
							<div class="step">
								<span>Cancelled</span>
							</div>
<!-- 							<div class="step"> -->
<!-- 								<span>Not Removed</span> -->
<!-- 							</div> -->
						</div>
					</div>
				</div>
			</div>
		@endif
			<!-- if USER is Installer -->

			@role('installer')
			
			@if($job->jobs->install_status == '6')
			<div class="form-group row">
				{{ html()->label(__('Removal Note From User'))->class('col-md-4	form-control-label')->for('removal_note') }}
				<div class="col-md-8">
				{{ $job->jobs->removal_note ? $job->jobs->removal_note : 'N/A '}}
				</div>
			</div>
            @endif
			
			<div class="form-group row">
				{{ html()->label(__('Id'))->class('col-md-4	form-control-label')->for('id') }}
				<div class="col-md-8">{{ $job->jobs->id }}</div>
			</div>
			<div class="form-group row">
				{{ html()->label(__('CLIENT'))->class('col-md-4	form-control-label')->for('client') }}
				<div class="col-md-8">
					{{ $job->jobs->users ? $job->jobs->users->name : 'N/A '}}
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.property_address'))->class('col-md-4 form-control-label addressMapOpen')->for('property_address') }}
				<div class="col-md-8 addressPointer" onclick="mapOpen('<?=$job->jobs->latitude;?>' , '<?=$job->jobs->longitude;?>')">{{ $job->jobs->pro_address }}</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('Suburb'))->class('col-md-4	form-control-label')->for('suburb') }}
				<div class="col-md-8">{{ $job->jobs->suburb }}</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.install_notes'))->class('col-md-4 form-control-label')->for('install_notes') }}
				<div class="col-md-8">{{ $job->jobs->install_notes }}</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('Install Type'))->class('col-md-4 form-control-label')->for('install_type') }}
				<div class="col-md-8">
					@if($job->type == 1) {{ 'Removal' }}@endif
					@if($job->type == 0) {{ 'Install' }}@endif
				</div>
			</div>
			
			@if($job->jobs->install_pic_check == '1')
				<h4>Install Pic</h4>

				<div class="form-group row imm_photo_sec">
					<div class="col-md-4 col-sm-12">
						<?php
						if (! empty($job->jobs->file)) {
							foreach ($job->jobs->file as $key => $value) {
								if($value->type == "1"){
								?>
								<img src="{{url($value->file)}}" style="width: 400px; height: auto" />
										
								<a href="{{ url('/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Install Pic", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
										
								<?php
								}
							}
						}
						?>
					</div>
					<!-- div class="col-md-8"></div-->
				</div>
				<!--form-group-->
			@endif

			<!-- Reference Pic -->
			@if($job->jobs->reference_pic_check == '1')
			<h4>Reference Pic</h4>

			<div class="form-group row">
				<div class="col-md-4  col-sm-12">
					<?php

					if (! empty($job->jobs->reference_pic)) {
					?>
						<img src="{{url($job->jobs->reference_pic)}}" style="width: 400px; height: auto;" />
						<a href="{{ url('/jobs/download/'.$job->jobs->id.'/1') }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Reference Pic 1", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
							
					<?php
					}
					?>
				</div>
				<div class="col-md-8"></div>
			</div>
			<!--form-group-->
			<div class="form-group row imm_photo_sec">
				<div class="col-md-4 col-sm-12">
					<?php
					if (! empty($job->jobs->file)) {
						foreach ($job->jobs->file as $key => $value) {
							if($value->type == "2"){
							?>
								<img src="{{url($value->file)}}" style="width: 400px; height: auto" />
										
								<a href="{{ url('/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Install Pic", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
										
							<?php
							}
						}
					}
					?>
				</div>
				<!-- div class="col-md-8"></div-->
			</div>
			@endif 
			
			<?php

			if (empty($job->other_task_id)) { ?>
				@if($job->installstatus == null)
				  
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<button type="button" class="btn btn-success completeModal othrTskColor"
									data-toggle="modal" data-target="#completeModal">
									<i class="fas fa-reply"></i> @if($job->type == "0")
									
									{{'Install Complete'}}
									@else
									{{'Removal Complete'}}
									@endif
								</button>
								<button type="button" class="btn btn-danger notInstalledModal"
										data-toggle="modal" data-target="#notInstalledModal">
										<i class="fas fa-reply"></i> @if($job->type == "0")
									
									{{'Install Not Complete'}}
									@else
									{{'Removal Not Complete'}}
									@endif
								</button>
							</div>					
						</div>
					</div>
					@endif
					
					@if($job->installstatus == 1)
						<button type="button" class="btn btn-success">
							@if($job->type == "0")						
								{{'Installed'}}
							@else
								{{'Removed'}}
							@endif
						</button>
					@endif
					
					@if($job->installstatus == "0")
						<button type="button" class="btn btn-danger">
							@if($job->type == "0")
								{{'Not Installed'}}
							@else
								{{'Not Removed'}}
							@endif
						</button>
					@endif
		<?php }  ?>


		@if($job->jobs->install_status == '6')
	
			<div class="form-group row add_extra_box"></div>
			<div class="form-group row">	
				<div class="imm_dsh_form_checked row">

					<h3 class="col-md-12">Removal Notes</h3>
					<div class="col-md-12">
						<strong>Notes : </strong>{{ $job->jobs->removal_note ? $job->jobs->removal_note : 'N/A '}}
					</div>
				</div>
			</div>
		@endif
		<!-- Other Task Section -->
		<?php
		if (! empty($job->jobs->otherTask)) { ?>
			<div class="form-group row add_extra_box">
				<div class="col-md-12">
					<h5 class="text-center add_txt_ex">Other Tasks</h5>
				</div>
			</div>

			@foreach($job->jobs->otherTask as $key=>$oT)

				<div class="imm_dsh_form_checked row">

					<h3 class="col-md-12">Task{{$key+1}}</h3>
					<div class="col-md-3">
						<strong>Notes : </strong>{{$oT->notes}}
					</div>
					<div class="col-md-3 text-center">
						<strong>Task : </strong>{{\App\Models\OtherTask::otherTaskName($oT->task_id)}}
					</div>
					
					<div class="col-md-3 text-center">
						<strong>Task Completed Date: </strong>
							@if(!empty($oT->installer->other_task_completed_date))
								{{$oT->installer->other_task_completed_date}}	
							@endif
					</div>
						
					<div class="col-md-3 text-center">
						<strong>Reference Pic : </strong> 
						<?php if(! empty($oT->reference_pic)) { ?>
								
							<img src="{{url($oT->reference_pic)}}" style="width: 370px; height: auto" />
							<a href="{{ url('/jobs/downloadOtherTaskImage/'.$oT->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Reference Pic 2", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
									
							<?php
						} else {
							echo "No Reference Pic";
						}
					?>
					</div>
				</div>
				
				@if(empty($oT->status))
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<button type="button" class="btn btn-warning completeModal"
								data-toggle="modal" data-id={{$oT->
								id}} data-target="#completeModal"> <i class="fas fa-reply"></i>
								Install Complete
							</button>
							<button type="button" class="btn btn-danger notInstalledModal" data-toggle="modal" data-id={{$oT->id}} data-target="#notInstalledModal"> <i class="fas fa-reply"></i>Install Not Complete
							</button>						
						</div>
					</div>
				</div>
				@endif
				
				@if(!empty($oT->status)) @if($oT->status==1)

					<button type="button" class="btn btn-success">Task Completed</button>
				@else
					<button type="button" class="btn btn-danger">Task Not Completed</button>
				@endif 
				@endif
				<hr>
								
			@endforeach
			<?php }  ?>
			
			<!--form-group-->

			@else

			<!-- if USER is not  Installer -->
			<div class="form-group row">
				{{ html()->label(__('jobs.property_type'))->class('col-md-4 col-sm-12 form-control-label')->for('property_type') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.prop_type')[$job->pro_type]) ?
					Config::get('constant.prop_type')[$job->pro_type] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.sign_type'))->class('col-md-4 col-sm-12
				form-control-label')->for('sign_type') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.sign_type')[$job->sign_type]) ?
					Config::get('constant.sign_type')[$job->sign_type] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.sign_options'))->class('col-md-4 col-sm-12
				form-control-label')->for('sign_options') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.sign_options')[$job->sign_options]) ?
					Config::get('constant.sign_options')[$job->sign_options] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.size'))->class('col-md-4 col-sm-12
				form-control-label')->for('size') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.size')[$job->size]) ?
					Config::get('constant.size')[$job->size] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->

			<div class="form-group row">
				{{ html()->label(__('jobs.orientation'))->class('col-md-4 col-sm-12
				form-control-label')->for('orientation') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.orientation')[$job->orientation]) ?
					Config::get('constant.orientation')[$job->orientation] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.listing_type'))->class('col-md-4 col-sm-12
				form-control-label')->for('listing_type') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.listing_type')[$job->listing_type]) ?
					Config::get('constant.listing_type')[$job->listing_type] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.quantity'))->class('col-md-4 col-sm-12
				form-control-label')->for('quantity') }}
				<div class="col-md-8 col-sm-12">{{ $job->quantity }}</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.v_board'))->class('col-md-4 col-sm-12
				form-control-label')->for('v_board') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.v_board')[$job->v_board]) ?
					Config::get('constant.v_board')[$job->v_board] : 'N/A' }}</div>
			</div>
			
			
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.agent_nameplate'))->class('col-md-4 col-sm-12
				form-control-label')->for('agent_nameplate') }}
				<div class="col-md-8 col-sm-12">{{ $job->agent_nameplate}}</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.overlays'))->class('col-md-4 col-sm-12
				form-control-label')->for('overlays') }}
				<div class="col-md-8 col-sm-12">{{ $job->overlays }}</div>
			</div>
			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.install_notes'))->class('col-md-4 col-sm-12
				form-control-label')->for('install_notes') }}
				<div class="col-md-8 col-sm-12">{{ $job->install_notes }}</div>
			</div>

			<div class="form-group row">
				{{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 col-sm-12
				form-control-label')->for('install_pic_check') }}
				<div class="col-md-8 col-sm-12">{{ ($job->install_pic_check) ? 'Yes' : 'No' }}
				</div>
			</div>
			<!--form-group-->
			@if($job->install_pic_check == '1')
			<div class="form-group row imm_photo_sec">
				<div class="col-md-4  col-sm-12">
					<?php
					if (! empty($job->file)) {
						foreach ($job->file as $key => $value) {
							if($value->type=='1'){
							?>
							<img src="{{url($value->file)}}" style="width: 400px; height: auto" /><br><br>			
							<a href="{{ url('/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Install Pic", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
							<?php
							}
						}
					}
					?>
				</div>
				<div class="col-md-8 col-sm-12"></div>
			</div>
			<!--form-group-->
			@endif

			<!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.reference_pic_check'))->class('col-md-4
				form-control-label')->for('reference_pic_check') }}
				<div class="col-md-8">{{ ($job->reference_pic_check) ? 'Yes' : 'No'
					}}</div>
			</div>
			<!--form-group-->
			
			@if($job->reference_pic_check == '1')
			<div class="form-group row">
				<div class="col-md-4 ">
					<?php

					if (! empty($job->reference_pic)) {?>
						<img src="{{url($job->reference_pic)}}"	style="width: 400px; height: auto;" />
						<a href="{{ url('/jobs/download/'.$job->id.'/1') }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Reference Pic 3", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
					<?php
					}
					
					if (! empty($job->file)) {
						foreach ($job->file as $key => $value) {
							if($value->type == '2'){
							?>
							<img src="{{url($value->file)}}" style="width: 400px; height: auto" />
							<a href="{{ url('/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Artwork", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 
							<?php
							}
						}
					}
					?>
				</div>
				<div class="col-md-8"></div>
			</div>
			<!--form-group-->
			@endif
			
			<div class="form-group row">
				{{ html()->label(__('jobs.installation_method'))->class('col-md-4 col-sm-12 form-control-label')->for('installation_method') }}
				<div class="col-md-8 col-sm-12">{{
					isset(Config::get('constant.installation_method')[$job->installation_method]) ?
					Config::get('constant.installation_method')[$job->installation_method] : 'N/A' }}
				</div>
			</div>
			
			<div class="form-group row">
				{{ html()->label(__('jobs.preferred_install_date'))->class('col-md-4 form-control-label')->for('preferred_install_date') }}
				<div class="col-md-8">{{ $job->preferred_install_date }}</div>
			</div>
			<div class="form-group row">
				{{ html()->label(__('jobs.anti_grafiti_lami'))->class('col-md-4	form-control-label')->for('anti_grafiti_lami') }}
				<div class="col-md-8">{{ ($job->anti_grafiti_lamin) ? 'Yes' : 'No'
					}}</div>
			</div>
			<!--form-group-->
			<div class="form-group row" style="display:none">
				{{ html()->label(__('jobs.flag_holder'))->class('col-md-4 form-control-label')->for('flag_holder') }}
				<div class="col-md-8">{{ ($job->flag_holder) ? 'Yes' : 'No' }}</div>
			</div>
			<div class="form-group row">
				{{ html()->label(__('jobs.flag_holder'))->class('col-md-4 form-control-label')->for('flag_holder') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.flag_holders')[$job->flag_holders]) ?
					Config::get('constant.flag_holders')[$job->flag_holders] : 'N/A' }}
				</div>
			</div>
			<!--form-group-->
			
			
			<div class="form-group row">
				{{ html()->label(__('jobs.solor_spotlight'))->class('col-md-4 form-control-label')->for('solor_spotlight') }}
				<div class="col-md-8">{{ ($job->solor_spot) ? 'Yes' : 'No' }}</div>
			</div>
			
			<div class="form-group row">
				{{ html()->label(__('jobs.send_email_to'))->class('col-md-4 form-control-label')->for('send_email_to') }}
				<div class="col-md-8">
				{{ $job->send_email_to ? $job->send_email_to : 'N/A '}}
				</div>
			</div>
			<!--form-group-->
			
			<?php if(\App\Models\Installer::installCompleted($job->id)){ ?>
				<div class="form-group row">
					<a href="{{ url('jobs/download-install-file/'.$job->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Complete Install Pic", $type = 'button')->class('btn btn-success othrTskColor') }}</a>
				</div>	
			<?php  } ?>	
			
			<?php if(\App\Models\Installer::removedinstallCompleted($job->id)){ ?>
				<div class="form-group row">
					<a href="{{ url('jobs/removal-download-file/'.$job->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Remove Complete Install Pic", $type = 'button')->class('btn btn-success othrTskColor') }}</a>
				</div>	
			<?php  } ?>
			
			@if($user_type == 'user' && (isset($job->artwork_template) && ($job->install_status =='2' || $job->install_status =='3')))
				<div class="form-group row">
					{{ html()->label(__('ARTWORK REQUEST:'))->class('col-md-4 form-control-label')->for('flag_holder') }}
				</div>
				<div class="form-group row">
					<div class="col-md-4">
						<?php if(isset(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'])){ ?>
								<img id="artwotk_image" src="{{ url(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'].'?time='.time()) }}" style="width:500px;height:auto" />
						<?php  } ?>
					</div>
				</div>
				
			@endif
			
			@if($user_type == 'user' && (isset($job->artwork_template) && $job->install_status =='2'))

				<input type="hidden" id="artwork_template" value="{{ $job->artwork_template }}" data-jobid="{{ $job->id }}">
				<div class="form-group row artwork_approved_div">
					<div class="job_btn ">
						<div class="float-right">
							<div class="form-group">
								<button type="button" id="viewEditArtwork" style="color: #fff;" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Artwork</button>
							</div>
						</div>
					</div>
					<div class="job_btn ">
						<div class="float-right">
							<div class="form-group">
								<?php if(isset(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'])){
										$artwork_img = \App\Models\Artworkupload::artworkimage($job->id); ?>
										<a href="{{ url('jobs/downloadArtworkImage/'.$artwork_img['id']) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Artwork", $type = 'button')->class('btn btn-danger') }}</a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="job_btn ">
						<div class="float-right">
							<div class="form-group">
								<button type="button" id="artwork_readyto_print" style="color: #fff;" class="btn btn-success "><i class="fas fa-check"></i> Approve My Artwork</button>
							</div>
						</div>
					</div>
				</div>
				<div id="approve_success"></div>
			@endif
				
			<!-- Other Task Section -->
			<?php
			if (! empty($job->otherTask)) {   ?>
				<div class="form-group row add_extra_box">
					<div class="col-md-12">
						<h5 class="text-center add_txt_ex">Other Tasks</h5>
					</div>
				</div>

				@foreach($job->otherTask as $key=>$oT)

				<div class="imm_dsh_form_checked row">

					<h3 class="col-md-12">Task{{$key+1}}</h3>
					<div class="col-md-3">
						<strong>Notes : </strong>{{$oT->notes}}
					</div>
					<div class="col-md-3 text-center">
						<strong>Task : </strong>{{\App\Models\OtherTask::otherTaskName($oT->task_id)}}
					</div>
				
					<div class="col-md-3 text-center">
						<strong>Task Completed Date: </strong>
						@if(!empty($oT->installer->other_task_completed_date))
							{{$oT->installer->other_task_completed_date}}
						@endif
					</div>
							
					<div class="col-md-3 text-center">
						<strong>Reference Pic : </strong> 
						<?php
						if (! empty($oT->reference_pic)) { ?>
							<img src="{{url($oT->reference_pic)}}" style="width: 224px; height: auto;" />
							<a href="{{ url('/jobs/downloadOtherTaskImage/'.$oT->id) }}" >{{ html()->button($text = "<i class='fas fa-download'></i> Download Reference Pic 4", $type = 'button')->class('btn btn-success othrTskColor') }}</a> 	
						<?php
						} else {
							echo "No Reference Pic";
						}
						?>
					</div>
				</div>
				@if(!empty($oT->status)) 
					@if($oT->status==1)
						<button type="button" class="btn btn-success">Task Completed</button>
					@else
						<button type="button" class="btn btn-danger">Task Not Completed</button>
					@endif 
				@endif
				<hr>
								
				@endforeach
					
			<?php  } ?>

			<!--buttons-->
			<div class="row float- imm_right_btn">				
				<div class="job_btn">
					<div class="float-right">
						<div class="form-group">
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#cancelModal">
								 Cancel Job
							</button>
						</div>
					</div>
				</div>
				@role('user')
				<div class="job_btn ">
					<div class="float-right">
						<div class="form-group">
							<button type="button" class="btn btn-success othrTskColor" data-toggle="modal"
								@if( $job->install_status == 5) data-target="#otherTaskModal" @else
								data-target="#otherTaskErrorModal" @endif > Other Task
							</button>

						</div>
					</div>
				</div>
				@endrole
				<div class="job_btn">
					<div class="form-group">
						<button type="button" class="btn btn-primary" data-toggle="modal"
							data-target="#requestRemovalModal">
							 Request Removal
						</button>
					</div>
				</div>
			</div>
			@endrole
		</div>
	</div>
</div>


<!-- cancel modal -->
<div class="modal fade imm_modal" id="cancelModal" role="dialog">
	<div class="modal-dialog cancel-modal-width">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header" style="display: flex; flex-direction: column; margin-top: -30px;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title cancel-modal-height">Are you sure you want to cancel this order?</h4>
				<h5 class="modal-title cancel-modal-title-height">If artwork created $50+GST Charge may apply.</h5>
			</div>
			<div class="row">
<!-- 				<div class="col-sm-6 text-right"> -->
<!-- 					<button type="button" class="btn btn-warning" data-dismiss="modal">No</button> -->
<!-- 				</div> -->
				<div class="col-md-7 text-right">
					<a href="/job/{{$job->id}}/canceljob" class="btn btn-danger">CANCEL</a>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- request removal modal -->
<form method="post" action="{{url('/')}}/job/removal-req/{{$job->id}}" >
	<div class="modal fade imm_modal" id="requestRemovalModal" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Are you sure you want to remove this sign?</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="modal-body">
				<div class="form-group row">
					<label for="Notes">Notes:</label>
					<div class="col-md-10">
						<textarea class="form-control" name="removal_note"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-danger">REQUEST REMOVAL</a>
			</div>
			</div>
		</div>
	</div>
</form>
<!-- other task modal -->
<form method="post" action="{{url('other-task')}}" id="form" enctype="multipart/form-data">
	@csrf
	<!-- Modal -->
	<div class="modal imm_modal" tabindex="-1" role="dialog" id="otherTaskModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display: none"></div>
				<div class="modal-header">
					<h5 class="modal-title">Other Tasks</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="form-group row">
						<label for="Notes">Tasks:</label>
						<div class="col-md-10">
							<select class="form-control" name="task_id" id="task_id" required>
								@foreach(\App\Models\OtherTask::otherTask() as $key => $value)
								<option value="{{$key}}">{{$value}}</option> @endforeach
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="Notes">Notes:</label>
						<div class="col-md-10">
							<textarea class="form-control" name="notes" id="notes" required></textarea>
						</div>
					</div>

					<div class="form-group row">
						<label for="reference_pic_other_task">Reference Pic:</label>
						<div class="col-md-8">
							<input type="file" class="taskReferencePic"	name="reference_pic_other_task" id="reference_pic_other_task">
						</div>
					</div>
					<input type="hidden" value="{{$job->id}}" name="job_id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button class="btn btn-success" id="otherTaskSubmit">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</form>


<!-- other task error modal -->
<div class="modal fade imm_modal" id="otherTaskErrorModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" id="otherTaskColorChange" class="close" data-dismiss="modal">&times;</button>
				<h4 style="margin-top: 19px;font-family:Times New Roman">Tasks can only be assigned to an installed property.  Please email <b>support@signcreators.com.au</b> for further assistance</h4>
			</div>

		</div>
	</div>
</div>
@role('installer')
<!-- install complete by installer modal -->
<form method="post" id="installComplete" enctype="multipart/form-data">
	@csrf
	<!-- Modal -->
	<div class="modal imm_modal" tabindex="-1" role="dialog" id="completeModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display: none"></div>

				<div class="modal-header">
					<h5 class="modal-title">Install Complete</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="form-group row">
					<div class="col-md-12">
						<div id="install_complete_success"></div>
					</div>
				</div>
				<div class="modal-body">
					<div class="form-group row imm_install_form">
						<label for="install_image">Install Image:</label>
						<div class="col-md-8 col-sm-12">
							<input type="file" class="taskReferencePic imm_install_btn" name="install_image"
								id="install_image" required>
						</div>
					</div>
					<input type="hidden" value="{{$job->jobs->id}}" name="job_id" id="job_id">
					<input type="hidden" value="{{$job->type}}" name="install_type" id="install_type">
					<input type="hidden" value="" name="task_id" class="task_id">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					{{ html()->button($text = "<i class='fas fa-plus-circle'></i>
					SAVE", $type = 'submit')->class('btn btn-success') }}
				</div>
				<div class="form-group row">
						<div id="upload_in_progress_installComplete"></div>
				</div>
			</div>
		</div>
	</div>
</form>



<!-- install not complete by installer modal -->
<form method="post" id="installNotComplete"
	enctype="multipart/form-data">
	@csrf
	<!-- Modal -->
	<div class="modal imm_modal" tabindex="-1" role="dialog" id="notInstalledModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="alert alert-danger" style="display: none"></div>

				<div class="modal-header">
					<h5 class="modal-title">Install Not Complete</h5>
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<label for="Notes">Notes:</label>
						<div class="col-md-10">
							<textarea class="form-control" name="not_complete_reason" id="not_complete_reason" required></textarea>
						</div>
					</div>
					<input type="hidden" value="{{$job->jobs->id}}" name="job_id" id="job_id">
					<input type="hidden" value="{{$job->type}}" name="install_type" id="install_type">
					<input type="hidden" value="" name="task_id" id="other_task_id">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
					{{ html()->button($text = "<i class='fas fa-plus-circle'></i>
					SAVE", $type = 'submit')->class('btn btn-success') }}
				</div>
			</div>
		</div>
	</div>
</form>
@endrole

<input type="hidden" id="install_state"	value="{{ $job->install_status }}" />

@if($user_type == 'user' && (isset($job->artwork_markup) && $job->install_status =='2'))
	
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
					<textarea id="artwork_editor" name="mytextarea" style="width:850px; height:1100px;">
					</textarea>      
				</div>
				<div class="modal-footer">
					<span class="success_msg" style="display:none;">Artwork Saved Successfully!</span>
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
@endif

@endsection
