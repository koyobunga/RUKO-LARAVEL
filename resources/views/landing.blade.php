@extends('layout.landing')

@section('main')


<section class="section features" id="apa">
    <div class="container text-center">

        <div class="row">
            <div class="col-sm-12">
                <h2 class="title">Apa it RUKO ?</h2>
                <p class="slogan">Ruko (Rumah Kompetensi) merupakan aplikasi yang disediakan oleh BPSDM Provinsi Gorontalo, untuk memfasilitasi PNS dalam merencanakan pengembangan kompetensi berdasarkan 	standar kompetensi jabatan dan rencana pengembangan karier. 
                    <br>RUKO meliputi 3 (tiga) hal yakni <strong>Perencanaan</strong>, <strong> Pelaksanaan</strong>, dan <strong> Evaluasi</strong></p>
            </div>
        </div> <!-- End row -->

        <div class="row p-t-50">
            <div class="col-sm-4">
                <div class="features-2">
                    <img src="{{ url('theme/landing/images/icons/scroll.png') }}" alt="">
                </div>
                <div>
                    <h4>Perencanaan</h4>
                    <p>
                    <i class="bi bi-check mr-2"></i>Terpotret Gep  Kompetensi yang terjadi di setiap PNS melalui Kuisioner AKD<br>
                    <i class="bi bi-check mr-2"></i>Terpotret Perencanaan Diklat/Pelatihan yang di butuhkan oleh setiap PNS 

                    </p>
                </div>
            </div> <!-- end col -->

            <div class="col-sm-4">
                <div class="features-2">
                    <img src="{{ url('img/landing/icons/Bookmark.png') }}" alt="">
                </div>
                <div>
                    <h4>Pelaksanaan</h4>
                    <p>
                    <i class="bi bi-check mr-2"></i>Terpotret Pengembangan Kompetensi 20 JP bagi setiap PNS.<br>
                    <i class="bi bi-check mr-2"></i>Pelaksanaan Pengembangan Kompetensi yang tidak sesuai dengan perencanaan bangkom
                    </p>
                </div>
            </div> <!-- end col -->

            <div class="col-sm-4">
                <div class="features-2">
                    <img src="{{ url('img/landing/icons/Stats.png') }}" alt="">
                </div>
                <div>
                    <h4>Evaluasi</h4>
                    <p>
                    <i class="bi bi-check mr-2"></i>Roadmap Pengembangan  Kompetensi PNS selama 5 Tahun kedepan<br>
                    <i class="bi bi-check mr-2"></i>Documen Training Rate
                    </p>
                </div>
            </div> <!-- end col -->

        </div> <!-- End row -->


        <div class="row">

            <div class="col-sm-4">
                <div class="features-2">
                    <img src="{{ url('img/landing/icons/Video.png') }}" alt="">
                </div>
                <div>
                    <a  href="#"><h4>Video Tutorial</h4></a>
                    <p>Tutorial panduan penyusunan rencana pengembangan kompetensi pada aplikasi RUKO</p>
                </div>
            </div> <!-- end col -->

            

        </div> <!-- End row -->
    </div>
</section> 




<section class="content-wrap bg-light section pb-0" id="android">
    <div class="container">
        <div class="row">

            <div class="col-sm-6">
                <div class="feature-sec">
                    <h3>Aplikasi RUKO versi <i>mobile android</i></h3>
                    <p>Selain fasilitas perencanaan kompetensi berbasis website, BPSDM Provinsi Gorontalo juga telah menyediakan fasilitas perencanaan kompetensi melalui aplikasi ruko berbasis <i>mobile android</i> untuk, memudahkan PNS dalam membuat perancanaan pengembangan kompetensi. </p>
                    <a target="_blank" href="https://play.google.com/store/apps/details?id=com.koyobunga.rumahkompetensi" class="btn-custom btn w-md"><i class="bi bi-android2 mr-2"></i>Download App </a>
                </div>
            </div><!-- end col -->

            <div class="col-sm-6 featured-img">
                <img src="{{ url('img/landing/screen-2.png') }}" alt="Features-img" class="img-fluid">
            </div>

        </div> <!-- end row -->
    </div><!-- end container -->
</section>



<section class="section pb-0" id="pricing">
    <div class="container">
        <div class="row">
            
        <div class="row text-center mt-4">
            <div class="col-sm-12 ">
                <h2 class="title">Kegiatan paling banyak direncanakan ASN {{ $tahun }}</h2>
                <p class="slogan">Daftar diklat/pelatihan berdasarkan jumlah paling banyak direncanakan oleh ASN</p>
            </div>
            <div class="col-sm-12 text-left mb-4 mt-5">
                
                    <table class="table table-hover text-wrap" id="datatable-buttons">
                        <thead>
                            <tr>
                                <th style="width: 10px">No.</th>
                                <th>Diklat</th>
                                <th>Jumlah Rencana</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grouprencana->groupby('diklat_id')->sortDesc() as $rate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rate[0]->nama }}</td>
                                    <td>{{ $rate->count() }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                
            </div>
            
        </div>
        <!-- end row -->

        
    </div> <!-- end Container -->
</section>
<!-- END Pricing -->






<section class="bg-light section" id="clients">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <h2 class="title">BPSDM Provinsi Gorontalo</h2>
                <p class="slogan">Badan Pengembangan Sumber Daya Manusia </p>
                <ul class="list-inline client-list pt40">
                    <li class="list-inline-item"><a href="" title="Email"><i class="bi bi-envelope-at mr-1"></i>bpsdm.gorontaloprov@gmail.com</li>
                    <li class="list-inline-item"><a href="" title="Telp"><i class="bi bi-person-rolodex mr-1"></i>(0435) 8539438</li>
                </ul>
            </div> <!-- end Col -->
        </div> <!-- end row -->
    </div><!-- /End Container -->
</section>
<!-- End Clients -->

    
@endsection