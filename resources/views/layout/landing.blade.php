<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="Coderthemes">
	    <link rel="shortcut icon" href="images/favicon.ico">

	    <title>RUKO - Rumah Kompetensi</title>

        <link rel="shortcut icon" href="{{ url('img/icon/l.png') }}" />

	    <!-- Bootstrap core CSS -->
	    <link href="{{ url('theme/landing/css/bootstrap.min.css') }}" rel="stylesheet">
	    <link href="{{ url('theme/landing/css/font-awesome.min.css') }}" rel="stylesheet">
	    <!-- Custom styles for this template -->
	    <link href="{{ url('theme/landing/css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

		 <!-- third party css -->
		 <link href="{{ url('theme/admin/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
		 <link href="{{ url('theme/admin/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
		 <link href="{{ url('theme/admin/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
 
    </head>



	<body>

		<header>
			<section class="hero">
				<!-- Navbar -->
		        <nav class="navbar navbar-expand-lg navbar-custom navbar-dark navbar-custom">
		            <div class="container">
		                <!-- LOGO -->
		                <a class="navbar-brand logo" href="#">
		                    <img src="{{ public_path('img/icon/ll.png') }}" alt="logo" height="30"> RUKO
		                </a>
		                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
		                    <span class="navbar-toggler-icon"></span>
		                </button>

		                <div class="collapse navbar-collapse" id="navbarsExample07">
		                    <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
		                            <a class="nav-link" href="#apa">Apa itu RUKO</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="#android"><i class="bi bi-android2 mr-2"></i>RUKO MOBILE</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="#pricing">Diklat</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="#clients">Kontak</a>
		                        </li>
		                        <li class="nav-item">
		                            <a class="nav-link" href="{{ url('/login') }}">Log In</a>
		                        </li>
		                    </ul>

		                </div>
		            </div>
		        </nav>

				<div class="container">

					<div class="row hero-content text-center">
						<div class="col-12">
							<h1 class="">RUKO - Rumah Kompetensi PNS</h1>
							<div class="m-t-20">
								<a href="{{ url('/login') }}" class="btn btn-custom w-lg">L o g i n</a>
							</div>
							<div id="macbook">

						        <!-- START carousel-->
                                <div id="tour" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#tour" data-slide-to="0" class="active"></li>
                                        <li data-target="#tour" data-slide-to="1"></li>
                                        <li data-target="#tour" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active">
                                            <img src="{{ url('img/landing/slide1.jpg') }}" alt="slide-img" class="img-fluid">
                                        </div>
                                        <div class="carousel-item">
                                        	<img src="{{ url('img/landing/slide2.jpg') }}" alt="slide-img" class="img-fluid">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="{{ url('img/landing/slide3.jpg') }}" alt="slide-img" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <!-- END carousel-->

						    </div>
						</div>
					</div>
				</div> <!-- end container -->
			</section> <!-- end hero -->
		</header>



        @yield('main')



        <footer class="footer">
	        <div class="container">
				<div class="row">
					<div class="col-md-6">
						<a class="navbar-brand-footer" href="#"><img src="{{ url('img/icon/ll.png') }}" alt="logo" height="28"></a>
						<span class="text-muted ml-3"> © BPSDM Provinsi Gorontalo 2022</span>
                    </div>
                    <div class="col-md-6">
						<ul class="social-icons text-md-right">
							<li><a target="_blank" href="https://www.facebook.com/badan.diklat.gtlo"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div> <!-- end row -->
			</div> <!-- end container -->
	    </footer>




	    <!-- js placed at the end of the document so the pages load faster -->
	    <script src="{{ url('theme/landing/js/jquery.min.js') }}"></script>
	    <script src="{{ url('theme/landing/js/bootstrap.bundle.min.js') }}"></script>
	    <!-- Jquery easing -->                                                      
	    <script type="text/javascript" src="{{ url('theme/landing/js/jquery.easing.min.js') }}"></script>
	    <!-- SmoothScroll -->
		<script src="{{ url('thme/landing/js/SmoothScroll.js') }}"></script>
		 <!-- custom js -->

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
		 <script src="{{ url('theme/landing/js/app.js') }}"></script>
	</body>
</html>