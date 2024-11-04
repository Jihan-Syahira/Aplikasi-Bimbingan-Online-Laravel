<!DOCTYPE html>
<html>
<head>
	<title>{{$title}} | {{env('APP_NAME')}}</title>
    <link rel="shortcut icon" href="{{ asset('landing/img/favicon.ico')}}" />
    <link href="{{ asset('landing/css/css.css') }}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" >
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Template Main CSS File -->
    <link href="{{ asset('landing/css/template.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/custom-web.css') }}" rel="stylesheet">
    <link href="{{ asset('landing/css/uinsu.css') }}" rel="stylesheet">
    <!-- Calendar css -->
    <link rel="stylesheet" href="{{ asset('assets/css/calendar/core/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/calendar/daygrid/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/calendar/timegrid/main.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bower_components/font-awesome-free-6/css/all.css') }}">
    
    <!-- SweetAlert 2 -->
    <script src="{{ asset('assets/dist/sweetalert2/sweetalert2.all.min.js') }}">
    </script>
    <link rel="{{ asset('assets/dist/sweetalert2/sweetalert2.min.css') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0">
    
    <header id="header" class="fixed-top d-flex align-items-center header-scrolled">
        <div class="container d-flex align-items-center justify-content-between">

			<div class="logo">
                <a href="#"><img src="{{asset('landing/img/logo.png')}}" alt="" class="img-fluid"></a>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto {{ (request()->is('/')) ? 'active' : '' }}" href="{{url('/')}}">Home</a></li>
                    <li><a class="nav-link scrollto {{ (request()->is('agenda')) ? 'active' : '' }}" href="{{url('/agenda')}}">Agenda</a></li>
					<li class="dropdown"><a href="#" class="{{ (request()->is('jadwal/*')) ? 'active' : '' }}"><span>Jadwal Bimbingan</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{route('public.kp')}}">Kerja Praktik</a></li>
                            <li><a href="{{route('public.pengajuan')}}">Pengajuan Tugas Akhir</a></li>
                            <li><a href="{{route('public.ta')}}">Tugas Akhir</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="{{route('login')}}">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->
	<div class="site-header general-header headerone">
		<div id="sticky-wrapper" class="sticky-wrapper" style="height: 102.266px;">
			<div class="bottom-header">
				<div class="container">
					<div class="header-middle-inner">
						<div class="site-branding logo">
							<a href="#" class="custom-logo-link" rel="home" aria-current="page">
							<div class="brandinglogo-wrap">
								<h1 class="site-title">
									<a href="#" rel="home">{{env('APP_DETAIL')}}</a>
								</h1>
							</div>
						</div><!-- .site-branding -->
					</div>
				</div>
			</div>
		</div>
	</div>
    
	
    @yield('content')
    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>{{env('APP_NAME')}}</h3>
                            <p>
                                {{env('APP_ADDRESS')}}
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" title="Youtube"><i class="bi bi-youtube"></i></a>
                                <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" title="Android App"><i class="bi bi-app"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="copyright">
                Copyright © <?=date('Y') ?> All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center active"><i class="bi bi-arrow-up-short"></i></a>
    

    <script src="{{ asset('landing/js/purecounter.js') }}"></script>
    <script src="{{ asset('landing/js/aos.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('landing/js/swiper-bundle.min.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <!-- Calendar JS -->
    <script src="{{asset('assets/js/calendar/main.min.js')}}"></script>
    @yield('custom_script')
    @livewireScripts
</body>
</html>
    