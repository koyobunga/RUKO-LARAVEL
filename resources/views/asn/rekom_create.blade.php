@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class=""><a class="btn btn-sm btn-outline-secondary" href="{{ url('asn/jadwal') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($jadwal->count())
        <div class="card-box">
            <h5>{{ $jadwal->diklat->nama }}</h5>
            <div class="text-purple d-inline mr-2">
                <i class="icon-calender mr-1"></i>{{ $jadwal->tgl_mulai.' s.d '.$jadwal->tgl_selesai }}
            </div>

            <div class="text-pink d-inline mr-2">
                <i class="icon-location-pin mr-1"></i>{{ $jadwal->tempat }}
            </div>
            <div class="text-success d-inline mr-2">
                <i class="icon-emotsmile mr-1"></i>{{ $jadwal->pelaksana }}
            </div>
            
        </div>
    @endif
    @if($rencana->count())
        <div class="card-box py-2">
            <div class="h5">Rencana Komptensi yang Sesuai dengan Jadwal Diklat di Atas:</div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Bentuk</th>
                        <th>Jalur</th>
                        <th>Diklat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rencana as $r)
                        <tr style="text-transform: uppercase">
                            
                            <td class="text-purple">{{ $r->tahun }}</td>
                            <td>{{ $r->bentuk }}</td>
                            <td>{{ $r->jalur }}</td>
                            <td>{{ $r->diklat->nama }}</td>
                            <td class="text-right">
                                <form action="{{ route('rekom.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="rencana_id" value="{{ $r->id }}">
                                    <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                                    <button onclick="return confirm('Terbitkan sekarang?')" type="submit" class="btn btn-pink">Terbitkan</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else

    <div id="box-form" class="card-box p-4" tabindex="0" style="">
        <form action="{{ route('rekom.store') }}" method="POST">
            @csrf
            @method('post')
            <input type="hidden" name="rencana_id" id="rencana_id">
            <input type="hidden" name="asn_id" id="asn_id" value="{{ $asn->id }}">
            <div class="form-group row">
                <div class="col-sm-12 mb-2">
                    <label for="jalur">Diklat/Pelatihan</label>
                    <input type="text" value="{{ $jadwal->diklat->nama }}"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" value="{{ $jadwal->diklat->id }}" required id="diklat_id">
                </div>
                <div class="col-sm-3">
                    <label for="bentuk">Bentuk Diklat</label>
                    <select required name="bentuk" id="bentuk" class="form-control">
                        <option value="">Pilih</option>
                        <option value="pelatihan">Pelatihan</option>
                        <option value="pendidikan">Pendidikan</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="jalur">Jalur</label>
                    <select required name="jalur" id="jalur" class="form-control">
                        <option value="">Pilih</option>
                        <option value="klasikal">Klasikal</option>
                        <option value="non klasikal">Non Klasikal</option>
                        <option value="blanded">Blanded</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="jenis">Bentuk Pelaksanaan</label>
                    <select required name="jenis" id="jenis" class="form-control">
                        <option value="">Pilih</option>
                        @foreach($jenis as $j)
                            <option @if(old('bentuk',$jadwal->jenis)==$j->nama) {{ "selected" }} @endif value="{{ $j->nama }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <label for="jenis">Tempat</label>
                    <input type="text" id="tempat" value="{{ $jadwal->tempat }}" name="tempat" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                
                <div class="col-sm-3 ">
                    <label for="jenis">Tanggal Mulai</label>
                    <input type="date" value="{{ $jadwal->tgl_mulai }}" id="tgl_mulai" name="tgl_mulai" class="form-control" required>
                </div>
                <div class="col-sm-3 ">
                    <label for="jenis">Tanggal Selesai</label>
                    <input type="date" id="tgl_selesai" value="{{ $jadwal->tgl_selesai }}" name="tgl_selesai" class="form-control" required>
                </div>
                <div class="col-sm-6 ">
                    <label for="jenis">Pelaksana Diklat</label>
                    <input type="text" id="pelaksana" name="pelaksana" value="{{ $jadwal->pelaksana }}" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-pink mt-2"> Terbitkan Rekomendasi </button>
        </form>
    </div>


    @endif

    

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