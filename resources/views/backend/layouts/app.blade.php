<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="author" content="Nasir Khan Saikat http://nasirkhn.com">
    <meta name="keyword" content="{{ setting('meta_keyword') }}">
    <link rel="shortcut icon" href="/img/favicon.png">
    <link type="text/plain" rel="author" href="{{asset('humans.txt')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'SignCreators') }}</title>

    @stack('before-styles')

    <link rel="stylesheet" href="{{ asset('css/app_backend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom_backend.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('js/alerts/jquery-confirm.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <!-- simple-line-icons -->
    <link rel="stylesheet" href="{{asset('plugins/simple-line-icons/css/simple-line-icons.css')}}">
	<link href="{{asset('vendor/datatable/datatables.min.css')}}" rel="stylesheet" />
	

    @stack('after-styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">

    <!-- Header Block -->
    @include('backend.includes.header')
    <!-- / Header Block -->

    <div class="app-body">

        <!-- Sidebar -->
        @include('backend.includes.sidebar')
        <!-- /Sidebar -->

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                @yield('breadcrumbs')

                <!-- Breadcrumb Menu-->
                <li class="breadcrumb-menu d-md-down-none">
                    <div class="btn-group" role="group" aria-label="Button group">
                        {{ \Carbon\Carbon::now('+10:00')->format('l, F d, Y') }}&nbsp;<div id="openClockDisplay" class="clock" onload="showTime()"></div>
                    </div>
                </li>
            </ol>


            <div class="container-fluid">

                <div class="animated fadeIn">

                    @include('flash::message')

                    <!-- Errors block -->
                    @include('backend.includes.errors')
                    <!-- / Errors block -->

                    @yield('content')

                </div>
                <!-- / animated fadeIn -->

            </div>
            <!-- /.conainer-fluid -->
        </main>

        <!-- aside block -->
        @include('backend.includes.aside')
        <!-- / aside block -->


    </div>

    <!-- Footer block -->
    @include('backend.includes.footer')
    <!-- / Footer block -->

    <!-- Scripts -->
    @stack('before-scripts')

    <script src="{{ asset('js/app_backend.js') }}"></script>
	<script src="{{ asset('vendor/datatable/datatables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/buttons.print.min.js') }}"></script>
	<script src="{{ asset('js/jquery-ui.js') }}"></script>
	<script src="{{ asset('js/custom_backend.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/alerts/jquery-confirm.js') }}" type="text/javascript"></script>
<!-- 	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKUKd-6hyJBssh9DsRy-vpp6y_xSp9_Cg&libraries=places"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
	
	const BASE_URL = '<?= url('/') ?>';
    $(function () {	
		$('#flag_holder').click(function(){
			if($(this).prop("checked") == true){
				$(this).val('1');
			}else{
				$(this).val('0');
			}
		});
        $('[data-toggle="tooltip"]').tooltip();

        $('#flash-overlay-modal').modal();

        showTime();
    })

    function showTime(){
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();

        var session = hours >= 12 ? 'pm' : 'am';

        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0'+minutes : minutes;

        var time = hours + ":" + minutes + ":" + seconds + " " + session;
        document.getElementById("openClockDisplay").innerText = time;
        document.getElementById("openClockDisplay").textContent = time;

        setTimeout(showTime, 1000);
    }

    </script>

    @stack('after-scripts')
</body>
</html>
