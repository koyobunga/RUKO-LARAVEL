@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="btn btn-sm btn-outline-warning" href="{{ url('admin/jadwal') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="card-box">
        <form action="{{ url('admin/jadwal/'.$jadwal->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row">
                <div class="col-6">
                    <label for="jalur">Diklat/Pelatihan</label>
                    <input type="text" value="{{ old('diklat', $nama_diklat) }}" name="diklat"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" value="{{ old('diklat_id', $jadwal->diklat_id) }}" required id="diklat_id">
                @error('diklat_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
                <div class="col-6">
                    <label for="pelaksanan">Pelaksana</label>
                    <input required class="form-control @error('pelaksana') is-invalid @enderror" type="text" name="pelaksana" value="{{ old('pelaksana', $jadwal->pelaksana) }}">
                    @error('pelaksana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-3 mt-2">
                    <label for="tempat">Tempat</label>
                    <input required class="form-control @error('tempat') is-invalid @enderror" type="text" name="tempat" value="{{ old('tempat', $jadwal->tempat) }}">
                    @error('tempat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-3 mt-2">
                    <label for="jenis">Bentuk Diklat</label>
                    <select required class="form-control @error('nama') is-invalid @enderror" name="jenis" id="jenis">
                        <option value="">Pilih</option>
                        @foreach($jenis as $j)
                            <option @if(old('jenis',$jadwal->jenis)==$j->nama) {{ "selected" }} @endif value="{{ $j->nama }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                    @error('diklat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="jenis">Tanggal Mulai</label>
                    <input type="date" id="tgl_mulai" value="{{ old('tgl_mulai',$jadwal->tgl_mulai) }}" name="tgl_mulai" class="form-control" required>
                    @error('tgl_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-3 mt-2">
                    <label for="jenis">Tanggal Selesai</label>
                    <input type="date" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai',$jadwal->tgl_selesai) }}" class="form-control" required>
                    @error('tgl_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan </button>
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
    });

    function set_diklat(id, nama){
        $('#diklat').val(nama);
        $('#diklat_id').val(id);
        $('#modal-diklat').modal('hide');
    }
    
</script>

@endsection