@extends('layout.asn')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <div class="dropdown pr-2">
                                <a class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Tahun {{ $tahun }}<i class=" icon-calender ml-2"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @for($i = 0; $i < 5; $i++)
                                      <button class="dropdown-item pr-2" type="button"> <a class="text-dark" href="{{ url('asn?tahun='.$i+date('Y')) }}" >{{ $i+date('Y') }} </a></button>
                                    @endfor
                                </div>
                              </div>
                        </li>
                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h6 class="">{{ $asn->opd->nama }}</h6>
            </div>
        </div>
    </div>     
    <!-- end page title --> 
    
    @if($alert==1)
    <div class="alert alert-warning alert-dismissible p-3  fade show" role="alert">
        <strong class="mr-3">Perhatian!</strong> Mohon mengganti password untuk keamanan data Anda. 
        <button data-toggle="modal" data-target="#modal-password" class="btn btn-outline-pink btn-sm ml-2">Ganti sekrang</button>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-xl-4">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-pink widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">JP</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Capaian JP Tahunan</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $jp_th }}</span></h3>
                        <p class="m-0 text-pink">{{ $tahun }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-warning widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">JP</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Seluruh Capaian JP</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $jp_all }}</span></h3>
                        <p class="m-0 text-pink">Semua</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card-box widget-box-two  widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-success widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold"><i class="icon-chart"></i></div>
                    </div>  
                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Realsasi Rencana {{ $tahun }}</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ number_format($persen_rencana,0) }} </span> %</h3>
                        <p class="m-0 text-success">Total Rencana {{ $realisasi.'/'.$tot_rencana }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 pb-3">
            <div class="card-box text-center h-100">
                <div class="header-title">Analisi Kebutuhan Diklat (AKD)</div>
                <canvas id="akd"></canvas>
            </div>
        </div>
        <div class="col-md-4 pb-3">
                <div class="card-box widget-box-two widget-two-custom">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                            <div class="avatar-title font-20 font-weight-bold">
                                <i class="icon-badge"></i>
                            </div>
                        </div>
    
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Pelaksanaan Diklat</p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $pressudah }}</span> %</h3>
                            <a class="text-primary" href="{{ url('asn/belum') }}"><p class="m-0 mt-3">Diklat telah dilaksanakan</p></a>
                            <div><b>{{ $sudahcount }}</b> Diklat</div>
                        </div>  
                    </div>
                    
                </div>

                <div class="card-box widget-box-two widget-two-custom">
                    <div class="media">
                        <div class="avatar-lg rounded-circle bg-purple widget-two-icon align-self-center">
                            <div class="avatar-title font-20 font-weight-bold">
                                <i class="icon-pie-chart"></i>
                            </div>
                        </div>
    
                        <div class="wigdet-two-content media-body">
                            <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Kebutuhan Diklat </p>
                            <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $presbelum }}</span> %</h3>
                            <a class="text-purple" href="{{ url('asn/belum') }}"><p class="m-0 mt-3">Diklat akan dilaksanakan</p></a>
                            <div><b>{{ $belumcount }}</b> Diklat</div>
                        </div>  
                    </div>
                    
                </div>
               
        </div>
    </div>

    <div class="card-box">
        <div class="header-title mb-3">DIKLAT PALING BANYAK DIRENCANAKAN ASN TAHUN {{ $tahun }}</div>
        <table class="table table-hover text-wrap" id="datatable-buttons">
            <thead>
                <tr>
                    <th style="width: 10px">No.</th>
                    <th>Diklat</th>
                    <th>Jumlah Rencana</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grouprencana->groupby('diklat_id')->sortDesc() as $rate)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rate[0]->nama }}</td>
                        <td>{{ $rate->count() }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <script>
    const akd = {!! json_encode($akd) !!};

   

    new Chart(
        document.getElementById('akd'),
        {
        type: 'bar',
        data: {
            labels: akd.map(row => row.label),
            datasets: [
            {
                label: 'GAP Kompetensi'    ,
                data: akd.map(row => row.gap),
                backgroundColor: [
                    'rgb(255, 99, 132, 0.5)',
                    'rgb(75, 192, 192, 0.5)',
                    'rgb(255, 205, 86, 0.5)',
                    'rgb(201, 203, 207, 0.5)',
                    'rgb(54, 162, 0, 0.5)',
                    'rgb(75, 80, 182, 0.5)',
                    'rgb(255, 60, 56, 0.5)',
                    'rgb(201, 110, 107, 0.5)',
                    'rgb(54, 90, 95, 0.5)',
                ],
            }
            ]
        }
        }
    );
    </script>

@endsection