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

class RekomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('asn.rekom',[
            'title' => 'Surat Rekomendasi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'rekom' => Rekom::where('asn_id', Auth::user()->asn_id)->orderby('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
        
        $jadwal = Jadwal::find($request->id);
        $thn = date('Y', strtotime($jadwal->tgl_mulai));
        
        $rencana = Rencana::where('diklat_id', $jadwal->diklat_id)->where('tahun', $thn)->where('asn_id', Auth::user()->asn_id)->get();
        
        
        return view('asn.rekom_create',[
            'title' => 'Menerbitkan Surat Rekomendasi',
            'asn' => Asn::find(Auth::user()->asn_id),
            'rencana' => $rencana,
            'jadwal' => $jadwal,
            'diklat' => Diklat::all(),
            'jenis' => Jenis::all(),
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->rencana_id)){
            $rencana = Rencana::find($request->rencana_id);

            $cek = Rekom::where('asn_id', Auth::user()->asn_id)->where('diklat_id', $rencana->diklat_id)->where('rencana_id', $rencana->id)->get();
            if($cek->count()){
                return back()->with('warning', 'Rekomendasi ini telah diterbitkan sebelumnya..'); 
            }

            $jadwal = Jadwal::find($request->jadwal_id);
            $create = [
                'asn_id' => Auth::user()->asn_id,
                'rencana_id' => $rencana->id,
                'diklat_id' => $rencana->diklat_id,
                'bentuk' => $rencana->bentuk,
                'jalur' => $rencana->jalur,
                'jenis' => $jadwal->jenis,
                'tempat' => $jadwal->tempat,
                'pelaksana' => $jadwal->pelaksana,
                'tgl_mulai' => $jadwal->tgl_mulai,
                'tgl_selesai' => $jadwal->tgl_selesai,
            ];
            
           
            if(Rekom::create($create))
                return redirect('asn/rekom')->with('success', 'Berhasil menerbitkan Surat Rekomendasi'); 
            return back()->with('error', 'Gagak menerbitkan Surat Rekomendasi'); 
        }else{
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
            $create['asn_id'] = Auth::user()->asn_id;
            if(Rekom::create($create))
                return redirect('asn/rekom')->with('success', 'Berhasil menerbitkan Surat Rekomendasi'); 
            return back()->with('error', 'Gagak menerbitkan Surat Rekomendasi'); 
        }
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
        return view('asn.rekom_pdf',[
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
        //
    }
}
