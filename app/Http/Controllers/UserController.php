<?php

namespace App\Http\Controllers;

use App\Models\Asn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\returnSelf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function password(Request $request){
        $data = $request->validate([
            'password' => 'required'
        ]);

        if(User::where('id', Auth::user()->id)->update(['password'=>Hash::make($request->password)]))
            return back()->with('success','Password diubah');
        return back()->with('error','Gagal menyimpan');
    }

    public function login()
    {
        
        if(Auth::check()){
            if(Auth::user()->level=='asn')
                return redirect('asn/')->with('warning', 'Anda telah login..');
            if(Auth::user()->level=='admin')
                return redirect('admin/')->with('warning', 'Anda telah login..');
        }
        
        return view('login');
    }

    public function auth(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $validate['sts'] = '1';
        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            if(Auth::user()->level == 'admin'){
                return redirect('/admin')->with('success','Anda masuk sebagai Admin..');
            }else{
                return redirect('/asn')->with('success','Anda masuk pada halaman ASN..');
            }
        }
        return back()->with('error','Login gagal ...');
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
