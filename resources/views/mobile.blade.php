<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />


<title>Rumah Kompetensi</title>
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/styles/bootstrap.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/styles/style.css') }}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ url('mobiles/fonts/css/fontawesome-all.min.css') }}">    
{{-- <link rel="manifest" href="{{ url('_manifest.json') }}" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url('img/icon-192x192.png') }}"> --}}


<link rel="apple-touch-icon" href="{{ asset('img/icon/192.png') }}">
<link rel="manifest" href="{{ asset('/manifest.json') }}">

</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page">
    
    <!-- header and footer bar go here-->
    {{-- <div class="header header-fixed header-auto-show header-logo-app">
        <a href="#" data-back-button class="header-title header-subtitle">Back to Pages</a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-right"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-4"><i class="fas fa-bars"></i></a>
    </div>
  --}}
    
    <div class="page-content">
        
        <div class="page-title page-title-small">
            <h2 class="mt-5">Ruko ASN</h2>
            <div class="text-white mb-0">Aplikasi Rencana Pengembangan Kompetensi</div>
            <div class="text-white" style="margin-top: -7px">BPSDM Provinsi Gorontalo</div>
        </div> 
        <div class="card header-card shape-rounded" data-card-height="250">
            <div class="card-overlay bg-gradient-red2 opacity-85 rounded-m shadow-l"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg bg-20"></div>
        </div>


        
        <div class="card card-style mt-5">
            <div class="content mt-5 mb-0">
                <div class="text-center mb-4">
                    <img src="{{ url('img/icon/rr.png') }}" width="55"/>
                </div>
                
                <div class="header-title color-red1 text-left mt-4">
                    Silahkan login
                </div> 

                <form action="{{ url('mobile/authtenticate') }}" method="POST">
                    @csrf
                    @method('post')
                <div class="input-style has-icon input-style-1 input-required pb-1">
                    <i class="input-icon fa fa-user color-theme"></i>
                    <span>Username</span>
                    <em>(required)</em>
                    <input required type="text" name="username" placeholder="Username">
                </div> 
                <div class="input-style has-icon input-style-1 input-required pb-1">
                    <i class="input-icon fa fa-lock color-theme"></i>
                    <span>Password</span>
                    <em>(required)</em>
                    <input required type="password" name="password" placeholder="Password">
                </div> 

                <button type="submit" class="btn btn-m btn-border mt-2 mb-4 w-100 border-red2-dark rounded-xl text-uppercase font-900">Login</button>
                </form>
                
                
                <div class="font-20 text-center mt-1 mb-5 w-100">
                    
                    <button hidden id="install_button" class="btn rounded-xl bg-red2-dark py-2 px-5 ">
                        <i class="fab fa-apple mr-1 color-white-dark"></i>
                        <i class="fab fa-android mr-1 color-green1-dark"></i>
                        
                        Install App</button>
                </div>
               
            </div>
            
        </div>
      

        <div class="text-muted text-center p-5">
            BPSDM Provinsi Gorontalo    
        </div>

       
        
    </div>    
    <!-- end of page content-->

    
    
</div>    






<script type="text/javascript" src="{{ url('mobiles/scripts/jquery.js') }}"></script>
<script type="text/javascript" src="{{ url('mobiles/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('mobiles/scripts/custom.js') }}"></script>

@if(session()->has('error'))
    <div id="toast-8" class="toast toast-tiny toast-bottom bg-red2-dark" data-delay="3000" data-autohide="true"><i class="fa fa-times mr-3 ml-2"></i> {{ session('error') }}</div>  
    <script>
        $(document).ready(function () {
            $('#toast-8').toast('show')
        })
    </script>
@endif

@if(session()->has('info'))
    <div id="toast-6" class="toast toast-tiny toast-bottom bg-blue2-dark fade hide" data-delay="3000" data-autohide="true"><i class="fa fa-info mr-3"></i>{{ session('info') }}</div>
    <script>
        $(document).ready(function () {
            $('#toast-6').toast('show')
        })
    </script>
@endif


<script src="{{ asset('/sw.js') }}"></script>
<script>
    
    // if (!navigator.serviceWorker.controller) {
    //     navigator.serviceWorker.register("/sw.js").then(function (reg) {
    //         console.log("Service worker has been registered for scope: " + reg.scope);
    //     });
    // }
    const installButton = document.getElementById("install_button");

    window.addEventListener("beforeinstallprompt", e => {e.preventDefault();deferredPrompt = e;installButton.hidden = false;installButton.addEventListener("click", installApp);});function installApp() {
        deferredPrompt.prompt();
        installButton.disabled = true;
        deferredPrompt.userChoice.then(choiceResult => {if (choiceResult.outcome === "accepted") {
            installButton.hidden = true;} else {}installButton.disabled = false;deferredPrompt = null;});
        }window.addEventListener("appinstalled", evt => {console.log("appinstalled fired", evt);});
   
    // window.addEventListener("appinstalled", () => {
    //   disableInAppInstallPrompt();
    // });
    
    // function disableInAppInstallPrompt() {
    //   installPrompt = null;
    //   installButton.setAttribute("hidden", "");
    // }
</script>

</body>
</html>