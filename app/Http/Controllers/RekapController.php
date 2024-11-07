<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Opd;
use App\Models\Rencana;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request){
        if(isset($request->tahun))
            $tahun = $request->tahun;
        else
            $tahun = date('Y');
        return view('admin.rekap', [
            'title' => 'Rekap Pengembangan Kompetensi ASN',
            'opd' => Opd::all(),
            'tahun' => $tahun
        ]);
    }

    public function view(Request $request){
        $id = $request->id;
        $opd = Opd::where('id', $id)->first();
        $tahun = $request->tahun;
        $data = Asn:: where('opd_id', $id)->where('sts',1)->get();
        if($request->v=='rencana'){
            // $data = Asn::where('opd_id', $id)->join('rencanas', 'rencanas.asn_id', '=', 'asns.id')
            //     ->where('tahun', $tahun)->distinct()->get(['rencanas.asn_id','nama','nip']);
            $view = 'RENCANA KOMPETENSI ASN (OPD/UPT)';
        }elseif($request->v=='laporan'){
            $view = 'ASN MELAKUKAN PELAPORAN (OPD/UPT)';
        }elseif($request->v=='jp'){
            $view = 'ASN MENCAPAI 20 JP (OPD/UPT)';
        }else{
            $view = 'ASN MELAKUKAN LOGIN (OPD/UPT)';
        }
        
        return view('admin.rekap_view', [
            'title' => 'View data', 
            'data' => $data,
            'opd' => $opd,
            'view' => $view,
            'v_id' => $request->v,
            'tahun' => $tahun,
        ]);
    }
}
