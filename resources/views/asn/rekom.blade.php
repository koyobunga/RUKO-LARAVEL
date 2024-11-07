@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="card-box table-responsive">
        <table id="datatable" class="table table-striped ">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Diklat</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rekom as $r)
                    <tr>
                        <td style="width: 10px">{{ $loop->iteration }}</td>
                        <td  class="text-wrap" style="text-transform: capitalize">
                            <div class="mb-2" style="font-size: 14px; font-weight: bold">{{ $r->diklat->nama }}</div>
                            
                            <div>
                                    <i class="icon-location-pin mr-1 text-pink"></i>{{ $r->tempat }}
                                    <i class="icon-emotsmile mr-1 ml-2 text-purple"></i>{{ $r->pelaksana }}
                                    <i class="icon-drop mr-1 ml-2 text-success"></i>{{ $r->bentuk }}
                                    <i class=" icon-graph mr-1 ml-2 text-primary"></i>{{ $r->jalur }}
                                    <i class=" icon-loop mr-1 ml-2 text-warning"></i>{{ $r->jenis }}
                            </div>
                            
                        </td>
                        <td class="text-right">
                            <a href="{{ url('asn/rekom/'.$r->id) }}" target="_blank" class="btn btn-outline-danger btn-sm">Unduh</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection