@include('mobile.asset')
    
    <div class="page-content" style="min-height: 654px;">
            
        <div class="page-title page-title-small">
            <h2><a href="#" onclick="getHtml('{{ url('mobile/rekom') }}')"><i class="fa fa-arrow-left"></i></a>Rekomendasi</h2>
            <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
        </div>
        <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
            <div class="card-overlay bg-highlight opacity-80"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/20s.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/20s.jpg') }});"></div>
        </div>
        <div class="card card-style">
            <div class="d-flex content mb-1">
                <!-- left side of profile -->
                <div class="flex-grow-1">
                    <h5 class="font-500">Terbitkan Surat Rekomendasi</h5>
                    
                    <p class="mt-2" style="line-height: 120%">
                        Silahkan menerbitkan Surat Rekomendasi Pelaksana Diklat
                    </p>
                    
                </div>
                
            </div>

            

            <div id="box-form" class="p-3" tabindex="0" style="">
                <form id="form-rekom" action="{{ url('mobile/rekom') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rencana_id" id="rencana_id">
                    <input type="hidden" name="asn_id" id="asn_id" value="{{ $asn->id }}">
                    <div class="form-group row font-14">
                        <div class="col-sm-12 mt-2 mb-2 font-14">
                            <label class="mb-0"  for="jalur">Diklat/Pelatihan</label>
                            <input type="text" value="{{ $jadwal->diklat->nama }}"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                            <input type="hidden" name="diklat_id" value="{{ $jadwal->diklat->id }}" required id="diklat_id">
                        </div>
                        <div class="col-sm-12 mt-2 font-14">
                            <label class="mb-0"  for="bentuk">Bentuk Diklat</label>
                            <select required name="bentuk" id="bentuk" class="form-control" style="font-size: 13px">
                                <option value="">Pilih</option>
                                <option value="pelatihan">Pelatihan</option>
                                <option value="pendidikan">Pendidikan</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2 font-14">
                            <label class="mb-0"  for="jalur">Jalur</label>
                            <select required name="jalur" id="jalur" class="form-control" style="font-size: 13px">
                                <option value="">Pilih</option>
                                <option value="klasikal">Klasikal</option>
                                <option value="non klasikal">Non Klasikal</option>
                                <option value="blanded">Blanded</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2 font-14">
                            <label class="mb-0"  for="jenis">Bentuk Pelaksanaan</label>
                            <select required name="jenis" id="jenis" class="form-control" style="font-size: 13px">
                                <option value="">Pilih</option>
                                @foreach($jenis as $j)
                                    <option @if(old('bentuk',$jadwal->jenis)==$j->nama) {{ "selected" }} @endif value="{{ $j->nama }}">{{ $j->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 mt-2 font-14">
                            <label class="mb-0"  for="jenis">Tempat</label>
                            <input type="text" id="tempat" value="{{ $jadwal->tempat }}" name="tempat" class="form-control" required>
                        </div>
               
                        
                        <div class="col-sm-12 mt-2 ">
                            <label class="mb-0"  for="jenis">Tanggal Mulai</label>
                            <input type="date" value="{{ $jadwal->tgl_mulai }}" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="mb-0"  for="jenis">Tanggal Selesai</label>
                            <input type="date" id="tgl_selesai" value="{{ $jadwal->tgl_selesai }}" name="tgl_selesai" class="form-control" required>
                        </div>
                        <div class="col-sm-12 mt-2">
                            <label class="mb-0"  for="jenis">Pelaksana Diklat</label>
                            <input type="text" id="pelaksana" name="pelaksana" value="{{ $jadwal->pelaksana }}" class="form-control" required>
                        </div>
                    </div>
                    <button data-menu="menu-confirm" type="submit" class="btn btn-xs bg-blue2-dark mb-3"> Terbitkan Rekomendasi </button>
                </form>
            </div>


        </div>

    </div>



    {{-- Modal form --}}
    <div class="modal fade" id="modal-diklat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Diklat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body table-responsive">
                <div class="search-box search-color bg-red2-dark rounded-xl mb-3">
                    <i class="fa fa-search"></i>
                    <input id="search" type="text" class="border-0" placeholder="Search here.." data-search="">
                </div>
                <table id="data-diklat" data-ordering="false" class="table table-hover text-wrap">
                        @foreach($diklat as $d)
                            <tr data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk memilih.." onclick="set_diklat('{{ $d->id }}','{{ $d->nama }}')" style="cursor: pointer;">
                                <td style="min-width: 400px" class="text-wrap">{{ $d->nama }}</td>
                            </tr>
                        @endforeach
                    
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" style="" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      





<script>

    $(document).ready(function () {
        $('#diklat').click(function (e) { 
            e.preventDefault();
            $('#modal-diklat').modal('show');
        });

        $('#yakin').click(function (e) { 
                var form = $("#form-rekom"); 
                var reportValidity = form[0].reportValidity();
                if(reportValidity){
                    form.submit();
                    $('#menu-confirm').hideMenu();
                }            

                e.preventDefault();
            });

        $('#form-rekom').submit(function (e) { 
            e.preventDefault();
            var url = $(this).attr('action');
                    $.ajax({
                        type: "post",
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
                                $('#success').toast('show');
                                $('#success-bd').html('Data disimpan');
                                getHtml('{{ url('mobile/rekom') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menyimpan');
                            }
                        }
                    });

        });
        
    });

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#data-diklat tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    function set_diklat(id, nama){
        $('#diklat').val(nama);
        $('#diklat_id').val(id);
        $('#modal-diklat').modal('hide');
    }


    
</script>
