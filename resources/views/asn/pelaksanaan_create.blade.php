@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class=""><a class="btn btn-outline-warning btn-sm" style="margin-top: -5px" href="{{ url('/asn/pelaksanaan') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    
    @php
        $rencana_id ='';
        $diklat_id = '';
        $nama_diklat = '';
        $pelaksana = '';
        $tempat = '';
        $tgl_mulai = '';
        $tgl_selesai = '';
        $bentuk = '';
        if(isset($rencana)){
            $rencana_id = $rencana->id;
            $diklat_id = $rencana->diklat_id;
            $nama_diklat = $rencana->diklat->nama;
            $bentuk = $rencana->bentuk;
        }
        if(isset($rekom)){
                $pelaksana = $rekom->pelaksana;
                $tempat = $rekom->tempat;
                $tgl_mulai = $rekom->tgl_mulai;
                $tgl_selesai = $rekom->tgl_selesai;
            }
    @endphp

    <div class="card-box">
        <form action="{{ url('asn/pelaksanaan') }}" method="POST">
            @csrf
            @method('post')
            <input type="hidden" value="{{ old('rencana_id',$rencana_id) }}" id="rencana_id" name="rencana_id" class="form-control">
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="jalur">Diklat/Pelatihan</label>
                    <input type="text" value="{{ old('diklat', $nama_diklat) }}" name="diklat"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" value="{{ old('diklat_id', $diklat_id) }}" required id="diklat_id">
                    @error('diklat_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label for="jenis">Pelaksana Diklat</label>
                    <input type="text" id="pelaksana" name="pelaksana" value="{{ old('pelaksana',$pelaksana) }}" class="form-control" required>
                    @error('pelaksana')
                        <div class="invalid-feedback">
                            {{ $message}}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="tempat">Tempat</label>
                    <input type="text" id="tempat" name="tempat" value="{{ old('tempat',$tempat) }}" class="form-control" required>
                    @error('tempat')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div> 
                <div class="col-sm-6 mt-2">
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
                <div class="col-sm-6 mt-2">
                    <label for="jenis">Tanggal Mulai</label>
                    <input type="date" id="tgl_mulai" value="{{ old('tgl_mulai',$tgl_mulai) }}" name="tgl_mulai" class="form-control" required>
                    @error('tgl_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="jenis">Tanggal Selesai</label>
                    <input type="date" id="tgl_selesai" name="tgl_selesai" value="{{ old('tgl_selesai',$tgl_selesai) }}" class="form-control" required>
                    @error('tgl_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                    @enderror
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="jp">JP</label>
                    <input type="number" id="jp" name="jp" value="{{ old('jp') }}" class="form-control" required>
                    @error('jp')
                        <div class="invalid-feedback">
                            {{ $message}}    
                        </div>
                     @enderror
                </div>
                <div class="col-sm-6 mt-2">
                    <label for="no_serti">Nomor Sertifikat</label>
                    <input type="text" id="no_serti" name="no_serti" value="{{ old('no_serti') }}" class="form-control" required>
                    @error('no_serti')
                        <div class="invalid-feedback">
                            {{ $message }}    
                        </div>
                     @enderror
                </div>
                
            </div>
            <button type="submit" class="btn btn-success py-2 mt-2"> Simpan Laporan </button>
            <a href="{{ url('asn/pelaksanaan') }}" type="submit" class="btn btn-light py-2 mt-2"> Kembali </a>
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