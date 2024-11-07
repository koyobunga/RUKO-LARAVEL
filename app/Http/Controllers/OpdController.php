<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use App\Http\Requests\StoreOpdRequest;
use App\Http\Requests\UpdateOpdRequest;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

use function PHPUnit\Framework\returnSelf;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.opd', [
            'title' => 'Data Jadwal Diklat',
            'opd' => Opd::orderby('nama', 'asc')->get(),
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
    public function store(StoreOpdRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Opd $opd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opd $opd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opd $opd)
    {
        $data = $request->validate([
            'nama' => 'required',
            'jumlah_asn' => 'required|integer',
        ]);
        if(Opd::where('id', $opd->id)->update($data))
            return back()->with('success','Data disimpan..');
        return back()->with('error','Gagal menyimpan...');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opd $opd)
    {
        //
    }
}
