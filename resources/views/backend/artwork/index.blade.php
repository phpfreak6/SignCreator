@extends('backend.layouts.app')

@section('title')
{{ $module_action }} {{ $module_title }} | {{ app_name() }}
@stop

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{!!route('backend.dashboard')!!}"><i class="icon-speedometer"></i> Dashboard</a></li>
<li class="breadcrumb-item active"><i class="{{ $module_icon }}"></i> {{ $module_title }}</li>
@stop


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h4 class="card-title mb-0">
                    <i class="{{ $module_icon }}"></i> {{ $module_title }} <small class="text-muted">Data Table {{ $module_action }}</small>
                </h4>
                <div class="small text-muted">
                    {{ __('labels.backend.users.index.sub-title') }}
                </div>
            </div>
            <!--/.col-->
        </div>
        <!--/.row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="datatable" class="table table-hover ">
                        <thead>
                            <tr>
                                <th>Nickname</th>
                                <th>Name</th>
                                <th>PDF Width(mm)</th>
                                <th>PDF Height(mm)</th>
                                <th>Template Width(px)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-7">
                <div class="float-left">

                </div>
            </div>
            <div class="col-5">
                <div class="float-right">

                </div>
            </div>
        </div>
    </div>
</div>

	<!--  Artwork template modal -->
	<div class="modal fade artwork_editor_crop" id="artwork_template" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<form method="post" action="" id="assign_template_form" class="form-horizontal" role="form">
					<div class="card card-accent-info mb-0">
						<div class="card-header">
							<strong>Assign Template: <span class="template_name"></span></strong>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						</div>
						<div class="card-body">
							<div class="row body_data"></div>							
						</div>
						<input type="hidden" name="template_id" id="selected_template_id" value="">
						<div class="popup-butn text-right pr-2 pb-2"><button type="submit" id="save_assign" class="btn btn-primary">Save</button></div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
@stop

@push ('after-scripts')

<script type="text/javascript">

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: true,
       // responsive: true,
		orderable: false,
        ajax: '{{ route("backend.$module_name.artwork-templates") }}',
        columns: [
            {data: 'nickname', name: 'nickname'},
            {data: 'name', name: 'name'},
            {data: 'pdf_width', name: 'pdf_width'},
            {data: 'pdf_height', name: 'pdf_height'},
            {data: 'template_width', name: 'template_width'},
            {data: 'action', name: 'action', searchable: false, orderable: false,}
        ]
    });

</script>
@endpush
