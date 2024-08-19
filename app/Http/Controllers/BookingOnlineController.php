<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Layanan;
use App\Models\Dokter;
use App\Models\RegPasien;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingOnlineController extends Controller
{
    public function index()
    {
        return view('booking-online.index');
    }

    public function checkNik(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
        ]);

        $pasien = Pendaftaran::where('no_ktp', $request->nik)->first();

        if ($pasien) {
            $layanans = Layanan::all();
            return view('booking-online.form', compact('pasien', 'layanans'));
        } else {
            return redirect()->back()->with('error', 'NIK tidak ditemukan.');
        }
    }

    public function getDokters(Request $request)
    {
        $layananId = $request->layanan_id;
        $dokters = Dokter::where('layanan_id', $layananId)->get();
        return response()->json($dokters);
    }

    public function submitBooking(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal_booking' => 'required|date|after:today',
            'tipe_pasien' => 'required|in:BPJS,UMUM',
            'no_bpjs' => 'required_if:tipe_pasien,BPJS',
        ]);
    
        $pasien = Pendaftaran::where('no_ktp', $request->nik)
            ->latest('created_at')
            ->first();
    
        if (!$pasien) {
            return redirect()->route('booking.index')->with('error', 'Pasien tidak ditemukan.');
        }

        $recentBooking = RegPasien::where('pasien_id', $pasien->id)
            ->where('created_at', '>=', now()->subDays(3))
            ->first();
    
        if ($recentBooking) {
            return redirect()->route('booking.index')->with('error', 'Anda telah melakukan booking dalam 3 hari terakhir. Silakan tunggu hingga periode tersebut berakhir untuk melakukan booking baru.');
        } 
    
        $old_rm = substr($pasien->no_rm, 3);
    
        $rand = rand(10, 99);
        
        $rm = $rand . '-' . $old_rm;
        
        $noregistrasi = random_int(10000000, 99999999);
    
        $pendaftaran = new Pendaftaran();
        $pendaftaran->no_rm = $rm;
        $pendaftaran->no_ktp = $request->nik;
        $pendaftaran->nama = $pasien->nama;
        $pendaftaran->ttl = $pasien->ttl;
        $pendaftaran->jenis_kelamin = $pasien->jenis_kelamin;
        $pendaftaran->status = $pasien->status;
        $pendaftaran->pj = '-';
        $pendaftaran->no_pj = '-';
        $pendaftaran->alamat = $pasien->alamat;
        $pendaftaran->pendidikan = $pasien->pendidikan;
        $pendaftaran->pekerjaan = $pasien->pekerjaan;
        $pendaftaran->agama = $pasien->agama;
        $pendaftaran->no_hp = $pasien->no_hp;
        $pendaftaran->save();
    
        $dokter = Dokter::where('layanan_id', $request->layanan_id)->firstOrFail();
    
        $regPasien = new RegPasien();
        $regPasien->noregistrasi = $noregistrasi;
        $regPasien->no_bpjs = $request->tipe_pasien == 'BPJS' ? ($request->no_bpjs ?? null) : null;
        $regPasien->pasien_id = $pendaftaran->id;
        $regPasien->dokter_id = $dokter->id;
        $regPasien->layanan_id = $request->layanan_id;
        $regPasien->tipe_pasien = ucfirst(strtolower($request->tipe_pasien));
        $regPasien->status = true;
        $regPasien->id_rekam_medis = null;
        $regPasien->keterangan = 'Booking Online';
        $regPasien->is_booking_online = true;
        $regPasien->tanggal_booking = $request->tanggal_booking;
        $regPasien->save();
    
        return redirect()->route('booking.index')->with('success', 'Booking berhasil. Nomor registrasi Anda: ' . $noregistrasi);
    }
    
}