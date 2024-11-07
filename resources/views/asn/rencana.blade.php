@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        {{-- <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 


    <div class="card-box mb-0">
        <div class="header-title">Rencanakan Pengembangan Kompetensi Anda 5 (Lima) Tahun kedepan</div>
        <hr>
        <form action="{{ url('/asn/rencana') }}" method="post">
            @csrf
            @method('post')
            <div class="form-group row">
                <div class="col-sm-2">
                    <label for="tahun">Tahun</label>
                    <select required name="tahun" id="tahun" class="form-control">
                        @for($i = 0; $i < 5; $i++)
                            <option value="{{ $i+date('Y') }}">{{ $i+date('Y') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="bentuk">Bentuk</label>
                    <select required name="bentuk" id="bentuk" class="form-control">
                        <option value="">Pilih</option>
                        <option value="pelatihan">Pelatihan</option>
                        <option value="pendidikan">Pendidikan</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="jalur">Jalur</label>
                    <select required name="jalur" id="jalur" class="form-control">
                        <option value="">Pilih</option>
                        <option value="klasikal">Klasikal</option>
                        <option value="non klasikal">Non Klasikal</option>
                        <option value="blanded">Blanded</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="jalur">Diklat/Pelatihan</label>
                    <input type="text"  readonly id="diklat" required placeholder="Klik untuk cari..." class="form-control">
                    <input type="hidden" name="diklat_id" required id="diklat_id">
                </div>
                <div class="col-sm-2" style="padding-top: 27px">
                    <button onclick="return confirm('Tambahkan Rencana?')" type="submit" class="btn btn-outline-pink" style="height: 33px; vertical-align: middle">Simpan Rencana</button>
                </div>
            </div>
        </form>
    </div>

    
    <div class="card-box table-responsive mt-3">
        

        <table id="datatable" class="table table-hover text-wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        
            <thead>
            <tr class="text-center">
                <th style="width: 10px">No.</th>
                <th>Tahun</th>
                <th>Diklat</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody> 
                @foreach($rencana as $r)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td class="font-weight-bold">{{ $r->tahun }}</td>
                        <td class="text-left">
                            @if($r->diklat != null)    
                                {{ $r->diklat->nama }}
                            @endif
                            <div class="mt-1 mb-2" style="text-transform: capitalize">
                                <span class="text-pink"><i class="icon-graph mr-1"></i>{{ $r->jalur }}</span>
                                <span class="text-purple"><i class="icon-emotsmile mr-1 ml-2 text-purple"></i>{{ $r->bentuk }}</span>
                            </div>
                        </td>
                        <td style="font-size: 12px" class="text-left">
                            @if($r->sts==2)
                                <div class="text-success p-1"><i class="icon-check mr-1"></i>Dilaksanakan</div>
                            @else
                                <div class="text-muted p-1">Merencanakan ...</div>
                            @endif
                        </td>
                        <td>
                            @if($r->sts != 2)
                                @php
                                       $j = $jadwal->where('diklat_id', $r->diklat_id); 
                                       @endphp
                                @if($j->count())
                                <a href="{{ url('/asn/jadwal/'.$j->first()->id) }}" class="btn btn-sm btn-outline-blue noti-icon">Jadwal 
                                    <span class="badge badge-warning rounded-circle ml-1" style="padding:3px; font-size:10px">{{ $j->count() }}</span>
                                </a>
                                @endif
                                @endif
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- end main --}}
    


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