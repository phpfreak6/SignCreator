@extends('frontend.layouts.app')

@section('content')

<div class="page-header">
    <div class="page-header-image" data-parallax="true">
    </div>
    <div class="content-center">
        <div class="container">
            <h1 class="title text-center">
                Welcome to {{ config('app.name', 'SignCreators') }}
            </h1>
            
            @include('flash::message')

            @can('view_backend')
            <a href="{{ route('backend.dashboard') }}" class="btn btn-primary btn-lg btn-round">Dashboard</a>
            @endcan
        </div>
    </div>
</div>

@endsection
