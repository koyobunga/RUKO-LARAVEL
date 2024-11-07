@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/setting') }}')"><i class="fa fa-arrow-left"></i></a>Progres OPD</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/17m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/17m.jpg') }});"></div>
        </div>
        <div class="card card-style">
            <div class="d-flex content mb-1">
                <!-- left side of profile -->
                <div class="flex-grow-1">
                    <h5 class="font-500 mb-3">{{ $asn->opd->nama }}</h5>
                    <p class="mb-3" style="line-height: 120%">
                        Progres Rencana dan Pelaksanaan Kompetensi Tahun {{ $tahun }}
                    </p>
                    
                </div>
                
            </div>
        </div>

        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" 
                     data-tab-items="2" 
                     data-tab-active="bg-blue1-dark color-white">
                    <a href="#" data-tab-active data-tab="tab-8">Rencana</a>
                    <a href="#" data-tab="tab-9">Pelaksanaan</a>
                </div>
                <div class="clearfix mb-3"></div>
                <div class="tab-content" id="tab-8">
                    <div class="content mb-2 mx-1">
                        <h5 class="pt-0" style="margin-top: -20px">Rencana Kompetensi</h5>
                        
                        <div class="input-style mt-4 has-icon input-style-1 input-required">
                            <i class="fas input-icon fa-search"></i>
                            <span>Nama ASN</span>
                            <em>(Nama)</em>
                            <input id="search" type="name" placeholder="Search">
                        </div> 
                        <p class="font-11 mb-0 pb-0">
                            <span class="color-green1-dark float-left mr-2"><b>{{ $rencana->count() }}</b> Merancanakan</span>
                            <span class="color-gray2-dark ml-3 float-right"><b>{{ $rencana_belum->count() }}</b> Belum</span>
                        </p>
                        <div class="clearfix"></div>
                        <div id="rencana" class="list-group list-custom-large mt-0">
                            @foreach ($rencana as $r)
                                <a href="#" class="mb-0 py-0">
                                    <span>{{ $r->asn->nama }}</span>
                                    <strong>{{ $r->asn->nip }}</strong>
                                    <i class="fas fa-check-double color-green1-dark font-14"></i>
                                </a>     
                            @endforeach
                            @foreach ($rencana_belum as $r)
                                <a href="#" class="mb-0 py-0">
                                    <span>{{ $r['nama'] }}</span>
                                    <strong>{{ $r['nip'] }}</strong>
                                    <i class="	far fa-check-circle color-gray1-dark font-14"></i>
                                </a>     
                            @endforeach
                        </div>
                    </div>
                </div>
              
                {{--content  tab 2 --}}
                <div class="tab-content" id="tab-9">
                    <div class="content mb-2 mx-1">
                        <h5 class="pt-0" style="margin-top: -20px">Pelaksanaan Kompetensi</h5>
                        <div class="input-style mt-4 has-icon input-style-1 input-required">
                            <i class="fas input-icon fa-search"></i>
                            <span>Nama ASN</span>
                            <em>(Nama)</em>
                            <input id="search2" type="name" placeholder="Search">
                        </div> 
                        <p class="font-11 mb-0 pb-0">
                            <span class="color-yellow1-dark float-left mr-2"><b>{{ $laporan->count() }}</b> Melaksanakan</span>
                            <span class="color-gray2-dark ml-3 float-left"><b>{{ $laporan_belum->count() }}</b> Belum</span>
                            <span class="color-green2-dark float-right text-right mr-2"><b>{{ $jp20->count() }}</b> ASN 20 JP</span>
                        </p>
                        <div class="clearfix"></div>
                        <div id="laporan" class="list-group list-custom-large mt-0">
                            @foreach ($laporan as $r)
                            {{-- <a href="#" class="border border-green1-dark rounded-s shadow-xs">
                                    <span>{{ $r->asn->nama }}</span>
                                    <strong>{{ $r->asn->nip }} </strong>
                                    <u class="color-green1-dark">{{ $r->jp }}</u>
                                    <i class="fas fa-check-double color-green1-dark font-14">{{ $r->jp }}</i>
                                </a>      --}}
                                <a href="#">
                                    <span>{{ $r->asn->nama }}</span>
                                    <strong>{{ $r->asn->nip }}</strong>
                                    <span class="badge bg-green2-dark font-11">{{ $r->jp }} JP</span>
                                    <i class="fa fa-angle-right color-white"></i>
                                </a>
                            @endforeach
                            @foreach ($laporan_belum as $r)
                                <a href="#" class="mb-0 py-0">
                                    <span>{{ $r['nama'] }}</span>
                                    <strong>{{ $r['nip'] }}</strong>
                                    <i class="	far fa-check-circle color-gray1-dark font-14"></i>
                                </a>     
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


  


    </div>

    <script>
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#rencana a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#search2").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#laporan a").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
