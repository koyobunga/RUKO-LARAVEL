@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a class="btn btn-sm btn-outline-warning" href="{{ url('admin/diklat') }}">Kembali</a></li>
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    <div class="card-box">
        <form action="{{ url('admin/diklat/'.$diklat->id) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-group row">
                <div class="col-6">
                    <label for="tugas">Diklat</label>
                    <input required class="form-control" type="text" name="nama" value="{{ $diklat->nama }}">
                </div>
                <div class="col-6">
                    <label for="tugas">Kategori Diklat</label>
                    <select required class="form-control" name="kategoridiklat_id" id="kategoridiklat_id">
                        @foreach($kategoridiklat as $k)
                            <option @if($diklat->kategoridiklat_id==$k->id) {{ "selected" }} @endif value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-info">Simpan Perubahan</button>
        </form>
    </div>
<script>

    
</script>

@endsection