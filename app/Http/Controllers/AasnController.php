<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\Opd;
use App\Models\Upt;
use App\Models\User;
use App\Models\Keljab;
use App\Models\Rencana;
use Mockery\Matcher\Any;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function PHPUnit\Framework\returnSelf;

class AasnController extends Controller
{
/**
 * Display a listing of the resource.
 */
public function index(Request $request)
{
    // dd($request->opd_id);   
    $asn = '';
    $opd = Opd::orderby('nama', 'asc')->get();
    $search = '';
    if(isset($request->opd_id)){
        $opd_id = $request->opd_id;
        if($request->opd_id == 'nonactif')
            $asn = Asn::where('sts', 0)->orderby('id','desc')->get();
        else
            $asn = Asn::where('opd_id', $opd_id)->orderby('id','desc')->get();

    }

    if(isset($request->search)){
        $search = $request->search;
        $asn = Asn::where('nama', 'like', '%'.$search.'%')->orWhere('nip', 'like', '%'.$search.'%')
            ->paginate(10)->withQueryString();
    }
    
    return view('admin.asn',[
        'title' => 'DATA ASN',
        'asn' => $asn,
        'opd'=> $opd,
        'search' => $search,
    ]);
}

public function hidupkan(Asn $asn)
{
    if(Asn::find($asn->id)->update(['sts'=>1])){
        $j = $asn->opd->jumlah_asn + 1;
        Opd::where('id', $asn->opd_id)->update(['jumlah_asn' => $j]);
        return back()->with('success','Status ASN telah diaktifkan');
    }
    return back()->with('error','Tidak dapat mengaktifkan akun ASN');
}

public function matikan(Asn $asn)
{
    if(Asn::find($asn->id)->update(['sts'=>0])){
        $j = $asn->opd->jumlah_asn - 1;
        Opd::where('id', $asn->opd_id)->update(['jumlah_asn' => $j]);
        return back()->with('warning','Status ASN telah Non aktif');
    }
    return back()->with('error','Tidak dapat merubah status ASN');
}

public function akunon(User $user)
{
    if(User::find($user->id)->update(['sts'=>1]))
        return back()->with('success','Akun telah dihidupkan');
    return back()->with('error','Tidak dapat menghidupkan akun');
}

public function akunoff(User $user)
{
    if(User::find($user->id)->update(['sts'=>0]))
        return back()->with('warning','Akun telah dimatikan');
    return back()->with('error','Tidak dapat mematikan akun');
}

public function pulihkanpassword(Asn $asn)
{
    $data = [
        'username' => $asn->nip,
        'password' => Hash::make($asn->nip)
    ];
    if(User::where('asn_id',$asn->id)->update($data))
        return back()->with('success','Password dipulihkan..');
    return back()->with('error','Gagal pulihkan password');
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
    $data = $request->validate([
        'nama' => 'required',
        'nip' => 'required|unique:asns',
        'opd_id' => 'required',
    ]);
    if(Asn::create($data))
        $d = Asn::where('nip', $request->nip)->first();
        User::create([
            'level'=> 'asn',
            'asn_id'=> $d->id,
            'username'=> $d->nip,
            'password'=> Hash::make($d->nip),
        ]);
        return back()->with('success','Data ASN telah ditambahkan..');
    return back()->with('error','Gagal menambah data ASN..');
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
    
    return view('admin.profile',[
        'title' => 'Edit ASN',
        'asn' => $asn,
        'opd' => Opd::all(),
        'keljab' => Keljab::all(),
        'upt' => Upt::where('opd_id', $asn->opd_id)->get(),
    ]);
}

/**
 * Update the specified resource in storage.
 */
public function update(Request $request, Asn $asn)
{
    $valedate = $request->validate([
        'nama' => 'required',
        'nip' => 'required',
        'opd_id' => 'required',
        'keljab_id' => 'required',
        'email' => '',
        'pendidikan' => '',
        'golongan' => 'required',
        'kelasn' => 'required',
    ]);
    if(!empty($request->upt_id)){
        $valedate['upt_id'] = $request->upt_id;
    }else{
        $valedate['upt_id'] = 0;
    }
    
    if(Asn::find($asn->id)->update($valedate)){
        if($asn->nip != $request->nip)
            User::where('asn_id', $asn->id)->update(['username' => $request->nip]);

        if($asn->opd_id != $request->opd_id){
            if($asn->opd_id != null){
                $j_asal = $asn->opd->jumlah_asn - 1;
                Opd::where('id', $asn->opd_id)->update(['jumlah_asn' => $j_asal]);
            }
            
            $opd_tujuan = Opd::where('id', $request->opd_id)->first();
            $j_tujuan = $opd_tujuan->jumlah_asn + 1;
            Opd::where('id', $opd_tujuan->id)->update(['jumlah_asn' => $j_tujuan]);
        }

        return back()->with('success','Perubahan telah disimpan..');
    }
    return back()->with('error','Gagal menyimpan perubahan..');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Asn $asn)
{
    $cek = Rencana::where('asn_id', $asn->id)->get();
    if($cek->count()>0)
        return back()->with('warning','Tidak dapat menghapus. \nAkun ini memiliki keterkaitan dengan data lainnya..');
    if(Asn::destroy($asn->id)){
        User::where('asn_id', $asn->id)->delete();
        return back()->with('error','Data ASN telah dihapus..');
    }
    return back()->with('warning','Gagal menghapus data..');
        
}
}
