<?php

namespace App\Http\Controllers;

use \App\Models\Pendaftaran;
use \App\Models\Layanan;
use \App\Models\Dokter;
use App\Models\RegPasien;
use Illuminate\Http\Request;



class PendaftaranOnlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'dashboard.pendaftaran_online.index',
            [
                'pendaftaran' => Pendaftaran::whereHas('registrasi', function($query) {
                    $query->where('is_booking_online', 1);
                })->get(),
                'registrasi' => RegPasien::where('is_booking_online', 1)->get()
            ]
        );
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($rm)
    {
        
        //User::where('username','like','%John%') -> first();
        $data = Pendaftaran::where('no_rm', $rm)->first();
        if(!$data){
           return redirect('/dashboard/pendaftaran');
        };
    
        $layanan = Layanan::all();
        $dokterByLayanan = Dokter::with('layanan')->get()->groupBy('layanan_id');
    
        return view('dashboard.pendaftaran_online.show', [
            'pasien' => $data,
            'layanan' => $layanan,
            'dokterByLayanan' => $dokterByLayanan,
            'registrasi' => RegPasien::where('status', 1)->where('pasien_id', $data->id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pasien = Pendaftaran::where('no_rm', $id)->get();

        $registrasi = RegPasien::where('pasien_id', $pasien[0]['id'])->where('is_booking_online', 1)->first();

        return view('dashboard.pendaftaran_online.edit', [
            'pasien' => $pasien,
            'registrasi' => $registrasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->post());

        $validasi = [
            'no_rm' => 'unique:pendaftaran',
            'no_ktp' => 'required',
            'nama' => 'required',
            'ttl' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'agama' => 'required',
            'no_hp' => 'required',
            'pj' => 'required',
            'no_pj' => 'required',
        ];

        $data = $request->validate($validasi);

        Pendaftaran::where('id', $id)->update($data);

        RegPasien::where('pasien_id', $id)->update([
            'keterangan' => 'Pendaftaran',
            'is_booking_online' => 0,
            'tanggal_booking' => null
        ]);

        return redirect('/dashboard/pendaftaran-online')->with('success', 'Data Pendaftaran Berhasil disimpan!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
