@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#"></a></li>
                        <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($opd)
        <div class="card-box">
            <div class="header-title mb-0">DATA OPD</div>
            <div class="text-warning mb-3"></div>
            <table class="table table-hover" id="datatable-buttons">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama OPD</th>
                        <th>Jumlah ASN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opd as $o )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $o->nama }}</td>
                            <td>{{ $o->jumlah_asn }}</td>
                            <td>
                                <button onclick="setOpd({{ $loop->index }})" class="btn btn-outline-warning btn-sm"><i class="mdi mdi-folder-edit"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-muted h4 mt-5 text-center"><i class="icon-info mr-2"></i>Tidak ada Data OPD</div>
    @endif



    <!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" id="form-edit">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit OPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="tugas">Nama OPD</label>
                            <input class="form-control" type="text" required name="nama" id="nama" placeholder="Nama OPD">
                        </div>
                        <div class="col-12">
                            <label for="tugas">Jumlah ASN</label>
                            <input class="form-control @error('jumlah_asn') is-invalid @enderror" type="number" required name="jumlah_asn" id="jumlah_asn" placeholder="Jumlah ASN">
                            @error('jumlah_asn')
                                    <div class="invalid-feedback">
                                        {{ $message}}    
                                    </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>
  </div>


<script>

    var opd = {!! json_encode($opd) !!}
    
    function setOpd(i){
        $('#nama').val(opd[i].nama);
        $('#jumlah_asn').val(opd[i].jumlah_asn);
        var url = '{{ url('admin/opd') }}'+'/'+opd[i].id;
        $('#form-edit').attr('action', url);
        $('#modal-edit').modal('show');
    }
    
</script>

@endsection