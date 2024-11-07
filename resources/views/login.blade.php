<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | RUKO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('img/icon/l.png') }}" />


    <!-- App css -->
    <link href="{{ url('theme/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{ url('theme/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('theme/admin/css/app.min.css') }}" rel="stylesheet" type="text/css"  id="app-stylesheet" />

     <!-- Alertify -->
     {{-- <link href="{{ url('alertify.js/css/alertify.css') }}" rel="stylesheet" type="text/css"> --}}
     <link rel="stylesheet" href="{{ url('alertify/css/alertify.min.css') }}" />
     <link rel="stylesheet" href="{{ url('alertify/css/themes/default.min.css') }}" />

     

</head>

<body class="authentication-bg bg-light authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

    <div class="home-btn d-none d-sm-block">
        <a href="{{ url('/') }}"><i class="fas fa-home h2 text-pink"></i></a>
    </div>

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box text-center">
                                    <div class="text-center">
                                        <a href="{{ url('/') }}">
                                            <img src="img/icon/ll.png" alt="" height="50">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Sign In</h5>
                                    <p class="mb-0">Masukkan username dan password  ..</p>
                                </div>

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" action="{{ url('/authtenticate') }}" method="POST">
                                        @csrf
                                        @method('post')
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="username">Username</label>
                                                <input class="form-control" type="text" id="username" name="username" required placeholder="Username">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                {{-- <a href="page-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a> --}}
                                                <label for="password">Password</label>
                                                <input class="form-control" type="password" required name="password" id="password" placeholder="Password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">

                                                <div class="checkbox checkbox-success">
                                                    <input id="remember" name="remember" type="checkbox" checked="">
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-outline-danger waves-effect waves-light" type="submit">Sign In</button>
                                            </div>
                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end page -->
    

   


    <!-- Vendor js -->
    <script src="{{ url('theme/admin/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ url('theme/admin/js/app.min.js') }}"></script>

    {{-- alertify --}}
    {{-- <script src="{{ url('alertify.js/js/alertify.js') }}"></script> --}}
    <script src="{{ url('alertify/alertify.min.js') }}"></script>
    
    

    @if(session()->has('success'))
    <script>
        $(document).ready(function () {
            alertify.success('{{ session('success') }}'); 
        });
    </script>
    @endif

    @if(session()->has('error'))
        <script>
            $(document).ready(function () {
                
                alertify.error('{{ session('error') }}'); 
            });
        </script>
    @endif


  
</body>

</html>