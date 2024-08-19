<?php

namespace App\Http\Controllers;

use \App\Models\Pendaftaran;
use \App\Models\Layanan;
use \App\Models\Dokter;
use App\Models\RegPasien;
use App\Models\RekamMedis;
use Illuminate\Http\Request;



class PasienController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $dokter = Dokter::where('id_user', $user->id)->first();

        $registrasi = RegPasien::where('is_booking_online', 0)->where('dokter_id', $dokter->id)->get();

        $pendaftaran = Pendaftaran::whereIn('id', $registrasi->pluck('pasien_id'))->get();
    
        return view(
            'dashboard-dokter.pasien.index',
            [
                'pendaftaran' => $pendaftaran,
                'registrasi' => $registrasi,
            ]
        );
    }
    

    public function show($rm)
    {
        $data = Pendaftaran::where('no_rm', $rm)->first();
        if(!$data){
           return redirect('/dashboard-dokter/pasien');
        };

        $rekamMedis = RekamMedis::where('no_ktp', $data->no_ktp)->latest()->first();

        return view('dashboard-dokter.pasien.show', [
            'pasien' => $data,
            'layanan' => Layanan::all(),
            'dokter' => Dokter::all(),
            'registrasi' => RegPasien::where('is_booking_online', 0)->where('status', 1)->where('pasien_id', $data->id)->first(),
            'rekamMedis' => $rekamMedis
        ]);
    }

    public function update(Request $request, $id)
    {
        $pasien = Pendaftaran::findOrFail($id);
        
        $validatedData = $request->validate([
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string|max:255',
            'diagnosis' => 'required|string|max:255',
            'terapi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);
    
        $validatedData['no_ktp'] = $pasien->no_ktp;
    
        $rekamMedis = RekamMedis::updateOrCreate(
            ['no_ktp' => $pasien->no_ktp],
            $validatedData
        );
    
        $pasien->update([
            'id_rekam_medis' => $rekamMedis->id
        ]);

        $regPasien = RegPasien::where('is_booking_online', 0)->where('pasien_id', $pasien->id)->first();
        
        $regPasien->update([
            'id_rekam_medis' => $rekamMedis->id,
            'keterangan' => 'Selesai',
        ]);

        return redirect('/dashboard-dokter/pasien')->with('success', 'Rekam medis berhasil diperbarui');
    }
}
