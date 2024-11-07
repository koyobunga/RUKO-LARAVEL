<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>RUKO Mobile</title>
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/styles/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/styles/style.css') }}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/fonts/css/fontawesome-all.min.css') }}">    

<script type="text/javascript" src="{{ url('mobiles/scripts/jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('mobiles/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('mobiles/scripts/custom.js') }}"></script>

<!-- PWA  -->
<link rel="apple-touch-icon" href="{{ asset('img/icon/192.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

</head>





<body class="theme-light" data-highlight="pink1">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app">
        <a href="{{ url('mobile/asn') }}" class="header-title">RUKO</a>
        <a href="#" class="header-icon header-icon-1">,<img src="{{ url('img/icon/rr.png') }}" alt="" width="20"></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        {{-- <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a> --}}
    </div>

    <div id="footer-bar" class="footer-bar-1 bg-">
        <a id="home" href="#" class="active-nav"><i data-feather="home" data-feather-line="1" data-feather-size="21" data-feather-color="pink2-dark" data-feather-bg="pink2-fade-light"></i><span>Home</span></a>
        <a id="rencana" href="#"><i data-feather="file" data-feather-line="1" data-feather-size="21" data-feather-color="brown1-dark" data-feather-bg="brown1-fade-light"></i><span>Rencana</span></a>
        <a id="pelaksanaan" href="#" ><i data-feather="smartphone" data-feather-line="1" data-feather-size="21" data-feather-color="green1-dark" data-feather-bg="green1-fade-light"></i><span>Laporan</span></a>
        <a id="setting" href="#"><i data-feather="settings" data-feather-line="1" data-feather-size="21" data-feather-color="gray2-dark" data-feather-bg="gray2-fade-light"></i><span>Opsi</span></a>
    </div>

    @yield('page')    

    
    
</div>    



 

<div id="menu-confirm" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="200" data-menu-effect="menu-over" style="height: 200px; display: block;">
    <h2 class="text-center font-700 mt-3 pt-1">Konfirmasi</h2>
    <p class="boxed-text-l">
        Yakin akan menyimpan data?
    </p>
    <div class="row mr-3 ml-3">
        <div class="col-6">
            <a href="#" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red1-dark">Tidak</a>
        </div>
        <div class="col-6">
            <button id="yakin" class="btn w-100 btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-green1-dark">Ya</button>
        </div>
    </div>
</div>

<div id="menu-logout" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="180" data-menu-effect="menu-over" style="height: 200px; display: block;">
    <h2 class="text-center font-700 mt-3 pt-2">Konfirmasi</h2>
    <p class="boxed-text-l">
        Akan Logout?
    </p>
    <div class="row mr-3 ml-3">
        <div class="col-6">
            <a href="#" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 border-dark1-dark">Tidak</a>
        </div>
        <div class="col-6">
            <a href="{{ url('mobile/logout') }}" class="btn w-100 btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red2-dark">Log out</a>
        </div>
    </div>
</div>

<div id="menu-hapus" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="200" data-menu-effect="menu-over" style="height: 200px; display: block;">
    <h2 class="text-center font-700 mt-3 pt-1">Konfirmasi</h2>
    <p class="boxed-text-l">
        Hapus data ini?
    </p>
    <div class="row mr-3 ml-3">
        <div class="col-6">
            <a href="#" class="close-menu btn btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 border-blue1-dark">Batal</a>
        </div>
        <div class="col-6">
            <button id="hapus" class="btn w-100 btn-sm btn-full button-s shadow-l rounded-s text-uppercase font-900 bg-red2-dark">Hapus</button>
        </div>
    </div>
</div>


{{-- Toast --}}
<div id="success" class="snackbar-toast bg-green1-dark fade hide" data-delay="3000" data-autohide="true"><i class="fa fa-check mr-3"></i><span id="success-bd"></span></div>
<div id="info" class="snackbar-toast bg-blue1-dark fade hide" data-delay="3000" data-autohide="true"><i class="fa fa-info mr-3"></i><span id="info-bd"></span></div>
<div id="error" class="snackbar-toast bg-red2-dark fade hide" data-delay="3000" data-autohide="true"><i class="fa fa-times mr-3"></i><span id="error-bd"></span></div>
<div id="toast-loading" class="toast toast-tiny toast-bottom bg-blue2-dark fade hide" data-delay="3000" data-autohide="true"><i class="fa fa-sync fa-spin mr-3"></i>Proses..</div>
{{-- toast --}}


<script>
    classInactive();
    $(document).ready(function () {
    
        $('#home').click(function (e) { 
            e.preventDefault();  
            classInactive();
            $('#home').attr('class', 'active-nav');
            getHtml('{{ url('mobile/dashboard') }}');
        });
        
        $('#rencana').click(function (e) { 
            classInactive();
            $('#rencana').attr('class', 'active-nav');
            getHtml('{{ url('mobile/rencana') }}');
            e.preventDefault();  
        });
        $('#pelaksanaan').click(function (e) { 
            e.preventDefault();
            classInactive();
            
            $(this).attr('class', 'active-nav');
            getHtml('{{ url('mobile/pelaksanaan') }}');
        });
        $('#setting').click(function (e) { 
            e.preventDefault();
            classInactive();
            $(this).attr('class', 'active-nav');
            getHtml('{{ url('mobile/setting') }}');
        });
    
    });
    function classInactive(){
        
        $('#home').attr('class', '');
        $('#rencana').attr('class', '');
        $('#pelaksanaan').attr('class', '');
        $('#setting').attr('class', '');
    }
</script>


<script src="{{ asset('/sw.js') }}"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register("/sw.js").then(function (reg) {
            console.log("Service worker has been registered for scope: " + reg.scope);
        });
    }
</script>

{{-- <script>
    window.addEventListener("load", ()=>{
        if("serviceWorker" in navigator){
            navigator.serviceWorker.register("{{ url('_service-worker.js') }}");
        }
    });
</script> --}}


{{-- @include('mobile.main') --}}

</body>
</html>
