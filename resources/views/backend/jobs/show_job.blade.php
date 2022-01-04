
@extends('backend.layouts.app')

@section('title')
Job Edit
@stop
@section('content')
<div class="card">
    <div class="card-body">
		<div class="content-page">
			<div class="page-header-image" data-parallax="true"></div>
			<div class="content-center">
				<div class="container">
					<div class="form-group row">
						<div class="col-md-12 text-center">
							<h3>#{{ $job->id }}</h3>
						</div>
					</div><!--form-group-->
					<div class="form-group row">
						<div class="col-md-12 text-center">
							<h3>{{ $job->pro_address }} | {{ $job->suburb }}| {{ $job->post_code }} | {{ $job->state}}</h3>
						</div>
					</div><!--form-group-->
					<div class="form-group row">
						<div class="col-md-12 text-center">
							<h3>{{ $job->users->name }}<h3>
						</div>
					</div><!--form-group-->
					
					<div class="form-group row">
						<div class="col-md-12">
							<div class="wrapper">	
								<div class="arrow-steps">
									<div class="step"><span>Requested</span></div>
									<div class="step"><span>Artwork Created</span></div>
									<div class="step"><span>Artwork Approved</span></div>
									<div class="step"><span>Printed</span></div>
									<div class="step"><span>Installed</span></div>
									<div class="step"><span>Removal Request</span></div>
									<div class="step"><span>Removed</span></div>
									<div class="step"><span>Task Requested</span></div>
									<div class="step"><span>Not Installed</span></div>
									<div class="step"><span>Cancelled</span></div>
									<div class="step"><span>Not Removed</span></div>
								</div>	
							</div>
						</div>
					</div><!--form-group-->
											
					<!-- job detail page  view -->
					<div class="form-group row add_extra_box">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">JOB DETAIL</h5></div>
					</div>
					
					
					<div class="row imm_dash_form">
					
					<div class="col-md-12 col-lg-6">
						<div class="form-group row">
							{{ html()->label(__('jobs.size'))->class('col-md-4 form-control-label')->for('size') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.size')[$job->size]) ? Config::get('constant.size')[$job->size] : 'N/A' }}
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.sign_options'))->class('col-md-4 form-control-label')->for('sign_options') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.sign_options')[$job->sign_options]) ? Config::get('constant.sign_options')[$job->sign_options] : 'N/A' }}
							</div>
						</div>
						
						<div class="form-group row">
							{{ html()->label(__('jobs.orientation'))->class('col-md-4 form-control-label')->for('orientation') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.orientation')[$job->orientation]) ? Config::get('constant.orientation')[$job->orientation] : 'N/A' }}
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.listing_type'))->class('col-md-4 form-control-label')->for('listing_type') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.listing_type')[$job->listing_type]) ? Config::get('constant.listing_type')[$job->listing_type] : 'N/A' }}
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.quantity'))->class('col-md-4 form-control-label')->for('quantity') }}
							<div class="col-md-8 text-right">
							{{ $job->quantity }}
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.v_board'))->class('col-md-4 form-control-label')->for('v_board') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.v_board')[$job->v_board]) ? Config::get('constant.v_board')[$job->v_board] : 'N/A' }}
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.overlays'))->class('col-md-4 form-control-label')->for('overlays') }}
							 <div class="col-md-8 text-right">
								{{ $job->overlays }}	
							</div>
						</div><!--form-group--><div class="form-group row">
							{{ html()->label(__('jobs.agent_nameplate'))->class('col-md-4 form-control-label')->for('overlays') }}
							 <div class="col-md-8 text-right">
								{{ $job->agent_nameplate }}	
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.textboard_information'))->class('col-md-4 form-control-label')->for('overlays') }}
							 <div class="col-md-8 text-right">
								{{ $job->textboard_information }}	
							</div>
						</div><!--form-group-->
					</div>
				
					<div class="col-md-12 col-lg-6"> 
					
						<div class="form-group row">
							{{ html()->label(__('jobs.install_notes'))->class('col-md-4 form-control-label')->for('install_notes') }}
							 <div class="col-md-8 text-right">
								{{ $job->install_notes }}	
							</div>
						</div><!--form-group-->
			
						<div class="form-group row">
							{{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
							<div class="col-md-8 text-right">
								 {{ ($job->install_pic_check) ? 'YES' : 'NO' }}
							</div>
						</div><!--form-group-->
						
						@if($job->install_pic_check == '1')
						<div class="form-group row">
							<div class="col-md-4 col-sm-12 imm_dash_img">
						
							<?php
							if (! empty($job->file)) {
								foreach ($job->file as $key => $value) {
									if($value->type == '1'){
									?>
									<img src="{{url($value->file)}}" style="width:400px;height:auto" />
									<br><br>	
									<a href="{{ url('admin/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = " Download Install Pic", $type = 'button')->class('btn btn-outline-success') }}</a> 	
									<br><br>	
									<?php
									}
								}
							}
							?>
							</div>
							<!-- div class="col-md-8 col-sm-12">
							</div-->
						</div><!--form-group-->
						@endif
						
						<!-- REFERENCE PIC -->
						
						<div class="form-group row">
							{{ html()->label(__('jobs.reference_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
							<div class="col-md-8 text-right">
								{{ ($job->reference_pic_check) ? 'YES' : 'NO' }}
							</div>
						</div><!--form-group-->
						@if($job->reference_pic_check == '1')
							<div class="form-group row">
								<div class="col-md-4">
									<?php
									if (! empty($job->reference_pic)) {  ?>
										<img src="{{url($job->reference_pic)}}" style="width:400px;height: auto;" />
										<br><br>	
										<a href="{{ url('admin/jobs/download/'.$job->id.'/1') }}" >{{ html()->button($text = " Download Reference Pic", $type ='button')->class('btn btn-outline-success') }}</a> 	
									<?php } ?>
									
								</div>
								<div class="col-md-8"></div>
							</div>
							<!--form-group-->
						@endif
						<?php
						
						if (! empty($job->file)) {
							foreach ($job->file as $key => $value) {
								$supported_image = array('gif','jpg','jpeg','png');
								
								// echo '<pre>'; print_r($value->type);
								if($value->type == '2'){						// echo '<pre>'; print_r($value);
								?>
								<div class="form-group row">
									<div class="col-md-8">
										<?php
										// if (in_array($value->file, $supported_image)){
										if (!empty($value->file)){
										?>
											<img src="{{url($value->file)}}" style="width:400px;height:auto" />
											<br><br>
											<?php		/* 									
											<a href="{{ url('admin/jobs/download/'.$job->id.'/1') }}" >{{ html()->button($text = " Download Artwork", $type = 'button')->class('btn btn-outline-success') }}</a> 
											 */
											?>
											<a href="{{ url('admin/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = " Download Artwork", $type = 'button')->class('btn btn-outline-success') }}</a> 
										<?php
										}else{
											$my_file = $value->file;
											$pdfname = substr($my_file, strrpos($my_file, '/' )+1)."\n"
											?>
											<p>{{ $pdfname }}</p>
											<br>
											<br>	
											<a href="{{ url('admin/jobs/download-file/'.$value->id) }}" >{{ html()->button($text = " Download Artwork", $type = 'button')->class('btn btn-outline-success') }}</a> 
											<?php
										}
										?>
									</div>
									<div class="col-md-8"></div>
								</div><!--form-group-->						
								<?php
								}
							}
					
						}
						?>
						<div class="form-group row">
							{{ html()->label(__('jobs.installation_method'))->class('col-md-4 form-control-label')->for('installation_method') }}
							<div class="col-md-8 text-right">
								{{ isset(Config::get('constant.installation_method')[$job->installation_method]) ? Config::get('constant.installation_method')[$job->installation_method] : 'N/A' }}
							</div>
						</div><!--form-group-->
						
						<div class="form-group row">
							{{ html()->label(__('jobs.preferred_install_date'))->class('col-md-4 form-control-label')->for('preferred_install_date') }}
							<div class="col-md-8 text-right">
							{{ $job->preferred_install_date }}
							</div>
						</div>
								
						<div class="form-group row">
							{{ html()->label(__('jobs.anti_grafiti_lami'))->class('col-md-4 form-control-label')->for('anti_grafiti_lami') }}
							 <div class="col-md-8 text-right">
							 {{ ($job->anti_grafiti_lamin) ? 'YES' : 'NO' }}
							 
							</div>
						</div><!--form-group-->
						<div class="form-group row">
							{{ html()->label(__('jobs.flag_holder'))->class('col-md-4 form-control-label')->for('flag_holder') }}
							 <div class="col-md-8 text-right">
							 <?php
							 if(empty($job->flag_holders)){
							 ?>
							  {{ ($job->flag_holder) ? 'YES' : 'NO' }}
							<?php
							 }else{
							?>
								{{ isset(Config::get('constant.flag_holders')[$job->flag_holders]) ?
								Config::get('constant.flag_holders')[$job->flag_holders] : 'N/A' }}
							<?php
							}
							 ?>
							</div>
						</div><!--form-group-->
						
						<div class="form-group row">
							{{ html()->label(__('jobs.solor_spotlight'))->class('col-md-4 form-control-label')->for('solor_spotlight') }}
							 <div class="col-md-8 text-right">
							{{ ($job->solor_spot) ? 'YES' : 'NO' }}
							 
							</div>
						</div><!--form-group-->
					
					</div>
					</div>
					<div class="form-group row">
						<div class="col-md-12 text-right">
							<a href="{{ url('admin/jobs/'.$job->id.'/edit') }}" >{{ html()->button($text = "<i class='fas fa-edit'></i> Edit", $type = 'button')->class('btn btn-success') }}</a>
						</div>
					</div>
										
					<!-- reporting page  view -->
					
					<div class="form-group row add_extra_box">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">ARTWORK</h5></div>
					</div>	
					
					<div id="artwork_not_required_success"></div>
					<div class="form-group row imm_upload">
					   {{ html()->label('Artwork Not Required')->class('col-md-4 col-sm-4 form-control-label')->for('artwork_required') }}
						<div class="col-md-8 col-sm-8">
							<input type="checkbox" name="artwork_required" id="artwork_required" @if( \App\Models\Job::artworkStatus($job->id) ==1) {{'checked'}} @endif>
						</div>
					</div><!--form-group-->	
					<form id="artwork_form" method="post" enctype="multipart/form-data" >
						<div class="row" id="upload_artwork" @if( \App\Models\Job::artworkStatus($job->id) ==1)  style="display:none" @endif>
							{{ html()->label('Upload Artwork')->class('col-md-3 form-control-label')->for('artwork_files') }}
							
							<div class="col-md-5">
								{{ html()->file('artwork_file', ' ')->class('form-control') }}
								<?php if(isset(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'])){
									?>
										<img src="{{ url(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'].'?time='.time()) }}" style="width:400px;height:auto" />
								<?php  } ?>
							</div>
							<div class="col-md-4">
								{{ html()->button($text = "<i class='fas fa-upload'></i> SEND", $type = 'submit')->class('btn btn-success send_artwork') }}
							</div>
								  
						</div>
						<!--form-group-->
						<br/><br/>
						<div class="form-group row imm_dsh_form_checked">
							<div class="col-md-6 col-lg-3">
								<div class="artwork_stats">
									<strong>Status : </strong>{{\App\Models\Artworkupload::artwotkStatus($job->id)['status']}}
								</div>
							</div>
							
							<div class="col-md-6 col-lg-3 text-center">
								<strong>Sent Date : </strong> {{isset(\App\Models\Artworkupload::artwotkStatus($job->id)['whensent']) ? Carbon\Carbon::parse(\App\Models\Artworkupload::artwotkStatus($job->id)['whensent'])->format('d M Y') : 'N/A'}}
							</div>
							
							
							<div class="col-md-6 col-lg-3">
								<div class="artwork_comment">
									<strong>Comment : </strong>{{ \App\Models\Artworkupload::comment($job->id) ? \App\Models\Artworkupload::comment($job->id) : 'N/A'}} 
								</div>
							</div>
							<?php if(isset(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'])){
									$artwork_img = \App\Models\Artworkupload::artworkpdf($job->id); ?>
								<div class="col-md-6 col-lg-3  text-center">
									<a href="{{ url('jobs/downloadArtworkPdf/'.$job->id) }}" >{{ html()->button($text = "Download Artwork PDF", $type = 'button')->class('btn btn-outline-success') }}</a>
								</div>
							<?php  } ?>
							
							<?php if(isset(\App\Models\Artworkupload::artworkimage($job->id)['artwotk_image'])){
									$artwork_img = \App\Models\Artworkupload::artworkimage($job->id); ?>
								<div class="col-md-6 col-lg-3">
									<a href="{{ url('jobs/downloadArtworkImage/'.$artwork_img['id']) }}" >{{ html()->button($text = "Download Artwork Image", $type = 'button')->class('btn btn-outline-success') }}</a>
								</div>
							<?php } ?>
							
							
						</div>
						<!--form-group-->	
					</form>
					<div class="form-group row add_extra_box imm_printing">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">PRINTING</h5></div>
					</div>
					<div id="printing_success"></div>
					<div class="form-group row  imm_upload">
					   {{ html()->label('Printing Completed')->class('col-md-4 form-control-label')->for('printing_status') }}
						<div class="col-md-8 col-sm-8">
							<input type="checkbox" name="printing_status" id="printing_status" value="1" {{ \App\Models\Job::printingStatus($job->id) ? 'checked' : ' '}}>
						</div>
					</div><!--form-group-->	
                    <div class="row imm_dsh_form_checked">
						<div class="col-md-6 col-lg-3">
							<strong>Status : </strong><span class="printing_span">{{ \App\Models\Job::printingStatus($job->id) ? 'PRINTING COMPLETED' : 'PRINTING INCOMPLETED'}} </span>
						</div>
						<div class="col-lg-4 col-md-6 text-center">
							<strong>Printing Complete Date : </strong> {{$job->printing_complete_date ? $job->printing_complete_date : 'N/A'}}
						</div>
					</div>
					<!-- Installer Section -->
					<div class="form-group row add_extra_box">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">INSTALLATION</h5></div>
					</div>
					<div class="form-group row">
						<div class="col-md-12">
							<div id="installer_success"></div>
						</div>
					</div>
					<form id="installation_form" method="post">
						<div class="form-group row">
							{{ html()->label('INSTALL DATE')->class('col-md-4 form-control-label')->for('install_date') }}
							 <div class="col-md-8">
								<div class="install_error" style="color:red;display:none"></div>
									<input type="text" name="install_date" value="{{ ($job->install_status != 6)? \App\Models\Installer::selectedInstaller($job->id)['date'] : "" }}" class="form-control install_date" id="install_date" placeholder="dd/mm/yyyy" required> 
							</div>
						</div><!--form-group-->
						
						<div class="form-group row">
							{{ html()->label('SELECT INSTALLER')->class('col-md-4 form-control-label')->for('installer') }}
							<div class="col-md-8">
								<select class="form-control select2" name="installer" id="installer" required="">
										<option disabled selected>Select Installer</option>
									@foreach(\App\Models\User::getAllInstallers() as $u)
										<option value="{{$u['id']}}" {{ (\App\Models\Installer::selectedInstaller($job->id)['installer'] == $u['id'] && $job->install_status != 6) ? 'selected' : '' }}>{{$u['name']}}</option>
									@endforeach
								</select>
							</div>
						</div><!--form-group-->
						
						<div class="form-group row ">
							<div class="col-md-12 text-right">
								{{ html()->button($text = "<i class='fas fa-plus-circle'></i> SAVE", $type = 'submit')->class('btn btn-success install_detail') }}
							</div>
						</div>
					</form>
					
					<div class="row imm_dsh_form_checked">
						<div class="col-md-6 col-lg-3">
							<strong>Status : </strong>{{\App\Models\Installer::statusofInstall($job->id)}}
						</div>
						<div class="col-md-6 col-lg-3 text-center">
							<strong>Install Date : </strong> {{ \App\Models\Installer::installDate($job->id) ? \App\Models\Installer::installDate($job->id) : 'N/A '}}
						</div>
							<div class="col-md-6 col-lg-3"> 
								<strong>Installed By : </strong> {{ \App\Models\Installer::getInstlleruser($job->id) ? \App\Models\Installer::getInstlleruser($job->id) : 'N/A '}}
							</div>	
						<?php if(\App\Models\Installer::installCompleted($job->id)){ ?>
							<div class="col-md-6 col-lg-3 text-center">
								<a href="{{ url('admin/jobs/download-install-file/'.$job->id) }}" >{{ html()->button($text = "Download Complete Install Pic", $type = 'button')->class('btn btn-outline-success') }}</a>
							</div>	
						<?php  } ?>	
					</div>
									
					<!-- Removal Section -->
					<div class="form-group row add_extra_box">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">Removal</h5></div>
					</div>
					
					<div class="form-group row">
						<div class="col-md-12">
							<div id="removal_success"></div>
						</div>
					</div>
					
					<form id="removal_form" method="post">
						<div class="form-group row">
							{{ html()->label('REMOVE DATE')->class('col-md-4 form-control-label')->for('remove_date') }}
							 <div class="col-md-8">
								<div class="removal_error" style="color:red;display:none"></div>
								{{ html()->text('remove_date')
									->class('form-control remove_date')
									->placeholder('dd/mm/yyyy')
									->required() }}
							</div>
						</div><!--form-group-->
						
						<div class="form-group row">
							{{ html()->label('SELECT REMOVAL')->class('col-md-4 form-control-label')->for('removal') }}
							<div class="col-md-8">
								<select class="form-control select2" name="removal" id="removal" required="">
										<option disabled selected>Select Removal</option>
									@foreach(\App\Models\User::getAllInstallers() as $u)
										<option value="{{$u['id']}}">{{$u['name']}}</option>
									@endforeach
								</select>
							</div>
						</div><!--form-group-->
						
						<div class="form-group row ">
							<div class="col-md-12 text-right">
								{{ html()->button($text = "<i class='fas fa-plus-circle'></i> SAVE", $type = 'submit')->class('btn btn-success removal_detail') }}
							</div>
						</div>
					</form>
					
					<div class="row imm_dsh_form_checked">
						<div class="col-md-6 col-lg-3">
							<strong>Status : </strong>{{\App\Models\Installer::statusofRemoval($job->id)}}
						</div>
						<div class="col-md-6 col-lg-3 text-center">
							<strong>Removal Date : </strong> {{ \App\Models\Installer::removeDate($job->id) ? \App\Models\Installer::removeDate($job->id) : 'N/A '}}
						</div>
						<div class="col-md-6 col-lg-3 text-center">
							<strong>Removed By : </strong> {{ \App\Models\Installer::removedby($job->id) ? \App\Models\Installer::removedby($job->id) : 'N/A '}}
						</div>
						<?php if(\App\Models\Installer::removedinstallCompleted($job->id)){ ?>
							<div class="col-md-6 col-lg-3 text-center">
								<a href="{{ url('admin/jobs/removal-download-file/'.$job->id) }}" >{{ html()->button($text = "Download Complete Install Pic", $type = 'button')->class('btn btn-outline-success') }}</a>
							</div>	
						<?php  } ?>	
						
					</div>
					@if($job->install_status == '6')
						<div class="row imm_dsh_form_checked imm_other_task add_extra_box">
						
						<h3 class="col-md-12">Removal Notes</h3>
							<div class="col-md-6">
								<strong>Notes : </strong>{{ $job->removal_note ? $job->removal_note : 'N/A '}}
							</div>
						</div>
					@endif
					
		
					<!-- Other Task Section -->
					<?php
					if (! empty($job->otherTask)) {

					?>
					<div class="form-group row add_extra_box">
						<div class="col-md-12"><h5 class="text-center add_txt_ex">Other Tasks</h5></div>
					</div>

					@foreach($job->otherTask as $key=>$oT)
						
					<div class="row imm_dsh_form_checked imm_other_task">
					
					<h3 class="col-md-12">Task{{$key+1}}</h3>
						<div class="col-md-3">
							<strong>Notes : </strong>{{$oT->notes}}
						</div>
						<div class="col-md-3 text-center">
							<strong>Task : </strong>{{\App\Models\OtherTask::otherTaskName($oT->task_id)}}
						</div>
						
						<div class="col-md-3 text-center">
							<strong>Task Completed Date: </strong>@if(!empty($oT->installer->other_task_completed_date)){{$oT->installer->other_task_completed_date}}	@endif
						</div> 
					
						<div class="col-md-3 text-center">
							<strong>Reference Pic : </strong>
							<?php
							if (! empty($oT->reference_pic)) {
								?>
								<img src="{{url($oT->reference_pic)}}" style="width:224px;height:auto;" />
								<br><br>
								<a href="{{ url('admin/jobs/downloadOtherTaskImage/'.$oT->id) }}" >{{ html()->button($text = " Download Reference Pic", $type = 'button')->class('btn btn-outline-success') }}</a> 	

							<?php
							} else {
								echo "No Reference Pic";
							}
							?>
						</div>
						<div class="col-md-3">
							<strong>Installed By : </strong>{{ \App\Models\Installer::taskInstlleruser($oT->id) ? \App\Models\Installer::taskInstlleruser($oT->id) : 'N/A '}}
						</div>
						<?php if(\App\Models\Installer::taskcompletedpic($oT->job_id, $oT->id)){ ?>
							<div class="col-md-6 col-lg-3 text-center">
								<a href="{{ url('admin/jobs/task-download-file/'.$oT->id) }}" >{{ html()->button($text = "Download Complete Install Pic", $type = 'button')->class('btn btn-outline-success') }}</a>
							</div>	
						<?php  } ?>
					</div>
					@if($oT->status == null)
						<div class ="row">
							<button type="button" class="btn btn-danger" data-toggle="modal"
								data-target="#taskInstallerModal{{$oT->id}}">
								<i class="fas fa-reply"></i> Assign Installer
							</button>
						</div>
					
					@elseif($oT->status == "1")
						<div class ="row">
							<button type="button" class="btn btn-success">
								Task Completed
							</button>
						</div>
					@elseif($oT->status == "2")
						<div class ="row">
							<button type="button" class="btn btn-danger">
								Task Not Completed
							</button>
						</div>
					
					@endif
					<hr>
					
	
					<!-- other task installer add modal -->

					<form method="post" class="taskInstaller">
						@csrf
						<!-- Modal -->
						<div class="modal" tabindex="-1" role="dialog" id="taskInstallerModal{{$oT->id}}">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="alert alert-danger" style="display: none"></div>
									<div class="modal-header">

										<h5 class="modal-title">Task Installer</h5>
										<button type="button" class="close" data-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<div id="task_installer_success{{$key}}">
											</div>
										</div>
									</div>
									
									<div class="modal-body">
										<div class="form-group row">
											{{ html()->label('INSTALL DATE')->class('col-md-4 form-control-label')->for('task_installer_date') }}
											<div class="task_install_error" style="color:red;display:none"></div>
												
											<div class="col-md-8">
												<div class="removal_error" style="color:red;display:none"></div>
												<input type="text" class="form-control task_installer_date" id="task_installer_date{{$key}}" name="task_install_date" placeholder="dd/mm/yyyy" required >
											</div>
										</div>
										
										<div class="form-group row">
											{{ html()->label('SELECT INSTALLER')->class('col-md-4 form-control-label')->for('task_installer') }}
											<div class="col-md-8">
												<select class="form-control select2" name="task_installer" id="task_installer{{$key}}" required="">
													<option disabled selected>Select Installer</option>
													@foreach(\App\Models\User::getAllInstallers() as $u)
														<option value="{{$u['id']}}">{{$u['name']}}</option>
													@endforeach
												</select>
											</div>
										</div><!--form-group-->
										<input type="hidden" id="task_id" value="{{$oT->id}}" name="task_id"/>
										<input type="hidden" value="{{$key}}" name="key"/>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										{{ html()->button($text = "<i class='fas fa-plus-circle'></i> SAVE", $type = 'submit')->class('btn btn-success') }}
									</div>
								</div>
							</div>
						</div>
					</form>	
										
					@endforeach
					
					<?php
					}
					?>
					<input type="hidden" id="job_id" value="{{$job->id}}" />
					<input type="hidden" id="install_state" value="{{ $job->install_status }}" />
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection