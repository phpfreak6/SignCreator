@extends('frontend.layouts.app')

@section('title')
Comment
@stop
@section('content')
<link href="{{ asset('css/zoomove.min.css') }}" rel="stylesheet" />
<style>

@keyframes zooAnime {
	0% {
		fill-opacity: 0;
		stroke-dashoffset: 2064;
	}
	20% {
		fill-opacity: 0;
		stroke: #2c3e50;
	}
	100% {
		fill-opacity: 1;
		stroke-dashoffset: 0;
	}
}
@keyframes textAnime {
	0% {
		opacity: 0;
	}
	20% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}
.item {
	position: relative;
	width: 100%;
	height: 300px;
	margin-bottom: 25px;
}
.item .zoo-item {
	border: 1px solid #EEEEEE;
	margin: 10px;
}
.artwor_image{
	position: relative;
   
    height: 700px;
}
</style>
		<div class="container">
		<div class="form-group row">
					<div class="col-md-12 text-center">
									<a href="{{url('/')}}/artwork/accept/{{$artwork->token}}">{{ html()->button($text = "<i class='fas fa-check'></i> Approve", $type = '')->class('btn btn-success artwork_accept') }}</a>
				
									{{ html()->button($text = "<i class='fas fa-times'></i> Decline", $type = '')->class('btn btn-danger artwork_decline') }}
					</div>
		</div>
		<div class="form-group row ">
		<div class="col-md-12 text-center">
			<div class="image-zoom">
				<!--button id="zoom-in" ><i class="fa fa-search-plus" aria-hidden="true"></i></button>
				<button id="zoom-out" ><i class="fa fa-search-minus" aria-hidden="true"></i></button-->

				<div class="artwor_image" id="artwork_zoom_click">
							<!--img src="{{ asset($artwork->artwotk_image) }}"  /-->
						<figure class="zoo-item"  data-zoo-scale="1.5" data-zoo-image="{{ asset($artwork->artwotk_image) }}">Loading...</figure>
					</div>
				</div>
			</div>	
		</div>
			 <a href="{{ url('jobs/downloadArtworkImage/'.$artwork->id) }}" target="_self" style="margin-bottom: 25px; 
    margin-left: 425px; 
    background-color: #4CAF50;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;">Download Artwork</a> 	
		 
			<div class="modal" id="CommentModal"  >
			  <div class="modal-dialog">
				<div class="modal-content">

				  <!-- Modal Header -->
				  <div class="modal-header">
					<h4 class="modal-title">Reason Of Decline</h4>
					
				  </div>

				  <!-- Modal body -->
				  <div class="modal-body">
					<form id="artwork_comment" action="{{url('/')}}/comment/save/{{$artwork->token}}"  method="post">
					@csrf
					<div class="form-group row">
						{{ html()->label('Reason')->class('col-md-4 form-control-label')->for('Comment') }}
						
								<div class="col-md-8">
									{{ html()->textarea('artwotk_comment', ' ')
									->class('form-control')
									->required() }}
								</div>
								
					</div><!--form-group-->
				    <div class="form-group row">
					<div class="col-md-4">
									{{ html()->button($text = "<i class='fas fa-upload'></i> SEND", $type = 'submit')->class('btn btn-success comment') }}
					</div>
					</div>
					</form>
					</div>
				</div>	
					
				</div>
				</div>
			</div>
		
@endsection