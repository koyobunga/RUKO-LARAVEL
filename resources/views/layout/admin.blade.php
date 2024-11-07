
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>RUKO | {{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ url('img/icon/ll.png') }}" />

        <!-- App css -->
        <link href="{{ url('theme/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="{{ url('theme/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('theme/admin/css/app.min.css') }}" rel="stylesheet" type="text/css"  id="app-stylesheet" />

		{{-- jquery --}}
		<script src="{{ url('js/code.jquery.com_jquery-3.7.1.min.js') }}"></script>
		
		<!-- Alertify -->
		{{-- <link href="{{ url('alertify.js/css/alertify.css') }}" rel="stylesheet" type="text/css"> --}}
        <!-- include the style -->
        <link rel="stylesheet" href="{{ url('alertify/css/alertify.min.css') }}" />
        <link rel="stylesheet" href="{{ url('alertify/css/themes/default.min.css') }}" />
     


        <!-- third party css -->
        <link href="{{ url('theme/admin/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('theme/admin/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('theme/admin/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />

        {{-- tooltip --}}
        <link href="{{ url('theme/admin/libs/tooltipster/tooltipster.bundle.min.css') }}" rel="stylesheet" type="text/css" >
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        {{-- SPiiner --}}
        <link href="{{ url('theme/admin/libs/spinkit/spinkit.css') }}" rel="stylesheet" type="text/css" >
    </head>

    <style>
        #loading {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0,0, 0.2);  
            width: 100%;
            height: 100%;
            z-index: 100;
            margin: 0;
            padding-top: 400px;
            visibility: hidden;
            display: none;
      }
      </style>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">


                    {{-- <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="dripicons-bell noti-icon"></i>
                            <span class="badge badge-pink rounded-circle noti-icon-badge">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                            <div class="dropdown-header noti-title">
                                <h5 class="text-overflow m-0"><span class="float-right">
                                    <span class="badge badge-danger float-right">5</span>
                                    </span>Notification</h5>
                            </div>

                            <div class="slimscroll noti-scroll">

                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                                    <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                                </a>

                              
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger">
                                        <i class="mdi mdi-account-plus"></i>
                                    </div>
                                    <p class="notify-details">New user
                                        <small class="text-muted">You have 10 unread messages</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-info">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">Caleb Flakelar commented on Admin
                                        <small class="text-muted">4 days ago</small>
                                    </p>
                                </a>

                               
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li> --}}

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ url('theme/admin/images/users/avatar-1.jpg') }}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                Admin  <i class="mdi mdi-chevron-down"></i> 
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">
									Menu
								</h6>
                            </div>


							 <!-- item-->
							 <a href="#" data-toggle="modal" data-target="#modal-password" class="dropdown-item notify-item">
                                <i class="fe-edit"></i>
                                <span>Ubah Password</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>


                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img src="{{ url('img/icon/ll.png') }}" alt="" height="45"> 
							
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img src="{{ url('img/icon/ll.png') }}" alt="" height="28">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button id="menufull" class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li class="d-none d-sm-block">
                            <form class="app-search">
                                <div class="app-search-box">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <div class="input-group-append">
                                            <button class="btn" type="submit">
                                                <i class="fe-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>

                </ul>
            </div>
            <!-- end Topbar -->

            
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                           

                            <li>
                                <a href="{{ url('admin') }}" class="{{ request()->is(['admin','admin/list/*']) ? 'active' : '' }}">
                                    <i class="fe-airplay"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                      

                            <li class="menu-title text-warning mt-2">Kompetensi</li>

                            

                            <li>
                                <a href="{{ url('/admin/rencana') }}" class="{{ request()->is(['admin/rencana/','admin/rencana/*']) ? 'active' : '' }}">
                                    <i class="fe-calendar"></i>
                                    <span> Rencana </span>
                                </a>
                            </li>
							
                            							
                            <li>
                                <a href="{{ url('admin/pelaksanaan') }}" class="{{ request()->is(['admin/pelaksanaan/','admin/pelaksanaan/*']) ? 'active' : '' }}">
                                    <i class="fe-file-minus"></i>
                                    <span> Pelaksanaan </span>
                                </a>
                            </li>
                           
                            <li>
                                <a href="{{ url('admin/rekap') }}" class="{{ request()->is(['admin/rekap/','admin/rekap/*']) ? 'active' : '' }}">
                                    <i class= "mdi mdi-finance"></i>
                                    <span> Rekap </span>
                                </a>
                            </li>
                      
                            <li class="menu-title text-light mt-2">Master</li>

                            <li>
                                <a href="/admin/asn" class="{{ request()->is(['admin/asn','admin/asn/*']) ? 'active' : '' }}">
                                    <i class="mdi mdi-account-group"></i>
                                    <span> ASN </span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/opd" class="{{ request()->is(['admin/opd','admin/opd/*']) ? 'active' : '' }}">
                                    <i class="icon-folder"></i>
                                    <span> OPD </span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/jadwal" class="{{ request()->is(['admin/jadwal','admin/jadwal/*']) ? 'active' : '' }}">
                                    <i class=" mdi mdi-calendar-month"></i>
                                    <span> Jadwal Diklat</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin/diklat" class="{{ request()->is(['admin/diklat','admin/diklat/*']) ? 'active' : '' }}">
                                    <i class="mdi mdi-format-indent-increase"></i>
                                    <span> Data Diklat </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('admin/serti') }}" class="{{ request()->is(['admin/serti','admin/serti_list/*','admin/serti/*']) ? 'active' : '' }}">
                                    <i class="mdi mdi-credit-card-multiple"></i>
                                    <span>  Buat Sertifikat </span>
                                </a>
                            </li>
							
                            



                       
                
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    
                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        @yield('main')
                        
                    </div> <!-- end container-fluid -->

                </div> <!-- end content -->

                
                {{-- div Spinner --}}
                  <div id="loading" class="sk-three-bounce">
                    <div class="sk-child sk-bounce1 bg-warning"></div>
                    <div class="sk-child sk-bounce2 bg-info"></div>
                    <div class="sk-child sk-bounce3 bg-success"></div>
                  </div>

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                2023 &copy; RUKO by <a href="">BPSDM Provinsi Gorontalo</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->


        <!-- Modal Ubah Password-->
        <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-password" action="{{ url('admin/password') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12 mt-2">
                                <label for="password">Passwrod baru</label>
                                <input placeholder="Password baru..." required type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <label for="password">Ulangi Passwrod</label>
                                <input onkeyup="cekpass()" placeholder="Ulangi password..." required type="password" id="ulangi_password" name="ulangi_password" class="form-control" required>
                                <div class="text-danger mt-2" id="notifpass"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                    </div>
                </form>
            </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
            </div>
            <div class="slimscroll-menu">
        
                <div class="p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, layout, etc.
                    </div>
                    <div class="mb-2">
                        <img src="{{ url('theme/admin/images/layouts/light.png') }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked />
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="{{ url('theme/admin/images/layouts/dark.png') }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsStyle="{{ url('theme/admin/css/bootstrap-dark.min.css') }}" 
                            data-appStyle="{{ url('theme/admin/css/app-dark.min.css') }}" />
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="{{ url('theme/admin/images/layouts/rtl.png') }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="rtl-mode-switch" data-appStyle="{{ url('theme/admin/css/app-rtl.min.css') }}" />
                        <label class="custom-control-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="{{ url('theme/admin/images/layouts/dark-rtl.png') }}" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-5">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-rtl-mode-switch" data-bsStyle="{{ url('theme/admin/css/bootstrap-dark.min.css') }}" 
                            data-appStyle="{{ url('theme/admin/css/app-dark-rtl.min.css') }}" />
                        <label class="custom-control-label" for="dark-rtl-mode-switch">Dark RTL Mode</label>
                    </div>

                    
                </div>
            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <a href="javascript:void(0);" class="right-bar-toggle demos-show-btn">
            <i class="mdi mdi-settings-outline mdi-spin"></i> &nbsp;Pilih Tema
        </a>

        <!-- Vendor js -->
        <script src="{{ url('theme/admin/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ url('theme/admin/js/app.min.js') }}"></script>

		
		{{-- alertify --}}
		{{-- <script src="{{ url('alertify.js/js/alertify.js') }}"></script> --}}
        <script src="{{ url('alertify/alertify.min.js') }}"></script>
        


        <!-- Required datatable js -->
        <script src="{{ url('theme/admin/libs/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
        
        <!-- Buttons examples -->
        <script src="{{ url('theme/admin/libs/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/buttons.colVis.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ url('theme/admin/libs/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('theme/admin/libs/datatables/responsive.bootstrap4.min.js') }}"></script>

        
        <!-- Datatables init -->
        <script src="{{ url('theme/admin/js/pages/datatables.init.js') }}"></script>

        {{-- tooltip --}}
        <script src="{{ url('theme/admin/libs/tooltipster/tooltipster.bundle.min.js') }}"></script>
        <script src="{{ url('theme/admin/js/pages/tooltipster.init.js') }}"></script>
		
	

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

        @if(session()->has('warning'))
			<script>
				$(document).ready(function () {
					
					alertify.warning('{{ session('warning') }}'); 
				});
			</script>
		@endif

       <script>
            $(document).ready(function () {
                $('#form-password').submit(function (e) { 
                    var pass = $('#password').val();
                    var ulangi = $('#ulangi_password').val();
                    if(pass != ulangi){
                        $('#notifpass').html('** Password tidak sesuai..');
                        $('#ulangi_password').focus();
                        return false;
                    }else{
                        return true;
                    }
                    e.preventDefault();
                });
            });

            function cekpass(){
                var pass = $('#password').val();
                var ulangi = $('#ulangi_password').val();
                if(pass != ulangi){
                    $('#notifpass').html('** Password tidak sesuai..');
                    $('#notifpass').attr('class', 'text-danger');
                    $('#ulangi_password').focus();
                }else{
                    $('#notifpass').html('OK');
                    $('#notifpass').attr('class', 'text-success');
                }
            }
       </script>

       <script>
        function loadingShow(){
            $('#loading').css('visibility', 'visible');
            $('#loading').css('display', 'block');
        }
        function loadingHide(){
            $('#loading').css('visibility', 'hidden');
            $('#loading').css('display', 'none');
        }
       </script>
        
    </body>
</html>