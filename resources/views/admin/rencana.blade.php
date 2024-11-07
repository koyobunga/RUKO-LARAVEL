@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <form action="{{ url('admin/rencana') }}" method="GET">
                                @csrf
                                @method('get')
                                <div class="input-group" style="margin-top: -5px">
                                    <input name="search" type="text" class="form-control" placeholder="Cari nama ASN..." aria-label="Recipient's username" value="{{ $search }}" aria-describedby="basic-addon2" style="width: 300px">
                                    <div class="input-group-append">
                                      <button type="submit" class="input-group-text " id="basic-addon2">
                                        <i class="mdi mdi-account-search mr-1"></i>Search</button>
                                    </div>
                                  </div>
                            </form>
                        </li>
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    @if($asn->count())
        <div class="card-box">
            <div class="header-title mb-0">DATA ASN</div>
            <div class="text-warning mb-3">Pilih ASN untuk menampilkan data Rencana Kompetensi</div>
            <table class="table table-hover">
                @foreach($asn as $a)
                        <tr>
                            <td class="text-left" style="vertical-align: middle; width: 10px">
                                @if($a->rencana->count()>0)
                                    <a class="btn btn-outline-success" style="font-size: 15px; padding:3px 10px 1px 10px" href="{{ url('admin/rencana/'.$a->id) }}"> <i class=" icon-eye"></i></a>
                                @else
                                    <a onclick="return alertify.warning('Tidak terdapat Rencana Kompetensi')" class="btn btn-outline-secondary" style="font-size: 15px; padding:3px 10px 1px 10px"> <i class=" icon-eye"></i></a>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold mb-1">{{ $a->nama }}</div>
                                <div>NIP. {{ $a->nip }}</div>
                                <div class="row">
                                    <div class="col-sm-10  ">{{ $a->opd->nama }}</div>
                                    <div class="col-sm-2 text-right @if($a->rencana->count()>0) text-success @else text-secondary @endif">
                                        <b>{{ $a->rencana->count() }}</b> Rencana</div>
                                </div>
                                    
                            </td>
                        </tr>
                @endforeach
            </table>
            {{ $asn->links() }}
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada data ditampilkan</div>
    @endif

<script>

    
</script>

@endsection