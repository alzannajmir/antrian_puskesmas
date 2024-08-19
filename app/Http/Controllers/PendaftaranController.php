<?php

namespace App\Http\Controllers;

use \App\Models\Pendaftaran;
use \App\Models\Layanan;
use \App\Models\Dokter;
use App\Models\RegPasien;
use Illuminate\Http\Request;



class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pendaftaranDenganRegistrasi = Pendaftaran::whereHas('registrasi', function($query) {
            $query->where('is_booking_online', 0);
        })->get();

        $pendaftaranTanpaRegistrasi = Pendaftaran::whereDoesntHave('registrasi')->get();

        $pendaftaran = $pendaftaranDenganRegistrasi->merge($pendaftaranTanpaRegistrasi);

        $registrasi = RegPasien::where('is_booking_online', 0)->get();

        return view('dashboard.pendaftaran.index', [
            'pendaftaran' => $pendaftaran,
            'registrasi' => $registrasi
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
        
        return view(
            'dashboard.pendaftaran.create',

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //proses validasi

        // dd($request->post());
        $rand = rand(10,99);

        $rm = $rand . '-' .  substr($request->ttl,2,5);

        
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
        
        $data['no_rm'] = $rm;

        // dd($data);
        Pendaftaran::create($data);
        return redirect('/dashboard/pendaftaran')->with('success', 'Data Berhasil disimpan');
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
    
        return view('dashboard.pendaftaran.show', [
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
        return view('dashboard.pendaftaran.edit', [
            'pasien' => Pendaftaran::where('no_rm', $id)->get()
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
        return redirect('/dashboard/pendaftaran')->with('success', 'Data berhasil di edit');

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
