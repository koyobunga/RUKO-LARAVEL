@extends('layout.admin')
@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <div class="dropdown pr-2">
                                <a style="margin-top: -5px" class="dropdown-toggle btn btn-sm btn-outline-pink" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <b>Tahun {{ $tahun }}<i class=" icon-calender ml-2"></i></b>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    @for($i = 0; $i < 5; $i++)
                                      <button class="dropdown-item pr-2" type="button"> <a class="text-dark" href="{{ url('admin?tahun='.$i+date('Y')) }}" >{{ $i+date('Y') }} </a></button>
                                    @endfor
                                </div>
                              </div>
                        </li>
                        {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Starter</li> --}}
                    </ol>
                </div>
                <h6 class="">Dashboard</h6>
            </div>
        </div>
    </div>     
    <!-- end page title --> 

    <div class="row">
        <div class="col-xl-3">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-warning widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">JP</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Capaian JP {{ $tahun }}</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $jp_th }}</span></h3>
                        <p class="m-0 text-warning">Dari <b>{{ number_format($jumlah_asn*20,0,',','.') }}</b> JP</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-info widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">R</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Rencana ASN ({{ $tahun }})</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ number_format($asn_rencana/$jumlah_asn*100, 1 ) }} </span> %</h3>
                        <p class="m-0 text-blue">ASN <b>{{ $asn_rencana.'/'.$jumlah_asn }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-3">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">JP</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Capaian Seluru JP</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ $jp_all }}</span></h3>
                        <p class="m-0 text-primary">Semua</p>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-xl-3">
            <div class="card-box widget-box-two  widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-success widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold"><i class="icon-chart"></i></div>
                    </div>  
                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Realisasi Rencana {{ $tahun }}</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ number_format($persen_rencana,1) }} </span> %</h3>
                        <p class="m-0 text-success">Total Rencana <b>{{ $realisasi.'/'.$tot_rencana }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card-box widget-box-two widget-two-custom">
                <div class="media">
                    <div class="avatar-lg rounded-circle bg-purple widget-two-icon align-self-center">
                        <div class="avatar-title font-20 font-weight-bold">JP 20</div>
                    </div>

                    <div class="wigdet-two-content media-body">
                        <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">ASN Capai 20 JP ({{ $tahun }})</p>
                        <h3 class="font-weight-medium my-2"><span data-plugin="counterup">{{ number_format($jp20/$jumlah_asn*100,1) }} </span> %</h3>
                        <p class="m-0 text-purple">ASN <b>{{ $jp20.'/'.$jumlah_asn }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <div class="row">
        <div class="col-lg-6">
            <div class="card-box">
                <div class="header-title mb-4">Pemenuhan 20 JP 5 Tahan Terakhir</div>
                
                <div><canvas class="w-100 " id="myChartJP"></canvas></div>
                
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box">
                <div class="header-title mb-4">Realisasi Rencana Kompetensi 5 Tahan Terakhir</div>
                
                <div><canvas class="w-100" id="myChartRealisasi"></canvas></div>
                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="header-title mb-3">DIKLAT PALING BANYAK DIRENCANAKAN ASN TAHUN {{ $tahun }}</div>
                <table class="table table-hover text-wrap" id="datatable-buttons">
                    <thead>
                        <tr>
                            <th style="width: 10px">No.</th>
                            <th>Nama Diklat</th>
                            <th>Jumlah Rencana</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($grouprencana->groupby('diklat_id')->sortDesc() as $rate)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rate[0]->nama }}</td>
                                <td class="font-weight-bold">{{ $rate->count() }}</td>
                                <td>
                                    <a target="_blank" href="{{ url('admin/list/'.$rate[0]->diklat_id.'?tahun='.$tahun) }}" class="btn btn-sm btn-outline-primary" ><i class="mdi mdi-format-list-numbered"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    


<script>

    const dataset_jp = {!! json_encode($dataset_jp) !!};
    const dataset_r = {!! json_encode($dataset_r) !!};
    
    $(document).ready(function () {
        
        $('#menufull').trigger('click');
    });

    const ctx = document.getElementById('myChartJP');

    new Chart(ctx, {
        type: 'bar',
        data: {
        labels: dataset_jp.map(row => row.tahun),
        datasets: [{
            label: 'Capaian (%)',
            data: dataset_jp.map(row => row.count),
            backgroundColor: [
            'rgba(255, 159, 64, 0.7)',
            'rgba(255, 70, 120, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(153, 90, 255, 0.7)',
            ],
        }]
        },
        options: {
        scales: {
            y: {    
            beginAtZero: true
            }
        }
        }
    });

    const ctrealisasi = document.getElementById('myChartRealisasi');

    new Chart(ctrealisasi, {
        type: 'line',
        data: {
        labels: dataset_r.map(row => row.tahun),
        datasets: [{
            label: 'Realisasi (%)',
            data: dataset_r.map(row => row.count),
            backgroundColor: [
            'rgba(155, 69, 64)',
            'rgba(55, 70, 120)',
            'rgba(175, 192, 192)',
            'rgba(154, 162, 235)',
            'rgba(153, 90, 5)',
            ],
            borderWidth: 1
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });
</script>



@endsection