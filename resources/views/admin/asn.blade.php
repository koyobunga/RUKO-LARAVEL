@php
    use App\Models\User;
@endphp

@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="mr-1">
                            <form action="{{ url('admin/asn') }}" method="get">
                                
                                <div class="input-group mb-3">
                                    <input autofocus value="{{ $search }}" name="search" type="text" class="form-control" style="margin-top: -5px; border: none; padding-left: 3px; border-bottom: 1px solid #f0f0f0; width: 200px;" placeholder="Search ASN...">
                                    <div class="input-group-append">
                                      <button style="margin-top: -5px; border: none; border: 1px solid #f0f0f0; border-radius:0px 5px 5px 0px;" class="btn btn-outline-secondary" type="submit"><i class="fe-search"></i></button>
                                    </div>
                                  </div>
                            </form>
                        </li>
                        <li class="mr-1">
                            <form action="{{ url('admin/asn') }}" method="get">
                                @csrf
                                <div class="input-group mb-3" style="margin-top: -5px">
                                    <select required class="form-control" style="border: #f8f8f8 1px solid; width: 200px; border:none; border-bottom: 1px solid #f0f0f0" name="opd_id" id="inputGroupSelect02">
                                        <option value="">Pilih OPD</option>
                                        <option value="nonactif">ASN Non Aktif</option>
                                        @foreach($opd as $key)
                                        <option @if(request('opd_id')==$key->id) selected @endif value="{{$key->id }}">{{ $key->nama }}</option>
                                        @endforeach
                                    </select>
                                        <button style="border: none;  border: 1px solid #f0f0f0; border-radius:0px 5px 5px 0px;" type="submit" class="btn  btn-outline-secondary btn-sm" >
                                            <i class="fe-filter"></i> Filter
                                        </button>
                                    
                                </div>
                            </form>
                        </li>
                        <li class="">
                            <button  data-toggle="modal" data-target="#modal-form" class="btn ml-4 btn-success" style="margin-top: -5px">Tambah data</button>
                        </li>
                            
                        
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if(empty($asn))
    <h4 class="text-center text-muted mt-5"><i class="icon-info mr-2"></i>Silahkan (filter/search) data ASN..</h4>
    @elseif($asn->count())    
        <div class="card-box">
           
                

            @if(request('opd_id')=='nonactif')
                <div class="header-title mb-0">ASN Non Active</div>
                <div class="text-pink mb-3">List ASN dengan status Non Active</div>
            @else
                @if($asn[0]->opd) 
                    <div class="header-title mb-0">
                        {{ $asn[0]->opd->nama }}
                    </div>
                    <div class="text-pink mb-3">Organisasi Perangkat Daerah</div>
                @endif
            @endif($condition)


            <table class="table table-hover text-wrap" id="datatable-buttons">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ASN</th>
                        <th>Status</th>
                        <th>Akun</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($asn as $a)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div style="font-size: 15px">
                                    {{ $a->nama }}
                                </div>
                                <div style="font-size: 12px">Nip. {{ $a->nip }}</div>
                                @if(request('opd_id')=='nonactif')
                                    <div class="mt-1" style="font-size: 12px; font-weight: bold">{{ $a->opd->nama }}</div>
                                @endif
                            </td>
                            
                            <td>
                                @if($a->sts==1)
                                <span class="text-success">{{ 'Active' }}</span>
                                @else
                                <span class="text-warning">{{ 'Inactive' }}
                                @endif
                            </td>
                            <td>
                                @php
                                    $user = User::where('asn_id', $a->id)->first();
                                @endphp
                                    @if($user->sts==1)
                                        <span class="text-blue">{{ 'On' }}</span>
                                    @else
                                        <span class="text-danger">{{ 'Off' }}
                                    @endif
                            </td>
                            <td style="width: 10px">
                                <div class="dropdown">
                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-settings"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                      @if($a->sts==0)
                                        <a href="{{ url('admin/asn/hidupkan/'.$a->id) }}" class="dropdown-item" type="button"><i class=" mdi mdi-eye mr-1"></i>Aktifkan Status ASN</a>
                                      @endif
                                      @if($a->sts==1)
                                        <a href="{{ url('admin/asn/matikan/'.$a->id) }}" class="dropdown-item" type="button"><i class=" mdi mdi-eye-off mr-1"></i>Non Aktifkan Status ASN</a>
                                      @endif
                                      <a href="{{ url('admin/asn/'.$a->id.'/edit') }}" class="dropdown-item" type="button"><i class="mdi mdi-account-edit mr-1"></i>Edit ASN</a>
                                      <form action="{{ url('admin/asn/'.$a->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')  
                                            <button type="submit" onclick="return confirm('Hapus data ASN?')" class="dropdown-item" type="button"><i class="mdi mdi-trash-can-outline mr-1"></i>Hapus Data ASN</button>
                                       </form>
                                    <hr class="mb-1 mt-0">
                                        <a href="{{ url('admin/asn/pulihkanpassword/'.$a->id) }}" class="dropdown-item" type="button"><i class="mdi mdi-key mr-1"></i>Pulihkan Password</a>
                                        @if($user->sts==0)
                                            <a href="{{ url('admin/asn/akunon/'.$user->id) }}" class="dropdown-item" type="button"><i class=" mdi mdi-eye mr-1"></i>Hidupkan akun</a>
                                        @endif
                                        @if($user->sts==1)
                                            <a href="{{ url('admin/asn/akunoff/'.$user->id) }}" class="dropdown-item" type="button"><i class=" mdi mdi-eye-off mr-1"></i>Matikan akun</a>
                                        @endif
                                    </div>
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    @else
        <h4 class="text-center text-muted mt-5"><i class="icon-info mr-2"></i>Tidak dimukan data..</h4>
    @endif

    <!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form action="{{ url('admin/asn') }}" method="post">
            @csrf
            @method('post')
            
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah ASN</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tugas">Nama</label>
                            <input class="form-control" type="text" required name="nama" id="nama" placeholder="Nama">
                        </div>
                        <div class="col-12">
                            <label for="tugas">NIP</label>
                            <input class="form-control" type="text" required name="nip" id="nip" placeholder="NIP">
                        </div>
                        <div class="col-12">
                            <label for="tugas">OPD</label>
                            <select required class="form-control" name="opd_id" id="opd_id">
                                @foreach($opd as $opd)
                                    <option  value="{{ $opd->id }}">{{ $opd->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
      </div>
    </div>
  </div>

@endsection