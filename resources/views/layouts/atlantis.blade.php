<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{ asset('atlantis/assets/img/icon.ico') }}" type="image/x-icon"/>
    <!-- Primary Meta Tags -->
    <title> @yield('title', 'NO-TITLE-PASSED') | {{ config('app.name') }}</title>
    <meta name="title" content="Dashboard | {{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }} is an Open Source directory where people can add and find VERIFIED information about resources such as Hospitals, Beds, Oxygen, Ambulance, Medicine, Injections and so on. The app can autonomously fetch tweets that contain #Verified #COVID19India from twitter and source that into the application itself">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://covid19.icrewsystems.com/">
    <meta property="og:title" content="Dashboard | {{ config('app.name') }}">
    <meta property="og:description" content="{{ config('app.name') }} is an Open Source directory where people can add and find VERIFIED information about resources such as Hospitals, Beds, Oxygen, Ambulance, Medicine, Injections and so on. The app can autonomously fetch tweets that contain #Verified #COVID19India from twitter and source that into the application itself">
    <meta property="og:image" content="">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://covid19.icrewsystems.com/">
    <meta property="twitter:title" content="Dashboard | {{ config('app.name') }}">
    <meta property="twitter:description" content="{{ config('app.name') }} is an Open Source directory where people can add and find VERIFIED information about resources such as Hospitals, Beds, Oxygen, Ambulance, Medicine, Injections and so on. The app can autonomously fetch tweets that contain #Verified #COVID19India from twitter and source that into the application itself">
    <meta property="twitter:image" content="">

	<!-- Fonts and icons -->
	<script src="{{ asset('atlantis/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script src="{{ asset('atlantis/assets/js/axios.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('atlantis/assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});

        axios.defaults.baseURL = "{{ config('app.url') }}/api/v1";
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('atlantis/assets/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="https://demo.themekita.com/atlantis/livepreview/examples/assets/css/atlantis.css"> --}}
    <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('atlantis/assets/css/atlantis.min.css') }}"> --}}
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('atlantis/assets/css/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    @yield('css')
    @notifyCss

</head>
<body>
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">

				<a href="{{ route('home') }}" class="logo text-white">
					{{-- <img style="margin-top: -5px; width: 20px; height: auto;" src="https://cdn.discordapp.com/attachments/530789778912837640/686668588500779122/PicsArt_03-10-01.45.43.png" alt="navbar brand" class="navbar-brand"> --}}
                    {{ config('app.name') }}
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
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

    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4 class="mb-4">Don't know what to do?</h4>
                    <p>
                        Watch <a href="#" class="text-primary">this</a> video
                    </p>

                    <h4 class="mb-4">Wish to get IT help?</h4>
                    <p>
                        <a target="_blank" class="btn btn-block btn-primary" href="https://www.tidio.com/talk/cdcm4i8ho2rteyjfwrzqa19csu0eiwm7">
                            Chat with us
                        </a>
                    </p>


                    <div class="btnSwitch">
                        <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                        <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                        <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeTopBarColor" data-color="dark"></button>
                        <button type="button" class="changeTopBarColor" data-color="blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                        <button type="button" class="changeTopBarColor" data-color="green"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange"></button>
                        <button type="button" class="changeTopBarColor" data-color="red"></button>
                        <button type="button" class="changeTopBarColor" data-color="white"></button>
                        <br/>
                        <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                        <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                        <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                        <button type="button" class="changeTopBarColor" data-color="green2"></button>
                        <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                        <button type="button" class="changeTopBarColor" data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark"></button>
                        <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Background</h4>
                    <div class="btnSwitch">
                        <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                        <button type="button" class="changeBackgroundColor" data-color="bg1"></button>
                        <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                        <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            {{-- <i class="fa fa-question"></i> --}}
            <span class="fa fa-question"></span>
        </div>
    </div>
	<!--   Core JS Files   -->
	<script src="{{ asset('atlantis/assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('atlantis/assets/js/core/bootstrap.min.js') }}"></script>
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
	<script src="{{ asset('atlantis/assets/js/atlantis.js') }}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{ asset('atlantis/assets/js/setting-demo.js') }}"></script>
	{{-- <script src="{{ asset('atlantis/assets/js/demo.js') }}"></script> --}}
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
    {{-- <script src="//code.tidio.co/cdcm4i8ho2rteyjfwrzqa19csu0eiwm7.js" async></script> --}}
</body>
</html>
