<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Asn;
use App\Models\Rekom;
use App\Models\Diklat;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRekomRequest;
use App\Http\Requests\UpdateRekomRequest;
use App\Models\Jenis;
use App\Models\Kaban;
use App\Models\Rencana;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

use PDF;

use function PHPUnit\Framework\returnSelf;

class MrekomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $html = view('mobile.rekom',[
            'title' => 'Surat Rekomendasi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'rekom' => Rekom::where('asn_id', Auth::user()->asn_id)->orderby('created_at', 'desc')->get(),
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
        
        $jadwal = Jadwal::find($request->id);
        $thn = date('Y', strtotime($jadwal->tgl_mulai));
        
        $rencana = Rencana::where('diklat_id', $jadwal->diklat_id)->where('tahun', $thn)->where('asn_id', Auth::user()->asn_id)->get();
        
        
        $html =  view('mobile.rekom_create',[
            'title' => 'Menerbitkan Surat Rekomendasi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'rencana' => $rencana,
            'jadwal' => $jadwal,
            'diklat' => Diklat::all(),
            'jenis' => Jenis::all(),
        ])->render();
        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $asn = Asn::find(Auth::user()->asn_id);
            
            $create = $request->validate([
                'diklat_id' => 'required',
                'bentuk' => 'required',
                'jalur' => 'required',
                'jenis' => 'required',
                'tempat' => 'required',
                'pelaksana' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
            ]);
            
            $create['asn_id'] = $asn->id;
            $tahun = date('Y', strtotime($request->tgl_mulai));
            $rencana = Rencana::where('diklat_id', $request->diklat_id)->where('tahun', $tahun) 
                ->where('asn_id', $asn->id)->where('sts', 0)->first();
                // dd($rencana);
            if($rencana != null)
                $create['rencana_id'] = $rencana[0]->id;
           
            if(Rekom::create($create))
                return response()->json(['msg' => 1]); 
            return response()->json(['msg' => 0]);  
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekom $rekom)
    {
        // $pdf = PDF::loadview('asn.rekom_pdf', [
        //     'title' => 'Surat Rekomendasi',
        //     'data' => $rekom,
        // ]);
        // return $pdf->download('Rekomendasi '.$rekom->diklat->nama.'.pdf');
        // return $pdf->stream();
        return view('mobile.rekom_pdf',[
            'title' => 'Surat Rekomendasi',
            'rekom' => $rekom,
            'kaban' => Kaban::orderby('created_at', 'desc')->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekom $rekom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekomRequest $request, Rekom $rekom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekom $rekom)
    {
        if(Rekom::destroy($rekom->id))
            return response()->json(['msg'=>1]);
        return response()->json(['msg'=>0]);
        
    }
}
