<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreJadwalRequest;
use App\Http\Requests\UpdateJadwalRequest;
use PDF;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::wheredate('tgl_mulai', '>', today())->orderby('id','desc')->get();
        return view('asn.jadwal',[
            'title' => 'Jadwal Diklat',
            'asn' => Asn::find(Auth::user()->asn_id),
            'jadwal' => $jadwal,
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
    public function store(StoreJadwalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {   
        $data = Jadwal::wheredate('tgl_mulai', '>', today())->where('diklat_id',$jadwal->diklat_id)->get();
        return view('asn.jadwal',[
            'title' => 'Jadwal Diklat',
            'asn' => Asn::find(Auth::user()->asn_id),
            'jadwal' => $data,
            'diklat' => $jadwal
        ]);

        // $pdf = PDF::loadview('asn.pdf',[
        //         'title' => 'Jadwal Diklat',
        //         'asn' => Asn::find(Auth::user()->asn_id),
        //         'jadwal' => $data,
        //         'diklat' => $jadwal
        // ]);
        // return $pdf->download('pdf.pdf');

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
