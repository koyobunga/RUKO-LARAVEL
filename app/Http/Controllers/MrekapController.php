<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Rencana;
use App\Models\Pelaksanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class MrekapController extends Controller
{
    public function index(Request $request){
        if(isset($request->tahun))
            $tahun = $request->tahun;
        else
            $tahun = date('Y');

        $asn = Asn::find(Auth::user()->asn_id)->first();
        $rencana = Rencana::selectraw('count(*) as jumlah, asn_id')->join('asns', 'rencanas.asn_id', '=', 'asns.id')->where('rencanas.tahun', $tahun)
        ->where('asns.opd_id', $asn->opd_id)->groupby('rencanas.asn_id')->orderby('jumlah', 'desc')->get();
        
        $pelaksanaan = Pelaksanaan::selectraw('sum(jp) as jp, asn_id')->join('asns', 'pelaksanaans.asn_id', '=', 'asns.id')->whereyear('pelaksanaans.tgl_mulai', $tahun)
            ->where('asns.opd_id', $asn->opd_id)->groupby('pelaksanaans.asn_id')
            ->orderby('jp', 'desc')->get();
        
        $jp20 = Pelaksanaan::selectraw('sum(jp) as jp, asn_id')->join('asns', 'pelaksanaans.asn_id', '=', 'asns.id')->whereyear('pelaksanaans.tgl_mulai', $tahun)
            ->where('asns.opd_id', $asn->opd_id)->groupby('pelaksanaans.asn_id')->having('jp', '>', 19)
            ->orderby('jp', 'desc')->get();

        $asn_all = Asn::where('opd_id', $asn->opd_id)->get();
        $rencana_belum = array();
        foreach ($asn_all as $a) {
            $cek = Rencana::where('tahun', $tahun)->where('asn_id', $a->id)->get();
            if($cek->count()==0){
                $h['id'] = $a->id;
                $h['nip'] = $a->nip;
                $h['nama'] = $a->nama;
                array_push($rencana_belum, $h);
            }
        }
        $rencana_belum = collect($rencana_belum);
        $laporan_belum = array();
        foreach ($asn_all as $a) {
            $cek = Pelaksanaan::whereyear('tgl_mulai', $tahun)->where('asn_id', $a->id)->get();
            if($cek->count()==0){
                $h['id'] = $a->id;
                $h['nip'] = $a->nip;
                $h['nama'] = $a->nama;
                array_push($laporan_belum, $h);
            }
        }
        $laporan_belum = collect($laporan_belum);
        

        
        $html = view('mobile.rekap',[
            'asn' => $asn,
            'rencana' => $rencana,
            'jp20' => $jp20,
            'laporan' => $pelaksanaan,
            'rencana_belum' => $rencana_belum,
            'laporan_belum' => $laporan_belum,
            'tahun' => $tahun
        ])->render();

        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }
}
