@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li><a class="btn btn-success btn-sm" href="{{ url('admin/serti/create') }}">Buat Sertifikat</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($serti->count())
        <div class="card-box">
            <div class="header-title mb-0">DATA SERTIFIKA</div>
            
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Sertifikat</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serti as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="mb-2 font-weight-bold">{{ $s->diklat->nama }}</div>
                                <div style="">
                                    <i class="icon-clock mr-1 text-pink"></i><b>{{ $s->jp }}</b> JP
                                    <i class="icon-emotsmile mr-1 ml-2 text-purple"></i>{{ $s->bentuk }}
                                    <i class="icon-user-female mr-1 ml-2 text-primary"></i>{{ $s->opd->nama }}
                                    <i class="icon-calender  mr-1 ml-2 text-warning"></i>{{ $s->tgl_mulai.' s.d '.$s->tgl_selesai }}
                                </div>
                            </td>
                            <td>
                                @if($s->sts == 1)
                                    <div class="badge bg-warning p-1"> Telah Singkron </div>
                                
                                @endif
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-success btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-settings"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                     
                                      <a href="{{ url('admin/serti/'.$s->id) }}" class="dropdown-item" type="button"><i class="mdi mdi-account-edit mr-1"></i>Kelola Sertifikat</a>
                                      <a href="{{ url('admin/serti/'.$s->id.'/edit') }}" class="dropdown-item" type="button"><i class="mdi mdi-square-edit-outline mr-1"></i>Edit Sertifikat</a>
                                      @if($s->id==0)
                                      <hr class="mt-1 mb-1">
                                      <form action="{{ url('admin/serti/'.$s->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')  
                                            <button style="color: brown" type="submit" onclick="return confirm('Hapus data Sertifikat?')" class="dropdown-item" type="button"><i class="mdi mdi-trash-can-outline mr-1 text-danger"></i>Hapus Sertifikat</button>
                                       </form>
                                       @endif
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data Sertifikat</div>
    @endif

<script>

    
</script>

@endsection