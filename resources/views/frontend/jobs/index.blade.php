@extends('frontend.layouts.app')

@section('content')

<div class="section-content">
   <div class="content-center">
        <div class="container">
            <h1 class="title text-center job_heading">
                Active Jobs
            </h1>
            
			@include('flash::message')
			@if(Auth::user()->hasRole('super admin') || Auth::user()->hasRole('print'))
			<form method='post' action='/uploadFile' enctype='multipart/form-data' >
				{{ csrf_field() }}
				<input type='file' name='file' required>
				<input type='submit' name='submit' value='Import'>
			  </form>
			@endif
			
			
            <div class="search_and_show">
			   <!--div class="search_data"><label>Search</label><input type="text" id="search"/> <button id="search_btn">Submit</button></div-->
			   <div class="show_data_all"><label>Show All</label> <input type="checkbox" name="all_data" id="showAllCheckbox"/> </div>
			</div>
		@if(Auth::user()->hasRole('super admin') || Auth::user()->hasRole('user') || Auth::user()->hasRole('print') )
			<table id="data_table" class="table table-hover table-responsive-sm data_table hrefDataTable">
				<thead>
					<tr>
					    <th>#ID</th>
						<th>{{ __('jobs.property_address') }}</th>
						<th>SUBURB</th>
						<th>{{ __('jobs.property_type') }}</th>
						<th>{{ __('jobs.sign_type') }}</th>
						<th>{{ __('jobs.size') }}</th>
						<th> STATUS</th>
						<th class="text-right">{{ __('labels.backend.action') }}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			@endif
			
			@role('installer')
			<table id="data_table" class="table table-hover table-responsive-sm data_table_installer hrefDataTable">
				<thead>
					<tr>
					    <th>#ID</th>
						<th>CLIENT</th>
						<th>{{ __('jobs.property_address') }}</th>
						<th>SUBURB</th>
						<th> STATUS</th>
						<th> TYPE</th>
						<th> OTHER TASK</th>
						<th class="text-right">{{ __('labels.backend.action') }}</th>
						<th>LATITUDE</th>
						<th>LONGITUDE</th>
						<th>POSITION</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			@endrole
        </div>
    </div>
</div>

@endsection
<script>
var sizes = <?php
echo json_encode(Config::get('constant.size'));
?>;
var job_pro_type = <?php

echo json_encode(Config::get('constant.prop_type'));
?>;
var job_sign_type = <?php

echo json_encode(Config::get('constant.sign_type'));
?>;
</script>