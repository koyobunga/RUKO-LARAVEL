<?php

namespace App\Http\Controllers;

use App\Models\Akd;
use App\Models\Asn;
use App\Models\Opd;
use App\Models\Upt;
use App\Models\User;
use App\Models\Belum;
use App\Models\Sudah;
use App\Models\Diklat;
use App\Models\Jadwal;
use App\Models\Keljab;
use App\Models\Rencana;
use App\Models\Pelaksanaan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\AnsiColorMode;

class MasnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('mobile.main',[
            'asn' => Asn::find(Auth::user()->asn_id)
        ]);
    }

    public function dashboard(Request $request)
    {
        $asn = Asn::find(Auth::user()->asn_id);
        
        $cekpass = [
            'id' => Auth::user()->id,
            'password' => $asn->nip,
        ];
        $alert = 0;
        if(Auth::attempt($cekpass))
            $alert = 1;
        
        
        if($asn->keljab_id == NULL){
            return redirect('/asn/profile');
        }if($asn->opd_id == NULL){
            return redirect('/asn/profile');
        }

        if($request->tahun){
            $tahun = $request->tahun;
        }else{
            $tahun = date('Y');
        }
        $rencana = Rencana::where('asn_id', Auth::user()->asn_id)->where('tahun', $tahun)->get();
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
        

        $pelaksanaan = Pelaksanaan::where('asn_id', Auth::user()->asn_id)->get();
        $jp_th = Pelaksanaan::where('asn_id', Auth::user()->asn_id)->whereyear('tgl_mulai', $tahun)->get()->sum('jp');


        $get_akd = Akd::where('asn_id',$asn->id)->orderby('kategori_id','asc')->get();
        // $data_akd = Akd::selectRaw('sum(nilai) as nilai')->where('asn_id', $asn->id)
        //     ->join('kategoris', 'akds.kategori_id', '=', 'kategoris.id')
        //     ->groupby('kategori_id')->get();
        // dd($get_akd->groupby('kategori_id'));
        
        $akd = array();
        foreach ($get_akd->groupby('kategori_id') as $a) {
            if($a->count()>0){
                $h['label'] = $a[0]->kategori->nama;
                $h['count'] = $a->sum('nilai');
                $nilai = $a->sum('nilai');
                $nilai = $nilai*100/3;
                $h['nilai'] = 100-$nilai;
                if($nilai > 80) {
                $gap="0";
                }else if($nilai>60){
                $gap="1";
                }else if($nilai>40){
                $gap="2";
                }else if($nilai>20){
                $gap="3";
                }else{
                $gap="4";
                }
                $h['gap']=$gap;
                $h['keljab'] = $a[0]->keljab->nama;
                array_push($akd, $h);
            }
            
        }

        $jadwal = Jadwal::wheredate('tgl_mulai', '>', today())->orderby('id','desc')->get();

        $sudahpel = Pelaksanaan::where('asn_id', $asn->id)->get();
        $sudah = Sudah::where('asn_id', $asn->id)->get();
        $belum = Belum::where('asn_id', $asn->id)->get();
        $csudah = $sudah->count();
        $csudahpel = $sudahpel->count();
        $csudah +=$csudahpel;
        $cbelum = $belum->count();

        $pressudah = 0;
        $presbelum = 0;
        if($csudah>0){
            $pressudah = $csudah/($csudah+$cbelum)*100;
        }
        if($cbelum>0){
            $presbelum = $cbelum/($csudah+$cbelum)*100;
        }

        // $rencana_opd = Rencana::selectraw('count(*) as jumlah, asn_id')->where('tahun', $tahun)->groupby('asn_id')->orderby('jumlah', 'desc')->first();

        $asn_ren = Asn::join('rencanas', 'asns.id', '=', 'rencanas.asn_id')->where('rencanas.tahun', $tahun)->get();
        $per_rencana = array();
        foreach(Opd::all() as $op){
            $jumlah = $asn_ren->where('opd_id',$op->id)->count();
            $p['jumlah'] = $jumlah;
            $p['asn_merencanakan'] = $asn_ren->where('opd_id', $op->id)->groupby('asn_id')->count();
            $p['jumlah_asn'] = $op->jumlah_asn;
            $p['nm_opd'] = $op->nama;
            $persrencana = number_format(($jumlah/($op->jumlah_asn*2))*100,1);
            if($persrencana>100) $persrencana = 100;
            $p['persen'] = $persrencana;
            array_push($per_rencana, $p);
            
        }
        $per_opd = collect($per_rencana);
        

        $html = view('mobile.index',[
            'title' => 'Dashboard',
            'asn' => $asn,
            'jp_th' => $jp_th,
            'jp_all' => $pelaksanaan->sum('jp'),
            'rencana' => $rencana,
            'realisasi' => $realisasi_rencana,
            'tot_rencana' => $tot_rencana,
            'tahun' => $tahun,
            'persen_rencana' => $persen_rencana,
            'grouprencana' => $groprencana,
            'alert' => $alert,
            'akd' => $akd,
            'pressudah' => number_format($pressudah,1),
            'presbelum' => number_format($presbelum,1),
            'belumcount' => $cbelum,
            'sudahcount' => $csudah,
            'jadwal' => $jadwal,
            'per_opd' => $per_opd,
        ])->render();
        
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     */
    
     public function setting()
     {
        $asn = Asn::find(Auth::user()->asn_id);
        $html = view('mobile.setting',[
            'asn'=>$asn,
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
     }
    
    public function profile()
    {
        $asn = Asn::find(Auth::user()->asn_id);
        $html = view('mobile.profile', [
            'asn' => $asn,
            'opd' => Opd::all(),
            'keljab' => Keljab::all(),
            'upt' => Upt::where('opd_id', $asn->opd_id)->get(),
        ])->render();

        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }
    
    public function foto(){
        $html = view('mobile.foto',[
            'asn' => Asn::where('id', Auth::user()->asn_id)->first(),
            ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    public function upfoto(Request $request){
        $file = $request->validate([
            'foto' => 'required|file|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        $typefile = '.'.$request->foto->extension();
        $namefile = Auth::user()->asn_id.$typefile;

        // dd(storage_path());
        if($request->foto->move(public_path('img'), $namefile)){
            Asn::where('id',Auth::user()->asn_id)->update(['foto'=>'img/'.$namefile]);
            return response()->json(['msg'=>1]);
        }
        return response()->json(['msg'=>0]);
        
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asn $asn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asn $asn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $valedate = $request->validate([
            'nama' => 'required',
            'nip' => 'required',
            'opd_id' => 'required',
            'keljab_id' => 'required',
            'email' => '',
            'pendidikan' => 'required',
            'golongan' => 'required',
            'kelasn' => 'required',
        ]);
        if(!empty($request->upt_id)){
            $valedate['upt_id'] = $request->upt_id;
        }else{
            $valedate['upt_id'] = 0;
        }
        
        if(Asn::where('id', Auth::user()->asn_id)->update($valedate)){
            if(Auth::user()->username != $request->nip)
                User::where('id', Auth::user()->id)->update(['username' => $request->nip]);
            
            $asn = Auth::user()->asn;
            if($asn->opd_id != $request->opd_id){
                if($asn->opd_id != null){
                    $j_asal = $asn->opd->jumlah_asn - 1;
                    Opd::where('id', $asn->opd_id)->update(['jumlah_asn' => $j_asal]);
                }
                $opd_tujuan = Opd::where('id', $request->opd_id)->first();
                $j_tujuan = $opd_tujuan->jumlah_asn + 1;
                Opd::where('id', $opd_tujuan->id)->update(['jumlah_asn' => $j_tujuan]);
            }

            return response()->json(['msg'=>1]);

        }
        return response()->json(['msg'=>0]);
    }

    public function password(Request $request){
        $data = $request->validate([
            'password' => 'required'
        ]);

        if(User::where('id', Auth::user()->id)->update(['password'=>Hash::make($request->password)]))
            return response()->json(['msg'=>1]);
        return response()->json(['msg'=>0]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asn $asn)
    {
        //
    }
}
