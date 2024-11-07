<!DOCTYPE html>
<html>
<head>
  <title>{{ $title }}</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <div class="container p-5 m-5" style="font-size: 16px">
        <div class="row">
            <div class="col-lg-1 pt-2">
                <img src="{{ url('img/icon/logo-mini.png') }}" style="width: 70px">
            </div>
            <div class="col-lg-11 text-center">
                <div class="h4">PEMERINTAH PROVINSI GORONTALO</div>
                <div class="h3">BADAN PENGEMBANGAN SUMBER DAYA MANUSIA</div>
                <div style="font-size: 15px">
                    Jln. HB. Jassin Desa Moutong Kec. Tilong Kabila Kabupaten Bone Bolango,Telp/Fax: 0435-8539438
                </div>
            </div>
        </div>
        <hr class="mb-4" style="border-bottom: 3px double #666">

        <div class="h5 mb-5 text-center mt-5"><u>SURAT REKOMENDASI</u></div>

        <div class="mt-5 mb-3">Pengajuan pengajuan pengembangan kompetensi Pegawai Negeri Sipil:</div>
        <table style="line-height: 180%; width: 100%">
            <tr>
                <td style="width: 170px">Nama</td>
                <td>: {{ $rekom->asn->nama }}</td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>: {{ $rekom->asn->nip }}</td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>: {{ $rekom->asn->pendidikan }}</td>
            </tr>
            <tr>
                <td>Golongan</td>
                <td>: {{ $rekom->asn->golongan }}</td>
            </tr>
        </table>
        <div class="mt-4 mb-3">Jenis pengembangan kompetensi:</div>
        <table style="line-height: 180%; width: 100%">
            <tr style="text-transform: capitalize">
                <td style="width: 170px">Bentuk</td>
                <td>: {{ $rekom->bentuk }}</td>
            </tr>
            <tr style="text-transform: capitalize">
                <td>Jalur</td>
                <td>: {{ $rekom->jalur }}</td>
            </tr>
            <tr style="text-transform: capitalize">
                <td>Jenis</td>
                <td>: {{ $rekom->jenis }}</td>
            </tr>
            <tr style="text-transform: capitalize">
                <td>Nama Kompetensi</td>
                <td>: {{ $rekom->diklat->nama }}</td>
            </tr>
            <tr style="text-transform: capitalize">
                <td>Tempat</td>
                <td>: {{ $rekom->tempat }}</td>
            </tr>
            <tr>
                <td>Tanggal Pelaksanaan</td>
                <td>: {{ $rekom->tgl_mulai.' s.d '.$rekom->tgl_selesai }}</td>
            </tr>
        </table>
        @php
            if($rekom->rencana_id==0)
                $ket = 'tidak sesuai';
            else
                $ket = 'sesuai';
        @endphp
        <div class="mt-4 mb-3">Telah dikonfirmasi, <b>disetujui</b> oleh Badan Pengembangan Sumber Daya Manusia dan <b>{{ $ket }}</b>
            dengan perencanaan pengembangan kompetensi berdasarkan pengisian AKD.</div>

        <table style="width: 100%; margin-top: 60px">
            <tr>
                <td style="width: 600px">&nbsp;</td>
                <td style="line-height: 110%">
                    <div>Ditandatangani Oleh</div>
                    <div style="margin-bottom: 80px">Kepala Badan Pengembangan Sumber Daya Manusia</div>
                    <div style="font-weight: bold;"><u>{{ $kaban->nama }}</u></div>
                    <div>Nip. {{ $kaban->nip }}</div>
                    <div>{{ $kaban->pangkat }}</div>
                </td>
            </tr>
        </table>
    </div>

<script>
    window.print()
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>