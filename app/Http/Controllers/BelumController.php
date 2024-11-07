<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Belum;
use App\Models\Diklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBelumRequest;
use App\Http\Requests\UpdateBelumRequest;

class BelumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asn = Asn::find(Auth::user()->asn_id);
        $diklat = Diklat::all();
        return view('asn.belum',[
            'title' => 'Kompetensi Dibutuhkan',
            'asn' => $asn,
            'diklat' => $diklat
        ]);
    }

    public function add(Request $request)
    {
        if(Belum::where('diklat_id', $request->id)->where('asn_id', Auth::user()->asn_id)->first()){
            return response()->json(['message' => 4]);
        }
        $data = [
            'asn_id' => Auth::user()->asn_id,
            'diklat_id' => $request->id,
        ];
        if(Belum::create($data)){
            return response()->json(['message' => 1]);
        }
        return response()->json(['message' => 0]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getdata(Request $request)
    {
     
        $data = Belum::where('asn_id', Auth::user()->asn_id)->orderby('id','desc')->get();

        return response()->json($data);
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
    public function store(StoreBelumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Belum $belum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Belum $belum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBelumRequest $request, Belum $belum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(Belum::destroy($request->id))
            return response()->json(['message' => 1]);
        return response()->json(['message' => 0]);
    }
}
