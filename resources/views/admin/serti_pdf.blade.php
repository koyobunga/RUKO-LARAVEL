<!DOCTYPE html>
<html>
<head>
  <title>{{ $title }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<style>
html { margin: 0px}
</style>
<body style="padding: 0px; background: url({{ $bg }}) no-repeat center fixed;">
    <div style="padding: 110px 110px 10px 110px; text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
        

        <div class="text-center" style="font-size: 29px; margin-top: 45px">S E R T I F I K A T</div>
		<div style="margin-top:11px; font-size:15px;">NOMOR: {{ $list->nomor }}</div>
		<div style="margin-top:30px; font-size:18px; ">DIBERIKAN KEPADA</div>
        <div style="margin-top:20px; font-size:18px;"><b>{{ $list->nama }}</b></div>

        <div style="border-bottom: double 1px #aaa; margin-top: -7px">&nbsp;</div>
        <div style="margin-top:25px; text-transform: uppercase; font-size:18px; text-align: center;">{{ $serti->label_bentuk }}:</div>
        <div style="margin-top:25px; height: 110px; font-size:17px; text-align: center; line-height: 150%;">

            @php
                $tgl_mulai = date('d F Y', strtotime($serti->tgl_mulai));
                $tgl_selesai = date('d F Y', strtotime($serti->tgl_mulai));
                
                // $bulan = getBulan(date('m', strtotime($tgl_mulai)));
                // $bulan_s = getBulan(date('m', strtotime($tgl_selesai)));
                // // $tgl_mulai = date('d', strtotime($tgl_mulai)).' '.$bulan.' '.date('Y', strtotime($tgl_mulai));
                // // $tgl_selesai = date('d', strtotime($tgl_selesai)).' '.$bulan_s.' '.date('Y', strtotime($tgl_selesai));
                if($tgl_mulai != $tgl_selesai){
                    $tanggal = $tgl_mulai ." s/d ".$tgl_selesai;
                }else{
                    $tanggal = $tgl_mulai;
                }
            @endphp

            {{ $serti->label_diklat }}, Tanggal {{ $tanggal }}, Selama {{ $serti->jp }} JP (Jam Pelajaran).
        </div>
            
            <table style="margin-top:25px; font-size: 15px;  " cellpadding="1" cellspacing="1">
                <tr>
                    <td style="width: 510px; height: 30px;">&nbsp;</td>
                    <td style="padding-top: 1px; padding-right: 5px">
                        <img src="data:image/png;base64,{{ $qrcode }}" alt="" width="90">
                    </td>
                    <td style="width: 290px; height: 160px;">
                        <b>Ditandatangani secara elektronik oleh</b>
                        <div style="font-weight: bold; margin-top:3px; text-transform: uppercase; line-height: 130%">{{ $serti->ttd_oleh }}</div>
                        <div style="text-transform: uppercase; margin-top: 25px; margin-bottom: -2px"><u><b>{{ $serti->ttd_nama }}</b></u></div>
                        <div style="margin-bottom: -2px">{{ $serti->ttd_pangkat }}</div>
                        <div>NIP. {{ $serti->ttd_nip }}</div>
                    </td>
                </tr>
            </table>
    
        
        
        
    </div>


</body>
</html>