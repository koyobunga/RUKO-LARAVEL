@include('mobile.asset')
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/setting') }}')"><i class="fa fa-arrow-left"></i></a>Rekomendasi</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/28m.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/28m.jpg') }});"></div>
        </div>
        <div class="card card-style">
           
             
            {{-- Table --}}
            <div class="content mb-2">font
                <h5>Surat Rekomendasi</h5>
                <p>
                    Unduh Surat Rekomendasi disini
                </p>
                <table class="table table-borderless text-center rounded-sm" style="overflow: hidden;">
                   
                    <tbody>
                        @foreach ($rekom as $j)
                            <tr>
                                <td class="pl-1 text-left pl-0 pb-1 pr-1">
                                    <div class="line-height-m font-700 font-16 mt-0">
                                        {{ $j->diklat->nama }}
                                    </div>    
                                    <div class="font-11 mt-2 color-blue1-dark">
                                        <i class="far fa-calendar-alt mr-1"></i>{{ date('d F Y', strtotime($j->tgl_mulai)).' s.d '.date('d F Y', strtotime($j->tgl_selesai)) }}
                                    </div>
                                    <div class="font-11 color-green1-dark" style="margin-top: -8px">
                                        <i class="fas fa-map-marker-alt mr-1"></i>{{ Str::ucfirst($j->tempat) }}
                                        <i class="fas fa-bicycle ml-2 mr-1"></i>{{ Str::ucfirst($j->jenis) }}
                                    </div>
                                    <a target="_blank" href="{{ url('mobile/rekom/'.$j->id) }}" class="btn btn-xxs float-right btn-border bg-green1-dark"><i class="far fa-file-pdf mr-2"></i>Unduh Rekomendasi</a>
                                  
                                    <form id="form-hapus" action="{{ url('mobile/rekom/'.$j->id) }}" class="float-right" method="post">
                                        @csrf
                                        @method('DELETE')  
                                        <button type="submit" data-menu="menu-hapus"  class="dropdown-item color-red1-dark" type="button"><i class="far fa-trash-alt text-pink"></i></button>
                                    </form>
                                    

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
                                getHtml('{{ url('mobile/rekom') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menghapus');
                            }
                        }
                });
            });
    });
</script>
