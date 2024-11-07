@include('mobile.asset')

    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2>Laporan</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/18m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/18m.jpg') }});"></div>
        </div>


        <div class="card card-style">
            <div class="d-flex content mb-1">
                <!-- left side of profile -->
                <div class="flex-grow-1">
                    <h5 class="font-700">Laporkan Pelaksanaan Kompetensi<i class="fa fa-check-circle color-blue2-dark float-right font-13 mt-2 mr-3"></i></h5>
                    <p class="mb-2 mt-2" style="line-height: 120%">
                        Mohon laporankan kompetensi yang telah Anda lakukan. Kompetensi <b class="color-blue1-dark">sesuai</b> perencanaan atau kompetensi yang dilakukan <b class="color-red2-dark">Tanpa Perencanaan</b> pada aplikasi RUKO.
                    </p>
                    
                </div>
                
            </div>
            <!-- follow buttons-->
            <div class="content">
                <div class="row mb-0">
                    <div class="col-6">
                        <a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan/create') }}')" class="btn btn-full btn-sm btn-border rounded-s color-theme text-uppercase font-900 border-brown2-dark">Lapor lain </a>
                    </div>
                    <div class="col-6">
                        <div class="dropdown w-100">
                            <a href="#" class="btn btn-full btn-sm rounded-s text-uppercase font-900 color-highlight bg-green2-dark" data-menu="menu-share-list">
                                Lapor Rencana</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="menu-share-list" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="310" data-menu-effect="menu-over" style="height: 310px; display: block;">
            <div class="list-group list-custom-small pl-3 pr-3">
                <h4 class="mt-4">Laporan Pelaksana atas Rencana Kompetensi</h4>
                @foreach($rencana as $key => $value)
                <a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan/create?rencana='.$value->id) }}')" class="font-500">
                    <span class="mr-2">{{ $value->tahun }}</span>
                    <span class="font-13"> 
                        @if($value->diklat != null) 
                            {{ $value->diklat->nama }}                                
                        @endif
                        </span>
                    <i class="fa fa-angle-right"></i>
                </a>     
                @endforeach                                  
            </div>
        </div>

        <div class="card card-style pr-0">
            <div class="content mb-2 pr-0 mr-0">
                <h5>List Laporan</h5>
                
                <table class="table mt-3 table-borderless text-center rounded-sm" style="overflow: hidden;">
                    <thead>
               
                    </thead>
                    <tbody>
                        @foreach ($pelaksanaan as  $p)
                        
                        <tr style="text-align: left">
                            <th scope="row " style="padding-left: 2px">
                                    @if($p->diklat_id==0) 
                                        {{ $p->ket }}
                                    @else
                                        {{ $p->diklat->nama }}                                
                                    @endif
                                <div class="font-11 line-height-s mt-2" style="font-weight: normal">
                                    <div class="d-inline">
                                        <i class="far fa-clock mr-1 rotate-45 color-green1-dark"></i> {{ $p->jp }} JP
                                    </div>
                                    <div class="d-inline">
                                        <i class="far fa-bookmark ml-2 mr-1 rotate-45 color-red1-dark"></i> {{ $p->bentuk }}
                                    </div>
                                    <div class="d-inline">
                                        @if($p->rencana_id==0)
                                            <i class="fa fa-check ml-2 mr-1 rotate-45 color-red1-dark"></i>Tidak Sesuai
                                        @else
                                            <i class="fa fa-check-square ml-2 mr-1 rotate-45 color-blue1-dark"></i></i>Sesuai
                                        @endif
                                    </div>
                                    <br>
                                    <div class="d-inline">
                                        <i class="far fa-calendar-alt mr-1 rotate-45 color-yellow1-dark"></i> {{ date('Y', strtotime($p->tgl_mulai)) }}
                                    </div>
                                    <div class="d-inline mr-5">
                                        @if($p->nm_file==NULL)
                                        <i class="fas fa-file-alt mr-1 ml-2 rotate-45 color-gray1-dark"></i> File Not Available
                                        @else
                                        <i class="fas fa-file-alt mr-1 ml-2 rotate-45 color-blue1-dark"></i> File Available
                                        @endif
                                    </div>
                                    <br>
                                    <div class="text-right ws-auto color-gray2-dark" style="margin-right: -20px">
                                        {{ $p->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </th>
                            <td class="px-0 text-right" style="padding-right: 1px">
                                <div class="dropdown m-0">
                                    <button class="btn btn-outline-pink btn-sm text-right" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v color-theme"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right px-0 font-13" aria-labelledby="dropdownMenu2">
                                        @if($p->nm_file==NULL)
                                            <a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan/'.$p->id) }}')" class="dropdown-item"><i class="fa fa-cloud-upload mr-1"></i>Unggah file</a>
                                        @else
                                            <a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan/'.$p->id) }}')" class="dropdown-item"><i class="fa fa-edit mr-1"></i>Perbarui file</a>
                                            <a target="_blank" href="{{ url('mobile/download/pelaksanaan/'.$p->id) }}" class="dropdown-item"><i class="fa fa-download mr-1"></i>Unduh Sertifikat</a>
                                        @endif
                                        <hr class="my-1">
                                        <a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan/'.$p->id.'/edit') }}')" class="dropdown-item" type="button"><i class="far fa-edit mr-1"></i>Edit Laporan</a>
                                        <form id="form-hapus" action="{{ url('mobile/pelaksanaan/'.$p->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')  
                                                <button type="submit" data-menu="menu-hapus" class="dropdown-item color-red1-dark" type="button"><i class="far fa-trash-alt mr-1 text-pink"></i>Hapus Laporan</button>
                                        </form>
                                    
                                    </div>
                                  </div>
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

<script>
    $(document).ready(function () {
        $('#hapus').click(function (e) { 
                var form = $("#form-hapus"); 
                var reportValidity = form[0].reportValidity();
                if(reportValidity){
                    form.submit();
                }            
                $('#menu-hapus').hideMenu();
                e.preventDefault();
            });
        
            $('#form-hapus').submit(function (e) { 
            e.preventDefault();
            var url = $(this).attr('action');
                    $.ajax({
                        type: "delete",
                        url: url,
                        data: $(this).serialize(),
                        dataType: "json",
                        beforeSend: function(){
                            $('#toast-loading').toast('show');
                        },
                        complete: function(){
                            $('#toast-loading').toast('hide');
                        },
                        success: function (response) {
                            $('#toast-loading').toast('hide');
                            if(response.msg == 1){
                                $('#info').toast('show');
                                $('#info-bd').html('Data dihapus');
                                getHtml('{{ url('mobile/pelaksanaan') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menghapus');
                            }
                        }
                    });

            });
    });
</script>


