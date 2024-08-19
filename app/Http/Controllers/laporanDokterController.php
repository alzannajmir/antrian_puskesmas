<?php

namespace App\Http\Controllers;

use App\Models\RegPasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\Layanan;

class laporanDokterController extends Controller
{
    public function index(){
        return view('dashboard-dokter.laporan.index', [
            'bulan' => [
               "Januari",
               "Februari",
               "Maret","April",
               "Mei",
               "Juni",
               "Juli",
               "Agustus",
               "September",
               "Oktober",
               "November",
               "Desember"
            ],
            'layanan' => Layanan::all(),                                                                                                
        ]);
    } 


    public function cetak(Request $request)
    {
        $bulan = $request->post('bulan');

        $belas = ($bulan >= 10 ? 1 : 0);

        $dokter = Dokter::where('id_user', auth()->user()->id)->first();

        $query = RegPasien::where('keterangan', 'Selesai')->whereRaw('month(created_at) = ' . $belas . $bulan)->where('dokter_id', $dokter->id)->get();
        
        return view('dashboard-dokter.laporan.cetak-laporan', [
            'bulan' => $query,
            
        ]);
    }
}
