<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Asn;
use App\Models\Diklat;
use App\Models\Opd;
use App\Models\Rencana;
use App\Models\Pelaksanaan;
use Illuminate\Database\Schema\Grammars\RenameColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request){
        if($request->tahun){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }

        $opd = Opd::all();
        $rencana = Rencana::where('tahun', $tahun)->get();

        // dd($rencana->count());
        if($rencana->count()>0){
            $realisasi_rencana = $rencana->where('sts','2')->count();
            $tot_rencana = $rencana->count();
            $persen_rencana = $realisasi_rencana/$tot_rencana*100;
        }else{
            $realisasi_rencana = 0;
            $tot_rencana = 0;
            $persen_rencana = 0;
        }
    

        $groprencana = Diklat::join('rencanas', 'diklats.id', '=', 'rencanas.diklat_id')->where('rencanas.tahun', $tahun)->get();

        // dd($groprencana->rencana);

        // $pelaksanaan = Pelaksanaan::all();
        $pel_tahun = Pelaksanaan::whereyear('tgl_mulai', $tahun)->get();

        

        $jp20=0;
        foreach ($pel_tahun->groupby('asn_id') as $p) {
            if($p->sum('jp')>19)
            $jp20++;
        }

        $jumlah_asn =$opd->sum('jumlah_asn');

        // Chart JP
        $label = array();
        for ($i=-4; $i < 1; $i++) { 
            $label[] = date('Y') + $i;
        }

        $dataset_jp = array();
        $dataset_r = array();
        foreach ($label as $l) {
            $hit_jp = Pelaksanaan::selectraw('sum(jp) as sum_jp')->whereyear('tgl_mulai', $l)
                ->groupby('asn_id')->having('sum_jp', '>', 19)->get();
            $j['tahun'] = $l;
            $j['count'] = number_format($hit_jp->count()/$jumlah_asn*100,1);
            array_push($dataset_jp, $j);

            $hit_r = Rencana::where('sts', 2)->where('tahun', $l)->get();
            $ren_tahun = Rencana::where('tahun', $l)->get();
            if($ren_tahun->count()==0)
                $r['count'] = 0;
            else    
                $r['count'] = number_format($hit_r->count()/$ren_tahun->count()*100,1);
            
            $r['tahun'] = $l;
            array_push($dataset_r, $r);

        }
        

        return view('admin.index',[
            'title' => 'Dashboard',
            'jp_th' => $pel_tahun->sum('jp'),
            // 'jp_all' => $pelaksanaan->sum('jp'),
            'rencana' => $rencana,
            'realisasi' => $realisasi_rencana,
            'tot_rencana' => $tot_rencana,
            'tahun' => $tahun,
            'persen_rencana' => $persen_rencana,
            'grouprencana' => $groprencana,
            'jp20' => $jp20,
            'jumlah_asn' => $jumlah_asn,
            'dataset_jp' => $dataset_jp,
            'dataset_r' => $dataset_r,
            'asn_rencana' => $rencana->groupby('asn_id')->count()
        ]);
    }


    public function list(Diklat $diklat, Request $request){
        $tahun = $request->tahun;
        $data = Rencana::where('tahun', $tahun)->where('diklat_id', $diklat->id)->join('asns', 'asns.id', '=', 'rencanas.asn_id')
            ->distinct()->get('rencanas.asn_id','nama','nip');
        return view('admin.index_list', [
            'title' => 'ASN Merencanakan Diklat',
            'diklat' => $diklat,
            'data' => $data,
            'tahun' => $tahun,
        ]);
    }

    public function logout(){
        Auth::logout();
        return redirect("/")->with('error', 'Log out..');
    }
}
