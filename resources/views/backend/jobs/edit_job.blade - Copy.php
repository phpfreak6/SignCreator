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
		<div class="form-group row">
				<div class="col-md-12 text-center">
					<h3>#{{ $job->id }}</h3>
				</div>
			</div><!--form-group-->
         	<div class="form-group row">
				<div class="col-md-12 text-center">
					<h3>{{ $job->pro_address }}</h3>
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				<div class="col-md-12 text-center">
					<h3>{{ $job->users->name }}<h3>
				</div>
			</div><!--form-group-->
			
			<div class="form-group row add_extra_box">
			   <div class="col-md-12"><h5 class="text-center add_txt_ex">INSTALL STATUS</h5></div>
				{{ html()->label('Install Status')->class('col-md-4 form-control-label')->for('sign_type') }}
				<div class="col-md-8">
					{{ \App\Models\Install::Status()[$job->installstatus->install_status] }}
				</div>
			</div><!--form-group-->
			<div class="form-group row add_extra_box">
				<div class="col-md-12"><h5 class="text-center add_txt_ex">JOB DETAIL</h5></div>
			</div>
			<div class="form-group row">
				{{ html()->label(__('jobs.size'))->class('col-md-4 form-control-label')->for('size') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.size')[$job->size]) ? Config::get('constant.size')[$job->size] : 'N/A' }}
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.orientation'))->class('col-md-4 form-control-label')->for('orientation') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.orientation')[$job->orientation]) ? Config::get('constant.orientation')[$job->orientation] : 'N/A' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.listing_type'))->class('col-md-4 form-control-label')->for('listing_type') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.listing_type')[$job->listing_type]) ? Config::get('constant.listing_type')[$job->listing_type] : 'N/A' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.quantity'))->class('col-md-4 form-control-label')->for('quantity') }}
				<div class="col-md-8">
				{{ $job->quantity }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.v_board'))->class('col-md-4 form-control-label')->for('v_board') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.v_board')[$job->v_board]) ? Config::get('constant.v_board')[$job->v_board] : 'N/A' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.overlays'))->class('col-md-4 form-control-label')->for('overlays') }}
				 <div class="col-md-8">
					{{ $job->overlays }}	
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.install_notes'))->class('col-md-4 form-control-label')->for('install_notes') }}
				 <div class="col-md-8">
					{{ $job->install_notes }}	
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
				 <div class="col-md-8">
					{{ ($job->terms_conditions) ? 'True' : 'False' }}	
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.marketing_confirm'))->class('col-md-4 form-control-label')->for('marketing_confirm') }}
				 <div class="col-md-8">
				
				 {{ ($job->marketting_confirm) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
			 <div class="col-md-8">
				 {{ ($job->install_pic_check) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
				 <div class="col-md-8">
				{{ ($job->terms_conditions_2) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.marketing_conditions'))->class('col-md-4 form-control-label')->for('marketing_conditions') }}
				 <div class="col-md-8">
				{{ ($job->marketting_conditions) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.anti_grafiti_lami'))->class('col-md-4 form-control-label')->for('anti_grafiti_lami') }}
				 <div class="col-md-8">
				 {{ ($job->anti_grafiti_lamin) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.flag_holder'))->class('col-md-4 form-control-label')->for('flag_holder') }}
				 <div class="col-md-8">
				  {{ ($job->flag_holder) ? 'True' : 'False' }}
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.solor_spotlight'))->class('col-md-4 form-control-label')->for('solor_spotlight') }}
				 <div class="col-md-8">
				{{ ($job->solor_spot) ? 'True' : 'False' }}
				 
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->label('Artwork')->class('col-md-4 form-control-label')->for('solor_spotlight') }}
				 <div class="col-md-8">
				{{ ($job->solor_spot) ? 'True' : 'False' }}
				 
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				<a href="jobs/{{$job->id}}/edit" >{{ html()->button($text = "<i class='fas fa-edit'></i> Edit", $type = 'button')->class('btn btn-success') }}</a>
			</div>
			<div class="form-group row add_extra_box">
				<div class="col-md-12"><h5 class="text-center add_txt_ex">ARTWORK</h5></div>
			</div>	
			
			<div class="form-group row">
                        {{ html()->label('Upload Artwork')->class('col-md-3 form-control-label')->for('artwork_file') }}
                        <div class="col-md-5">
                           	{{ html()->file('artwork_file', ' ')
							->class('form-control')
							->required() }}
                        </div>
            </div><!--form-group-->
			<div class="form-group row">
				{{ html()->button($text = "<i class='fas fa-upload'></i> SEND", $type = 'button')->class('btn btn-success send_artwork') }}
			</div>
			
			<div class="form-group row add_extra_box">
				<div class="col-md-12"><h5 class="text-center add_txt_ex">PRINTING</h5></div>
			</div>
			
			<div class="form-group row">
			   {{ html()->label('Printing Status')->class('col-md-4 form-control-label')->for('sign_type') }}
				<div class="col-md-8">
					Printing Completed
				</div>
			</div><!--form-group-->	

			<div class="form-group row add_extra_box">
				<div class="col-md-12"><h5 class="text-center add_txt_ex">INSTALLATION</h5></div>
			</div>
			
			<div class="form-group row">
				{{ html()->label('INSTALL DATE')->class('col-md-4 form-control-label')->for('install_date') }}
				 <div class="col-md-8">
					{{ html()->date('install_date')
						->class('form-control')
						->required() }}
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->label('SELECT INSTALLER')->class('col-md-4 form-control-label')->for('installer') }}
				<div class="col-md-8">
					<select class="form-control select2" name="installer" id="installer" required="">
							<option disabled selected>Select Installer</option>
						@foreach(\App\Models\User::getUsers() as $u)
							<option value="{{$u['id']}}">{{$u['name']}}</option>
						@endforeach
					</select>
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->button($text = "<i class='fas fa-plus-circle'></i> SAVE", $type = 'button')->class('btn btn-success install_detail') }}
			</div>
			<input type="hidden" id="job_id" value="{{$job->id}}" />
			</div>
        </div>
    </div>
</div>
<script>
	$('.send_artwork').on('click', function () {
		
		var job_id = $('#job_id').val();
        var file_data = $('#artwork_file').prop('files')[0];
		
		$.ajax({
               'type':'POST',
               'url':'jobs/upload-artwork',
			   'headers': {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               'data':{job_id : job_id, image : file_data},
			   contentType: false,
               cache: false,
               processData:false,
               success:function(data) {
                  console.log(data);
               }
        });
		
		
    });
</script>