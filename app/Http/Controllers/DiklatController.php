<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Http\Requests\StoreDiklatRequest;
use App\Http\Requests\UpdateDiklatRequest;
use App\Models\Kategoridiklat;
use App\Models\Pelaksanaan;
use App\Models\Rencana;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class DiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $diklat = Diklat::orderby('id','desc')->get();
        return view('admin.diklat',[
            'title'=>'Data Diklat',
            'diklat' => $diklat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.diklat_create',[
            'title' => 'Input Data Diklat',
            'diklat' => Diklat::all(),
            'kategoridiklat' => Kategoridiklat::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'=>'required',
            'kategoridiklat_id'=>'required',
        ]);
        if(Diklat::create($data))
            return redirect('admin/diklat')->with('success','Data telah disimpan..');
        return back()->with('error','Gagal menyimpan..');
    }

    /**
     * Display the specified resource.
     */
    public function show(Diklat $diklat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diklat $diklat)
    {
        return view('admin.diklat_edit',[
            'title' => 'Edit Diklat',
            'diklat' => $diklat,
            'kategoridiklat' => Kategoridiklat::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diklat $diklat)
    {
        $data = $request->validate([
            'nama'=>'required',
            'kategoridiklat_id'=>'required',
        ]);
        if(Diklat::where('id',$diklat->id)->update($data))
            return back()->with('warning','Perubahan telah disimpan..');
        return back()->with('error','Gagal menyimpan perubahan..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diklat $diklat)
    {
        $cek = Rencana::where('diklat_id', $diklat->id)->get();
        if($cek->count())
            return back()->with('error','Data tidak dapat dihapus..');
        $cek_pel = Pelaksanaan::where('diklat_id', $diklat->id)->get();
        if($cek_pel->count())
                return back()->with('error','Data tidak dapat dihapus..');
        if(Diklat::destroy($diklat->id))
            return back()->with('warning','Data telah dihapus..');
        return back()->with('error','Gagal menghapus data...');
    }
}
