<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\User;
use App\Models\Layanan;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.dokter.index', [
            'dokter' => Dokter::all(),
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.dokter.create', [
            'layanan' => Layanan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->post());
        $data = [
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'layanan_id' => 'required',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
    
        $validate = $request->validate($data);

        $user = User::create([
            'name' => $validate['nama_dokter'],
            'username' => $validate['username'],
            'email' => $validate['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($validate['password']),
            'is_dokter' => true,
        ]);
    
        $dokter = Dokter::create([
            'id_user' => $user->id,
            'nama_dokter' => $validate['nama_dokter'],
            'spesialis' => $validate['spesialis'],
            'layanan_id' => $validate['layanan_id'],
            'tgl_lahir' => $validate['tgl_lahir'],
            'no_hp' => $validate['no_hp'],
            'alamat' => $validate['alamat'],
        ]);

        return redirect('/dashboard/dokter')->with('success', 'Data dokter berhasil di tambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show(Dokter $dokter)
    {
        //
        return view('/dashboard/dokter/show', [
            'dokter' => $dokter
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokter $dokter)
    {
        //
        $spesialis = [
                "Spesialis Penyakit Dalam",
                "Spesialis Obstetri dan Ginekologi",
                "Spesialis Anak",
                "Spesialis Bedah",
                "Spesialis Radiologi",
                "Spesialis Anestesi",
                "Spesialis Gigi",
                "Spesialis Anestesi",
                "Spesialis Anestesi",
        ];

        $users = User::where('id', $dokter->id_user)->first();

        $dokter->username = $users->username ?? '-';
        $dokter->email = $users->email ?? '-';

        return view('dashboard.dokter.edit', [
            'dokter' => $dokter,
            'layanan' => Layanan::all(),
            'spesialis' => $spesialis
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokter $dokter)
    {
        //
        $data = [
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'layanan_id' => 'required',
            'tgl_lahir' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:6'
        ];
    
        $validate = $request->validate($data);
    
        $dokter->update([
            'nama_dokter' => $validate['nama_dokter'],
            'spesialis' => $validate['spesialis'],
            'layanan_id' => $validate['layanan_id'],
            'tgl_lahir' => $validate['tgl_lahir'],
            'no_hp' => $validate['no_hp'],
            'alamat' => $validate['alamat'],
        ]);
    
        $dokter->user->update([
            'name' => $validate['nama_dokter'],
            'username' => $validate['username'],
            'email' => $validate['email'],
            'password' => $validate['password'] ? bcrypt($validate['password']) : $dokter->user->password,
        ]);
    
        return redirect('/dashboard/dokter')->with('success', 'Data berhasil di edit');


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokter $dokter)
    {
        //

        User::destroy($dokter->id_user);

        Dokter::destroy($dokter->id);

        return redirect('/dashboard/dokter')->with('success', 'Data Berhasil dihapus!');

    }
}
