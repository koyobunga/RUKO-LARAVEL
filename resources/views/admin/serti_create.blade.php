@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li><a class="btn btn-outline-warning" style="margin-top: -5px" href="{{ url('admin/serti') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
  
    <div class="card-box px-4">
        <div class="header-title mb-3" style="font-size: 13px">Silahkan Mengisi Formulir Sertifkat</div>
        <form action="{{ url('admin/serti') }}" method="POST">
            @csrf
            @method('post')
            <div class="form-group row">
                <div class="col-6">
                    <label for="jalur">Diklat/Pelatihan</label>
                    <input type="text" value="{{ old('diklat') }}"  readonly name="diklat" id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" value="{{ old('diklat_id') }}" required id="diklat_id">
                    @error('diklat_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="opd_id">Pelaksana Diklat</label>
                    <select required class="form-control @error('opd_id') is-invalid @enderror" name="opd_id" id="opd_id">
                        <option value="">Pilih</option>
                        @foreach($opd as $o)
                            <option @if(old('opd_id')==$o->id) {{ "selected" }} @endif value="{{ $o->id }}">{{ $o->nama }}</option>
                        @endforeach
                    </select>
                    @error('opd_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3">
                    <label for="tempat">Tempat</label>
                    <input type="text" id="tempat" value="{{ old('tempat') }}" name="tempat" class="form-control" required>
                    @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="jenis">Tanggal Mulai</label>
                    <input type="date" id="tgl_mulai" value="{{ old('tgl_mulai') }}" name="tgl_mulai" class="form-control" required>
                    @error('tgl_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="jenis">Tanggal Selesai</label>
                    <input type="date" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai') }}" class="form-control" required>
                    @error('tgl_selesai')
                    <div class="invalid-feedback">
                        {{ $message }}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="bentuk">Bentuk </label>
                    <select required class="form-control @error('bentuk') is-invalid @enderror" name="bentuk" id="bentuk">
                        <option value="">Pilih</option>
                        @foreach($jenis as $j)
                            <option @if(old('bentuk')==$j->nama) {{ "selected" }} @endif value="{{ $j->nama }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                    @error('bentuk')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="jp">JP</label>
                    <input type="number" id="jp" name="jp" value="{{ old('jp') }}" class="form-control" required>
                    @error('jp')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                
                <div class="col-sm-12 header-title mt-3 mb-1" style="font-size:12px">Nomor Sertifikat</div>
                <div class="col-sm-2 pt-1 pr-1">
                    <input type="text" value="{{ old('no_1') }}" id="no_1" name="no_1" class="form-control" required>
                    @error('no_1')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-1 p-1">
                    <input type="text" readonly value="000" id="no_2" name="no_2" value="{{ old('no_2') }}" class="form-control text-center" required>
                    @error('no_2')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-2 p-1">
                    <input type="text" readonly value="BPSDM" id="no_3" name="no_3" value="{{ old('no_3') }}" class="form-control text-center" required>
                    @error('no_3')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-1 p-1">
                    <input type="text" value="{{ old('no_4') }}" id="no_4" name="no_4" class="form-control text-center" required>
                    @error('no_4')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-1 p-1">
                    <input type="text" value="{{ old('no_5') }}" id="no_5" name="no_5" class="form-control text-center" required>
                    @error('no_5')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-1 p-1">
                    <input type="text" value="{{ old('no_6') }}" id="no_6" name="no_6" class="form-control text-center" required>
                    @error('no_6')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-1 p-1">
                    <input type="text" value="{{ old('no_7') }}" id="no_7" name="no_7" class="form-control text-center" required>
                    @error('no_7')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 text-pink" style="font-size: 12px">LABEL SERTIFIKAT <SMAll class="text-pink ml-3">** Label digunakan untuk keterangan pada sertifika</SMAll>
                    <hr class="my-0">
                </div>
                <div class="col-sm-12 mt-2">
                    <label for="label">Label Bentuk <small class="text-danger ml-2">Misal: Sebagai Peserta Diklat</small></label>
                    <input type="text" value="{{ old('label_bentuk') }}" id="label_bentuk" name="label_bentuk" class="form-control" required>
                    @error('label_bentuk')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-12">
                    <label for="label">Label Diklat</label>
                    <input type="text" value="{{ old('label_diklat') }}" id="label_diklat" name="label_diklat" class="form-control" required>
                    @error('label_diklat')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>

                <div class="col-sm-12 mt-3 text-pink" style="font-size: 12px">YANG BERTANDA TANGAN <SMAll class="text-pink ml-3"></SMAll>
                    <hr class="my-0">
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="label">Ditanda tangani oleh</label>
                    <input type="text" value="{{ old('ttd_oleh') }}" id="ttd_oleh" name="ttd_oleh" class="form-control" required>
                    @error('ttd_oleh')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="label">Nama Pejabat</label>
                    <input type="text" value="{{ old('ttd_nama',$kaban->nama) }}" id="ttd_nama" name="ttd_nama" class="form-control" required>
                    @error('ttd_nama')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="label">NIP</label>
                    <input type="text" value="{{ old('ttd_nip',$kaban->nip) }}" id="ttd_nip" name="ttd_nip" class="form-control" required>
                    @error('ttd_nip')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="label">Pangkat</label>
                    <input type="text" value="{{ old('ttd_pangkat',$kaban->pangkat) }}" id="ttd_pangkat" name="ttd_pangkat" class="form-control" required>
                    @error('ttd_pangkat')
                    <div class="invalid-feedback">
                        {{ $message}}    
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Simpan data</button>
        </form>
    </div>


       {{-- Modal form --}}
       <div class="modal fade" id="modal-diklat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Diklat/Pelatihan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <table id="datatable-buttons" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Diklat</th>
                            <th style="width: 10px">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($diklat as $d)
                            <tr data-toggle="tooltip" data-placement="top" title="" data-original-title="Klik untuk memilih.." onclick="set_diklat('{{ $d->id }}','{{ $d->nama }}')" style="cursor: pointer;">
                                <td style="min-width: 400px" class="text-wrap">{{ $d->nama }}</td>
                                <td>{{ $d->kategoridiklat->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

        $('#bentuk').change(function (e) { 
            e.preventDefault();
            $('#no_1').val($(this).val().toUpperCase());
        });
    });

    function set_diklat(id, nama){
        $('#diklat').val(nama);
        $('#label_diklat').val(nama);
        $('#diklat_id').val(id);
        $('#modal-diklat').modal('hide');
    }
    
</script>

@endsection