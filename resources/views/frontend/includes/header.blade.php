<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary navbar-transparent"
	color-on-scroll="400">
	<div class="container">
		<div class="navbar-translate">
			<!-- rel="tooltip" title="{{ config('app.name', 'SignCreators') }} - Application Landing Page" data-placement="bottom" -->
			<a class="navbar-brand" href="/"> <img class="navbar-brand-full"
				src="{{ asset('img/logo.png') }}" alt="Logo">
			</a>
			<button class="navbar-toggler navbar-toggler" type="button"
				data-toggle="collapse" data-target="#navigation"
				aria-controls="navigation-index" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-bar bar1"></span> <span
					class="navbar-toggler-bar bar2"></span> <span
					class="navbar-toggler-bar bar3"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse justify-content-end"
			id="navigation"
			data-nav-image="{{asset('/vendor/now-ui-kit/img/blurred-image-1.jpg')}}">
			<ul class="navbar-nav">
				@can('view_backend')
				<li class="nav-item"><a class="nav-link"
					href="{{ route('backend.dashboard') }}"> <i
						class="now-ui-icons tech_tv"></i> Admin Dashboard
				</a></li> @endcan @guest
				<li class="nav-item"><a class="nav-link"
					href="{{ route('frontend.auth.register') }}"> Register </a></li>
				<li class="nav-item"><a class="nav-link"
					href="{{ route('frontend.auth.login') }}"> <i
						class="now-ui-icons objects_key-25"></i> Login
				</a></li> @else @role('super admin')

				<li class="nav-item"><a class="nav-link" href="/jobs/create"> Add
						New Job </a></li> @endrole @role('user')

				<li class="nav-item"><a class="nav-link" href="/jobs/create"> Add
						New Job </a></li>

				<li class="nav-item"><a class="nav-link" href="/jobs/list"> Jobs </a>
				</li> @endrole
				<li class="nav-item"><a class="nav-link" href="#"> Accessory Order </a>
				</li>
				<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
					href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name
						}} </a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					 
					 @if(Auth::user()->hasRole('super admin') || Auth::user()->hasRole('print'))
					 <a class="dropdown-item"
							href="{{ route('frontend.users.profile', auth()->user()->id) }}">Profile</a>
						@endif
						
						
						<a class="dropdown-item"
							href="{{ route('frontend.users.changePassword', auth()->user()->id) }}">Change
							Password</a> <a class="dropdown-item"
							href="{{ route('frontend.auth.logout') }}"> Logout </a>
					</div></li> @endguest
			</ul>
		</div>
	</div>
</nav>
<section class="site_time">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="imm_timer btn-group float-right" role="group"
					aria-label="Button group">
					{{ \Carbon\Carbon::now('+10:00')->format('l, F d, Y') }}&nbsp;
					<div id="openClockDisplay" onload="showTime()"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End Navbar -->
