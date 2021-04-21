<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title> @yield('title', 'NO-TITLE-PASSED') | {{ config('app.name') }}</title>

	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('atlantis/assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('atlantis/assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('atlantis/assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
    @notifyCss
	<link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://demo.themekita.com/atlantis/livepreview/examples/assets/css/atlantis.css">
    {{-- <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}"> --}}
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('atlantis/assets/css/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

</head>
<body>
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="index.html" class="logo text-white">
					{{-- <img style="margin-top: -5px; width: 20px; height: auto;" src="https://cdn.discordapp.com/attachments/530789778912837640/686668588500779122/PicsArt_03-10-01.45.43.png" alt="navbar brand" class="navbar-brand"> --}}
                    {{ config('app.name') }}
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->

                @include('layouts.partials.navbar')
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		@include('layouts.partials.sidebar')
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
                <div class="mb-5"></div>
				@yield('content')
                <div style="position: relative; z-index: 99999;">
                    @include('notify::messages')
                </div>
			</div>
            @include('layouts.partials.footer')
		</div>


	</div>

	<!--   Core JS Files   -->
	<script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-- jQuery UI -->
	<script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('atlantis/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('atlantis/assets/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('atlantis/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('atlantis/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('atlantis/assets/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('atlantis/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('atlantis/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('atlantis/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('atlantis/assets/js/atlantis.min.js') }}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('atlantis/assets/js/setting-demo.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/demo.js') }}"></script>
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('clock-box').innerHTML =
            h + ":" + m + ":" + s + ' IST';
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

        startTime();
    </script>
    @yield('js')
    @notifyJs
</body>
</html>
