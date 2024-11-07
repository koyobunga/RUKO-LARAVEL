@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    <div class="btn-group btn-group-justified text-white mb-2">

        <a href="{{ url('asn/profile') }}" class="btn btn-{{ (request()->is('asn/profile'))? '' : 'outline-' }}primary waves-effect waves-light" role="button"><i class="mdi mdi-tooltip-account mr-1"></i> Profile</a>
        <a href="{{ url('asn/sudah') }}" class="btn btn-{{ (request()->is('asn/sudah'))? '' : 'outline-' }}warning waves-effect waves-light" role="button"><i class="icon-like mr-1"></i> Kompetensi Diikuti</a>
        <a href="{{ url('asn/belum') }}" class="btn btn-{{ (request()->is('asn/belum'))? '' : 'outline-' }}danger waves-effect waves-light" role="button"><i class="icon-paper-plane mr-1"></i> Kompetensi Dibutuhkan</a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box p-4">
                <form action="{{ url('asn/profile/up') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="tugas">Nama</label>
                            <input class="form-control" type="text" required name="nama" id="nama" value="{{ $asn->nama }}" placeholder="Nama">
                        </div>
                        <div class="col-6">
                            <label for="tugas">NIP</label>
                            <input class="form-control  @error('nip') is-invalid @enderror" type="text" required name="nip" id="nip" value="{{ $asn->nip }}" placeholder="NIP">
                        </div>
                        @error('nip')
                                    <div class="invalid-feedback">
                                        {{ $message}}    
                                    </div>
                                @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-3">
                            <label for="pendidikan">Pendidikan</label>
                                @php
                                    $pend = ['SMP', 'SMA/SMK', 'D1', 'D2', 'D3' ,'D4', 'S1', 'S2','S3'];
                                @endphp
                            <select required name="pendidikan" id="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                <option value=""></option>
                                @foreach($pend as $p)
                                    <option @if($p==Str::upper($asn->pendidikan)) {{ "selected" }} @endif  value="{{ $p }}">{{ $p }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan')
                                <div class="invalid-feedback">
                                    {{ $message}}    
                                </div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="golongan">Golongan</label>
                                @php
                                    $gol = ['II A', 'II B', 'II C', 'II D','III A', 'III B', 'III C', 'III D','IV A', 'IV B', 'IV C', 'IV D', 'IV E'];
                                @endphp
                            <select required name="golongan" id="golongan" class="form-control  @error('golongan') is-invalid @enderror">
                                <option value=""></option>
                                @foreach($gol as $g)
                                    <option @if($g==$asn->golongan) {{ "selected" }} @endif  value="{{ $g }}">{{ $g }}</option>
                                @endforeach
                            </select>
                            @error('golongan')
                                <div class="invalid-feedback">
                                    {{ $message}}    
                                </div>
                            @enderror
                        </div>
                        <div class="col-3">
                            <label for="tugas">Klp. ASN</label>
                            <select required name="kelasn" id="kelasn" class="form-control">
                                <option @if($asn->kelasn=='NON GURU') {{ "selected" }} @endif  value="NON GURU">NON GURU</option>
                                <option @if($asn->kelasn=='GURU') {{ "selected" }} @endif value="GURU">GURU</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="tugas">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ $asn->email }}" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="tugas">OPD</label>
                            <select required class="form-control @error('opd_id') is-invalid @enderror" name="opd_id" id="opd_id" >
                                @foreach($opd as $opd)
                                    <option @if($asn->opd_id==$opd->id) {{ "selected" }} @endif value="{{ $opd->id }}">{{ $opd->nama }}</option>
                                @endforeach
                            </select>
                            @error('opd_id')
                                <div class="invalid-feedback">
                                    {{ $message}}    
                                </div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="tugas">Klp. Jabatan</label>
                            <select required class="form-control @error('keljab_id') is-invalid @enderror" name="keljab_id" id="keljab_id">
                                @foreach($keljab as $keljab)
                                    <option @if($asn->keljab_id==$keljab->id) {{ "selected" }} @endif value="{{ $keljab->id }}">{{ $keljab->nama }}</option>
                                @endforeach
                            </select>
                            @error('keljab_id')
                                <div class="invalid-feedback">
                                    {{ $message}}    
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="tugas">UPT</label>
                            <select class="form-control" name="upt_id" id="upt_id">
                                @if($upt->count())
                                    <option value="">Pilih</option>
                                    @foreach($upt as $upt)
                                    <option @if($asn->upt_id==$upt->id) {{ "selected" }} @endif value="{{ $upt->id }}">{{ $upt->nama }}</option>
                                    @endforeach
                                    <option value="0">Bukan UPT</option>
                                @else
                                    <option value="">Tidak ada UPT</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>
                    <button class="btn btn-pink mt-2" type="submit">Simpan Perubahan</button>
                    
                </form>
            </div>
        </div>
    </div>

<script>

    
</script>

@endsection