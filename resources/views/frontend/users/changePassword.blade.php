@extends('frontend.layouts.app')

@section('title')
{{auth()->user()->name}}'s Profile  | {{ app_name() }}
@stop


@section('content')

<div class="page-header page-header-small imm_pwd_main" filter-color="orange">
    <!--div class="page-header-image" data-parallax="true" >
    </div-->
    <div class="container-fluid">
        <div class="content-center imm_change_pwd">
            <!-- div class="photo-container">
                <img src="{{asset($user->avatar)}}" alt="{{auth()->user()->name}}">
            </div-->
            <h3 class="title">{{auth()->user()->name}}</h3>
            <p class="category">({{auth()->user()->email}})</p>
        </div>
    </div>
</div>
<div class="section imm_pwd_form">
    <div class="container">
        <h5 class="title">Change Password</h5>
        @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{$error}}</li>
        @endforeach
        <div class="row mt-4 mb-4">
            <div class="col">
                {{ html()->form('PATCH')->class('form-horizontal')->open() }}

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.password'))->class('col-md-3 form-control-label')->for('password') }}

                    <div class="col-md-9">
                        {{ html()->password('password')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.users.fields.password'))
                            ->required() }}
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    {{ html()->label(__('labels.backend.users.fields.password_confirmation'))->class('col-md-3 form-control-label')->for('password_confirmation') }}

                    <div class="col-md-9">
                        {{ html()->password('password_confirmation')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.users.fields.password_confirmation'))
                            ->required() }}
                    </div>
                </div><!--form-group-->

                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    {{ html()->button($text = "<i class='fas fa-save'></i>&nbsp;Save", $type = 'submit')->class('btn btn-success') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->closeModelForm() }}
            </div>
            <!--/.col-->
        </div>

    </div>
</div>

@endsection
