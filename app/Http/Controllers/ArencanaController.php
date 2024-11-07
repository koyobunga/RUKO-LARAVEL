<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Pelaksanaan;
use App\Models\Rencana;
use Illuminate\Http\Request;

class ArencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        if($request->search){
            $asn = Asn::where('nama','like','%'.$search.'%')->paginate(10)->withQueryString();
        }else{
            $asn = Asn::paginate(10)->withQueryString();
        }
        
        return view('admin.rencana',[
            'title' => 'Perancanaan ASN',
            'asn' => $asn,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        
        return view('admin.rencana_show',[
            'title' => 'Rencana Kompetensi',
            'asn' => $asn,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rencana $rencana)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rencana $rencana)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rencana $rencana)
    {
        $cek = Pelaksanaan::where('rencana_id', $rencana->id)->get();
        if($cek->count())
            return back()->with('warning', 'Tidak dapat menghapus. Data ini terkait dengan laporan pelaksanaan.');
        Rencana::destroy($rencana->id);
            return back()->with('error', 'Data telah dihapus.');
        return back()->with('error', 'Gagal menghapus data.');
        
    }
}
