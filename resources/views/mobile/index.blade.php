
@include('mobile.asset')

<div class="page-content">
        
    
    <div class="page-title page-title-small">
        <div class="mt-4 text-white font-700 font-18">{{ $asn->nama }}</div>
        <a href="#"  style="width: 80px; height: 80px;" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url($asn->foto) }}"></a>
        {{-- <a href="#" style="width: 50px; height: 50px;" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr_white.png') }}"></a> --}}
    </div>
    <div class="page-title font-11 text-light line-height-s" style="margin-top: -25px; padding-right: 80px">{{ $asn->opd->nama }}</div>
    <div class="card header-card shape-rounded" data-card-height="320">
        <div class="card-overlay bg-highlight opacity-80"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg bg-18"></div>
    </div>
    

    <!-- Homepage Slider-->
    {{-- <div class="single-slider-boxed text-center owl-no-dots owl-carousel">
        
            <div class="card rounded-l shadow-l" data-card-height="230">
                <div class="card-bottom">
                    <h2 class="font-700">Capain {{ $jp_th }} JP</h2>
                    <p class="boxed-text-xl fw-bold">
                        <div class="font-15 color-highlight">Capaian JP Tahunan</div>
                        <div class="font-15 color-highlight" style="margin-top: -5px">Tahun {{ $tahun }}</div>
                    </p>
                </div>
                
                <div class="card-overlay bg-gradient-fade"></div>
                <div class="card-bg owl-lazy" data-src="{{ url('mobiles/images/pictures/17m.jpg') }}"></div>
            </div>

            <div class="card rounded-l shadow-l" data-card-height="230">
                <div class="card-bottom">
                    <h2 class="font-700">Capaian {{ $jp_all }} JP</h2>
                    <p class="boxed-text-xl">
                        <div class="font-15 color-highlight">Semua JP yang telah dilaksanakan</div>
                    </p>
                </div>
                
                <div class="card-overlay bg-gradient-fade"></div>
                <div class="card-bg owl-lazy" data-src="{{ url('mobiles/images/pictures/24m.jpg') }}"></div>
            </div>

            <div class="card rounded-l shadow-l" data-card-height="230">
                <div class="card-bottom">
                    <h2 class="font-700">Realisasi {{ $persen_rencana }} %</h2>
                    <p class="boxed-text-xl fw-bold">
                        <div class="font-15 color-highlight">Realisasi Rencana Kompetensi {{ $tahun }}</div>
                        <div class="font-15 color-highlight font-500" style="margin-top: -5px">{{ $realisasi.'/'.$tot_rencana }}</div>
                    </p>
                </div>
                
                <div class="card-overlay bg-gradient-fade"></div>
                <div class="card-bg owl-lazy" data-src="{{ url('mobiles/images/pictures/13m.jpg') }}"></div>
            </div>
        
    </div>  --}}

    

    <div class="content mt-2">
        <div class="row mb-0 px-2">
            <a href="#" class="col-4 p-2">
                <div class="card card-style text-center py-3 shadow-l mx-0 mb-0 opacity-90 bg-white1-dark">
                    <h4 class="font-500 text-success text-center ">{{ $persen_rencana}} %</h4>
                    <p class="font-13 font-400 mb-n1 mt-2 color-theme px-1" style="line-height: 110%">Realisasi Rencana</p>
                </div>
            </a>
            <a href="#" class="col-4 p-2">
                <div class="card card-style text-center py-3 shadow-l mx-0 mb-0 opacity-90 bg-white1-dark">
                    <h4 class="font-500 text-info text-center">{{ $jp_th }} JP</h4>
                    <p class="font-13 font-400 mb-n1 mt-2 color-theme px-1" style="line-height: 110%">Capaian <br>{{ $tahun }}</p>
                </div>
            </a>
            <a href="#" class="col-4 p-2">
                <div class="card card-style text-center py-3 shadow-l mx-0 mb-0 opacity-90 bg-white1-dark">
                    <h4 class="font-500 color-highlight text-center">{{ $jp_all }} JP</h4>
                    <p class="font-13 font-400 mb-n1 mt-2 color-theme px-1" style="line-height: 110%">Seluruh<br> Capaian</p>
                </div>
            </a>
        </div>
    </div>

    <p class="color-white text-center mx-3 mb-2">
        Presentasi OPD Menyelesaikan Perencanaan
        
    </p>
    <div class="divider divider-margins mb-0"></div>
    <div class="single-slider-boxed mt-0 text-center owl-no-dots owl-carousel">
        @foreach ($per_opd->sortByDesc('persen') as $a)
                    
            <div class="card rounded-l shadow-l" data-card-height="240">
                <div class="content">
                    <div class="font-14 font-700 line-height-s float-top">{{ $a['nm_opd'] }}</div>
                    
                    <div class="progress rounded-sm shadow-xl mt-4 border border-fade-green2-dark pt-0" style="height:20px">
                        <div class="progress-bar bg-green1-dark opacity-90 text-left pl-3 color-white" 
                            role="progressbar" style="width: {{ $a['persen'] }}%" 
                            aria-valuenow="10" aria-valuemin="0" 
                            aria-valuemax="100">
                            {{ $a['persen'] }} %
                        </div>
                    </div>
                    <p class="color-highlight mb-1 mt-1">Progress</p>
                    <div class="divider mt-2 mb-2"></div>
                    <div class="d-flex">
                        <div class="pr-4 align-self-center">
                            <p class="font-600 font-12 color-highlight mb-0 line-height-xs">Total Rencana</p>
                            <h3 class="mb-2 mt-2">{{ $a['jumlah'] }}</h3>
                        </div>
                        <div class="w-100 align-self-center pl-3">
                            <h6 class="font-12 font-500">Jumlah ASN<span class="float-right color-yellow2-dark">{{ $a['jumlah_asn'] }}</span></h6>
                            <div class="divider mb-2 mt-1"></div>
                            <h6 class="font-12 font-500">Merencankan<span class="float-right color-green2-dark">{{ $a['asn_merencanakan'] }}</span></h6>
                        </div>
                    </div>     
                
                </div>
            </div>
        @endforeach

  
    </div>


    <div class="card card-style mt-3 mx-4">
        <div class="content mb-2">
            <h5>Analisis Kebutuhan Diklat</h5>
            <p style="line-height: 120%">
                Dimaksudkan agar kegiatan diklat tepat sasaran antara peserta dengan program yang akan dijalankan.
            </p>

            <div class="list-group list-custom-small mt-0">
                @foreach ($akd as $a)
                <a href="#">
                    <i class="fas font-14 fa-chevron-right rounded-xl"></i>
                    <span>{{ $a['label'] }}</span>
                    <span class="badge bg-warning font-11">{{ $a['gap'] }}</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                @endforeach
            </div>
            <button onclick="getHtml('{{ url('mobile/akd') }}')" class="btn btn-xs w-100 rounded-xl bg-highlight btn-full mt-3 mb-2">MENGISI AKD</button>
        </div>  
    </div>
        

    <div class="card bg-20 mt-4">
        <div class="card-body">
                 <h5 class="float-left color-white">Jadwal Diklat</h5>
                 <a class="float-right text-warning" onclick="getHtml('{{ url('mobile/jadwal') }}')" href="#">View All</a>
                 <div class="clearfix"></div>
            <p class="color-white">
                Temukan Jadwal Diklat
            </p>
            <div class="card card-slider card-style px-0 mx-0">
            
                <div class="single-slider slider-boxed owl-carousel owl-no-dots mt-3">
                    @foreach ($jadwal as  $j)
                        <p class="text-center font-14 font-500 line-height-m mt-3 pb-0">
                            {{ $j->diklat->nama }}
                            <br><br>
                            <span class="font-13 color-blue2-dark mt-3">{{ date('d F Y', strtotime($j->tgl_mulai)).' s.d '.date('d F Y', strtotime($j->tgl_selesai)) }}</span>
                            <br><span class="font-13 color-green1-dark">{{ $j->tempat }}</span>
                            <br><span class="font-13 color-brown1-dark">{{ $j->pelaksana }}</span>
                            <br><span class="font-13 color-red2-dark">{{ $j->jenis }}</span>
                        </p>
                    @endforeach
                </div>            
            </div>
        </div>
        <div class="card-overlay bg-highlight opacity-80"></div>
        <div class="card-overlay dark-mode-tint"></div>
    </div>
    
   
</div> 
    
