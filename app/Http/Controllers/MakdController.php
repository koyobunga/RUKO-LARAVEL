<?php

namespace App\Http\Controllers;

use App\Models\Akd;
use App\Models\Asn;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreAkdRequest;
use App\Http\Requests\UpdateAkdRequest;
use App\Models\Isian;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MakdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $asn = Asn::find(Auth::user()->asn_id);
        if($asn->keljab_id == NULL){
            return redirect('mobile/profile');
        }if($asn->opd_id == NULL){
            return redirect('mobile/profile');
        }

        $html = view('mobile.akd',[
            'title' => 'Analisis Kebutuhan Diklat',
            'asn' => $asn,
            'kategori' => Kategori::all(),
            'isian' => Isian::where('keljab_id', $asn->keljab_id)->get(),
            'akd' => Akd::where('asn_id', $asn->id)->get(),
        ])->render();

        return response()->json(['html'=>$html])->header('Content-Type', 'application/json');
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
        $asn_id = $request->asn_id;
        $keljab_id = $request->keljab_id;
        $isian_id = $request->isian_id;
        $nilai = $request->nilai;
        $isian = Isian::where('id', $request->isian_id)->first();
        $kategori_id = $isian->kategori_id;

        $cek = Akd::where('asn_id', $asn_id)->where('keljab_id', $keljab_id)->where('kategori_id', $kategori_id)
            ->where('isian_id', $isian_id)->first();
        if($cek != NULL){
            Akd::where('asn_id', $asn_id)->where('keljab_id', $keljab_id)->where('kategori_id', $kategori_id)
            ->where('isian_id', $isian_id)->update(['nilai' => $nilai]);
            return response()->json(['message'=>'Telah diubah..']);
        }else{
            Akd::create([
                'asn_id'=>$asn_id,
                'keljab_id'=>$keljab_id,
                'kategori_id'=>$kategori_id,
                'isian_id'=>$isian_id,
                'nilai'=>$nilai,
            ]);
            return response()->json(['message'=>'Telah ditambahkan..']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Akd $akd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Akd $akd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAkdRequest $request, Akd $akd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akd $akd)
    {
        //
    }
}
