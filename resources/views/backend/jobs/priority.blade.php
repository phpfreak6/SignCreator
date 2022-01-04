@extends('backend.layouts.app') @section('content')

<div class="card">
	<div class="card-body">

		<!--  Installer Priority section -->
			<div class="row">
			<div class="col-8">
				<h4 class="card-title mb-0">
					Installer Priority
				</h4>

			</div>
		</div>
		<br>
		<div class="row">

			
			
			<div class="form-group col-md-3">
				<h5>
					Install Date <span class="text-danger"></span>
				</h5>
				<div class="controls">
					<input type="date" name="install_date"
						id="install_date"
						class="form-control form-control-sm datepicker-autoclose">
					<div class="help-block"></div>
				</div>
			</div>
			
			
			<div class="form-group col-md-3">
				<h5>
					Select Installer<span class="text-danger"></span>
				</h5>
				<select class="form-control" id="installer_select_id">
							<option value="0" disabled>Select User</option>
			
							@foreach(\App\Models\User::getInstallersEmail() as $key => $value)
							    <option value="{{$key}}" >{{$value}}</option>   
							@endforeach
						</select>
			</div>
			<div class="form-group col-md-2">
				<div class="text-left" style="margin-top: 18%;">
					<button type="text" id="installerPrioritySubmitSearch" class="btn btn-info">Submit</button>
				</div>
			</div>

		</div>
		<table class="table table-hover table-responsive-sm data_table_priority hrefPriority">
			<thead>
				<tr>
				
					<th>#ID</th>
					<th>{{ __('jobs.property_address') }}</th>
					<th>SUBURB</th>
					<th>INSTALL DATE</th>
					<th>STATUS</th>
						<th>POSITION</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		
		<div id="buttons"></div>
	</div>

</div>

@endsection
