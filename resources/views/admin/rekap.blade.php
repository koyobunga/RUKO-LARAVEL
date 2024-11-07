@php
    use App\Models\Asn;
    use App\Models\Rencana;
@endphp
@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <div class="dropdown show">
                                <a style="margin-top: -5px" class="btn btn-outline-blue" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Tahun {{ $tahun }}
                                </a>
                              
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  @for($i=-2; $i<3; $i++)
                                    <a class="dropdown-item" href="{{ url('admin/rekap?tahun='.$i+date('Y')) }}">{{ $i+date('Y') }}</a>
                                  @endfor
                                </div>
                              </div>
                        </li>
                    </ol>
                </div>
                <h5 class="">{{ $title }}</h5>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    @if($opd)
        <div class="card-box">
            <div class="header-title mb-3">DATA REKAP</div>
            <table class="table table-striped text-wrap" id="datatable-buttons">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>OPD</th>
                        <th>Jlh. ASN</th>
                        <th>Login</th>
                        <th>Rencana</th>
                        <th>Laporan</th>
                        <th>20 JP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opd as $o)
                        @php
                            $ren = Asn::where('opd_id', $o->id)->where('asns.sts', 1)->join('rencanas', 'asns.id', '=', 'rencanas.asn_id')->where('rencanas.tahun', $tahun)->get();
                            $pel = Asn::where('opd_id', $o->id)->where('asns.sts', 1)->join('pelaksanaans', 'asns.id', '=', 'pelaksanaans.asn_id')->where('pelaksanaans.tgl_mulai', 'like', '%'.$tahun.'%')->get();
                            $jumlah_asn = $o->jumlah_asn;
                            // $cek_inactiv = Asn::where('opd_id', $o->id)->where('sts', 0)->get();
                            // $jumlah_asn = $jumlah_asn - $cek_inactiv->count();
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $o->nama }}</td>
                            <td>{{ $jumlah_asn }}</td>
                            <td>
                                <a href="{{ url('admin/rekap/view?v=login&id='.$o->id.'&tahun='.$tahun) }}" class="btn btn-outline-primary btn-sm">
                                    {{ $o->asn->where('sts', 1)->count() }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('admin/rekap/view?v=rencana&id='.$o->id.'&tahun='.$tahun) }}" class="btn btn-outline-warning btn-sm">
                                {{ $ren->groupby('asn_id')->count() }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ url('admin/rekap/view?v=laporan&id='.$o->id.'&tahun='.$tahun) }}" class="btn btn-outline-success btn-sm">
                                {{ $pel->groupby('asn_id')->count() }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $jp = 0;
                                @endphp
                                @foreach($pel->groupby('asn_id') as $p)
                                    @if($p->sum('jp')>19)
                                        @php
                                            $jp++;
                                        @endphp
                                    @endif
                                @endforeach
                                <a href="{{ url('admin/rekap/view?v=jp&id='.$o->id.'&tahun='.$tahun) }}" class="btn btn-outline-pink btn-sm">
                                {{ $jp }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

<script>

    
</script>

@endsection