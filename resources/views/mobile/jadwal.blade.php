@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/setting') }}')"><i class="fa fa-arrow-left"></i></a>Jadwal</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/28m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/28m.jpg') }});"></div>
        </div>
        <div class="card card-style">
           
            
            {{-- Table --}}
            <div class="content mb-2">
                <h5>List Jadwal Diklat</h5>
                <p>
                    Diklat yang akan dilaksanakan 
                </p>
                <table class="table table-borderless text-center rounded-sm" style="overflow: hidden;">
                    
                    <tbody>
                        @foreach ($jadwal as $j)
                            <tr>
                                <td class="pl-1 text-left pl-0 pb-1">
                                    <div class="line-height-m font-500 font-16 mt-0">
                                        {{ $j->diklat->nama }}
                                    </div>    
                                    <div class="font-11 mt-2 color-blue1-dark">
                                        <i class="far fa-calendar-alt mr-1"></i>{{ date('d F Y', strtotime($j->tgl_mulai)).' s.d '.date('d F Y', strtotime($j->tgl_selesai)) }}
                                    </div>
                                    <div class="font-11 color-green1-dark" style="margin-top: -8px">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ Str::ucfirst($j->tempat) }}
                                        <i class="fas fa-bicycle ml-2 mr-1"></i>{{ Str::ucfirst($j->jenis) }}
                                    </div>
                                    <div class="font-11 color-brown1-dark" style="margin-top: -8px">
                                        <i class="fa fa-user-secret mr-1"></i>{{ Str::ucfirst($j->pelaksana) }}
                                    </div>
                                    <a href="#" onclick="getHtml('{{ url('mobile/rekom/create?id='.$j->id) }}')" class="btn btn-xxs float-right btn-border bg-pink1-dark">Minta Surat Rekomendasi</a>
                                    <div class="clearfix"></div>
                                    <hr class="mb-0">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
