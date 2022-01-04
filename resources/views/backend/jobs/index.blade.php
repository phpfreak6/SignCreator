@extends('backend.layouts.app') @section('content')

<div class="card">
	<div class="card-body report_main">
		<div class="row">
			<div class="col-8">@include('flash::message')</div>
		</div>
	

@if((Request::segment(1) =="admin") && (Request::segment(2) =="jobs") && (Request::segment(3) =="reporting"))
<!-- reporting datatable -->
	<div class="row">
			<div class="col-md-8">
				<h4 class="card-title mb-0 record_head">
					Reporting 
				</h4>

			</div>
			
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<div class="rd_start_end">
					<div class="form-group">
    					<h5>
    					Start Date <span class="text-danger"></span>
    					</h5>
    					<div class="controls">
    						<input type="date" name="start_date" id="start_date"
    						class="form-control form-control-sm datepicker-autoclose"
    						placeholder="Please select start date">
    						<div class="help-block"></div>
    					</div>
					</div>
					<div class="form-group">
        				<h5>
        					End Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="end_date" id="end_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select end date">
        					<div class="help-block"></div>
        				</div>
        			</div>
					<div class="form-group ">
        				<div class="text-left">
        					<button type="text" id="btnFiterSubmitSearch" class="btn btn-info">Submit</button>
        				</div>
					</div>
				</div>
				
			</div>		
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Install Date</h4>
    			<div class="rd_start_end">
    				<div class="form-group ">
        				<h5>
        					 Start Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="install_start_date" id="install_start_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select start date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group ">
        				<h5>
        					End Date<span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="install_end_date" id="install_end_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select end date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group">
        				<div class="text-left" >
        					<button type="text" id="btnInstallFiterSubmitSearch" class="btn btn-info">Submit</button>
        				</div>
        			</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
    			<h4>Printing Complete Date</h4>
    			<div class="rd_start_end">
        			<div class="form-group">
        				<h5>
        					 Start Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="printing_start_date" id="printing_start_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select start date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group">
        				<h5>
        					End Date<span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="printing_end_date" id="printing_end_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select end date">
        					<div class="help-block"></div>
        				</div>
					</div>
					<div class="form-group ">
        				<div class="text-left" >
        					<button type="text" id="btnprintingFiterSubmitSearch" class="btn btn-info">Submit</button>
        				</div>
        			</div>
    			</div>
			</div>			
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Task Complete Date</h4>
				<div class="rd_start_end">
					<div class="form-group">
        				<h5>
        					 Start Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="task_start_date" id="task_start_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select start date">
        					<div class="help-block"></div>
        				</div>
					</div>
					<div class="form-group ">
        				<h5>
        					End Date<span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="task_end_date" id="task_end_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select end date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group">
        				<div class="text-left" >
        					<button type="text" id="btnTaskFiterSubmitSearch" class="btn btn-info">Submit</button>
        				</div>
        			</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Install Complete Date</h4>
				<div class="rd_start_end">
    				<div class="form-group ">
        				<h5>
        					 Start Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="install_complete_start_date" id="install_complete_start_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select start date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group">
        				<h5>
        					End Date <span class="text-danger"></span>
        				</h5>
        				<div class="controls">
        					<input type="date" name="install_complete_end_date" id="install_complete_end_date"
        						class="form-control form-control-sm datepicker-autoclose"
        						placeholder="Please select end date">
        					<div class="help-block"></div>
        				</div>
        			</div>
        			<div class="form-group ">
        				<div class="text-left">
        					<button type="text" id="btnInstallCompleteFiterSubmitSearch" class="btn btn-info">Submit</button>
        				</div>
        			</div>
				</div>
			</div>
		</div>
	
		<table class="table table-hover table-responsive-sm data_table_reporting hrefReporting">
			<thead>
				<tr>
					<th>#ID</th>
					<th>{{ __('jobs.property_address') }}</th>
					<th>SUBURB</th>
					<th>CLIENT</th>
					<th>INSTALL DATE</th>
					<th>INSTALLER</th>
					<th>STATUS</th>
					<th class="text-right">{{ __('labels.backend.action') }}</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		@else
		<!--  Admin Jobs section -->
			<div class="row">
			<div class="col-8">
				<h4 class="card-title mb-0">
					Admin Portal
				</h4>
			</div>			
			<div class="col-md-4">			
				<div class="form-group rep_create">		
					<!--a href="{{ url('admin/jobs/import-jobs') }}" class="btn btn-warning " data-toggle="tooltip" title="Create New"><i class="fa fa-plus-circle"></i> Import</a-->					
					<a href="{{ url('admin/jobs/create') }}" class="btn btn-success " data-toggle="tooltip" title="Create New"><i class="fa fa-plus-circle"></i> Create</a>	
				</div>			
			</div>
		</div>
		<div class="row float-right">
			<div class="form-group col-md-2">
				<div class="" style="margin-top: 20%;">
					<select id="installStatusFilter"
						class="form-control form-control-sm adjustStatusfilter">
						<option value="0" selected>All Jobs</option>
						@foreach(\App\Models\Job::Status() as $key => $s)
						<option value="{{$key}}">{{$s}}</option> @endforeach
					</select>
				</div>
			</div>
		</div>

		<table class="table table-hover table-responsive-sm data_table_admin">
			<thead>
				<tr>
					<th>#ID</th>
					<th>{{ __('jobs.property_address') }}</th>
					<th>SUBURB</th>
					<th>CLIENT</th>
					<th>INSTALL DATE</th>
					<th>INSTALLER</th>
					<th>STATUS</th>
					<th class="text-right">{{ __('labels.backend.action') }}</th>
					<th>POST CODE</th>
					<th>STATE</th>
					<th>SIZE</th>
					<th>OVERLAYS</th>
					<th>INSTALLATION NOTES</th>
					<th>PROPERTY TYPE</th>
					<th>SIGN TYPE</th>
					<th>ORIENTATION</th>
					<th>LISTING TYPE</th>
					<th>QUANTITY</th>
					<th>V BOARD</th>
					<th>ARTWORK REQUIRED</th>
					<th>Anti Grafiti Lamination</th>
					<th>FLAG HOLDER</th>
					<th>SOLAR SPOT</th>
					<th>AGENT NAMEPLATE</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		
		@endif
		
		<div id="buttons"></div>
	</div>

</div>
<div id="jobModal" class="modal fade" tabindex="-1" role="dialog"
	aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 id="modalTitle"></h3>
				<button type="button" class="close" data-dismiss="modal"
					aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="modalhtml"></div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</div>
		</div>
	</div>
</div>
@endsection
