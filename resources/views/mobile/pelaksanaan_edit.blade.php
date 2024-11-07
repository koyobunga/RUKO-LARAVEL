@include('mobile.asset')
<div class="page-content" style="min-height: 654px;">
            
    <div class="page-title page-title-small">
        <h2><a href="#" onclick="getHtml('{{ url('mobile/pelaksanaan') }}')"><i class="fa fa-arrow-left"></i></a>Kembali</h2>
        <a href="#" data-menu="menu-main" style="width: 50px; height: 50px;" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{ url('img/icon/rr.png') }}" style="background-image: url({{ url('mobiles/images/avatars/5s.png') }});"></a>
    </div>
    <div class="card header-card shape-rounded" data-card-height="210" style="height: 210px;">
        <div class="card-overlay bg-highlight opacity-80"></div>
        <div class="card-overlay dark-mode-tint"></div>
        <div class="card-bg preload-img" data-src="{{ url('mobiles/images/pictures/20s.jpg') }}" style="background-image: url({{ url('mobiles/images/pictures/20s.jpg') }});"></div>
    </div>

    <div class="card card-style">
        <div class="content mb-0">        
            <h5>Input Laporan</h5>
            <p style="line-height: 120%" class="mb-4 mt-2">
                Silahkan Merencankan Pengembangan Kompetensi 5 Tahunan
            </p>

        </div>
    </div> 
    

    <div class="card card-style p-3">
        <form id="form-laporan" action="{{ url('mobile/pelaksanaan/'.$laporan->id) }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden"  value="{{ old('rencana_id',$laporan->rencana_id) }}" id="rencana_id" name="rencana_id" class="form-control">
            <div class="form-group row">
                <div class="col-sm-12 mt-2">
                    @php
                        
                        if($laporan->diklat_id==0){
                            $nm_diklat = $laporan->ket;
                        }else{
                            $nm_diklat = $laporan->diklat->nama;
                        }
                    @endphp
                    <label for="jalur" class="mb=0">Diklat/Pelatihan</label>
                    <input type="text" value="{{ old('diklat',$nm_diklat) }}" name="diklat"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" value="{{ old('diklat_id', $laporan->diklat_id) }}" required id="diklat_id">
                    @error('diklat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="jenis" class="mb=0">Pelaksana Diklat</label>
                    <input type="text" id="pelaksana" name="pelaksana" value="{{ old('pelaksana',$laporan->pelaksana) }}" class="form-control" required>
                    @error('pelaksana')
                        <div class="invalid-feedback">
                            {{ $message}}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="tempat" class="mb=0">Tempat</label>
                    <input type="text" id="tempat" name="tempat" value="{{ old('tempat',$laporan->tempat) }}" class="form-control" required>
                    @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div> 
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="bentuk" class="mb=0">Bentuk </label>
                    <select required class="form-control font-14 @error('bentuk') is-invalid @enderror" name="bentuk" id="bentuk">
                        <option value="">Pilih</option>
                        @foreach($jenis as $j)
                            <option @if(old('bentuk',$laporan->bentuk)==$j->nama) {{ "selected" }} @endif value="{{ $j->nama }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                    @error('bentuk')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="jenis" class="mb=0">Tanggal Mulai</label>
                    <input type="date" id="tgl_mulai" value="{{ old('tgl_mulai',$laporan->tgl_mulai) }}" name="tgl_mulai" class="form-control" required>
                    @error('tgl_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="jenis" class="mb=0">Tanggal Selesai</label>
                    <input type="date" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai',$laporan->tgl_selesai) }}" class="form-control" required>
                    @error('tgl_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="jp" class="mb=0">JP</label>
                    <input type="number" id="jp" value="{{ old('jp',$laporan->jp) }}" name="jp" class="form-control" required>
                    @error('jp')
                        <div class="invalid-feedback">
                            {{ $message}}    
                        </div>
                     @enderror
                </div>
                <div class="col-sm-12 mt-2 mt-2">
                    <label for="no_serti" class="mb=0">Nomor Sertifikat</label>
                    <input type="text" id="no_serti" name="no_serti" value="{{ old('no_serti', $laporan->no_serti) }}" class="form-control" required>
                    @error('no_serti')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                     @enderror
                </div>
                
            </div>
            <button type="submit" data-menu="menu-confirm" class="btn btn-success btn-sm py-1"> Simpan Laporan </button>
        </form>
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
                var form = $("#form-laporan"); 
                var reportValidity = form[0].reportValidity();
                if(reportValidity){
                    form.submit();
                }            
                $('#menu-confirm').hideMenu();

                e.preventDefault();
            });

            $('#form-laporan').submit(function (e) { 
            e.preventDefault();
            var url = $(this).attr('action');
                    $.ajax({
                        type: "put",
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
                                $('#info-bd').html('Data diperbarui');
                                getHtml('{{ url('mobile/pelaksanaan') }}');
                            }else{
                                $('#error').toast('show');
                                $('#error-bd').html('Gagal menyimpan');
                            }
                        }
                    });

            });
        });
    
        function set_diklat(id, nama){
            $('#diklat').val(nama);
            $('#diklat_id').val(id);
            $('#modal-diklat').modal('hide');
        }

        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#data-diklat tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
    </script>
