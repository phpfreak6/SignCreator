
@extends('frontend.layouts.app')

@section('title')
Job View
@stop
@section('content')
<div class="content-page">
    <div class="page-header-image" data-parallax="true">
    </div>
    <div class="content-center">
        <div class="container">
         	<div class="form-group row">
				{{ html()->label(__('jobs.property_address'))->class('col-md-4 form-control-label')->for('property_address') }}
				<div class="col-md-8">
					{{ $job->pro_address }}
				</div>
			</div><!--form-group-->
			<div class="form-group row">
				{{ html()->label(__('jobs.property_type'))->class('col-md-4 form-control-label')->for('property_type') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.prop_type')[$job->pro_type]) ? Config::get('constant.prop_type')[$job->pro_type] : 'N/A' }}
				</div>
			</div><!--form-group-->
			
			<div class="form-group row">
				{{ html()->label(__('jobs.sign_type'))->class('col-md-4 form-control-label')->for('sign_type') }}
				<div class="col-md-8">
					{{ isset(Config::get('constant.sign_type')[$job->sign_type]) ? Config::get('constant.sign_type')[$job->sign_type] : 'N/A' }}
				</div>
			</div><!--form-group-->
			
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
			</div>
			 <div class="form-group row">
				{{ html()->label(__('jobs.termsncondi'))->class('col-md-4 form-control-label')->for('termsncondi') }}
				 <div class="col-md-8">
					{{ ($job->terms_conditions) ? 'True' : 'False' }}	
				</div>
			</div>
			<div class="form-group row">
				{{ html()->label(__('jobs.marketing_confirm'))->class('col-md-4 form-control-label')->for('marketing_confirm') }}
				 <div class="col-md-8">
				
				 {{ ($job->marketting_confirm) ? 'True' : 'False' }}
				</div>
			</div> 
			<div class="form-group row">
				{{ html()->label(__('jobs.installation_pic_check'))->class('col-md-4 form-control-label')->for('install_pic_check') }}
			 <div class="col-md-8">
				 {{ ($job->install_pic_check) ? 'True' : 'False' }}
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
        </div>
    </div>
</div>

@endsection