<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\User;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$table->string('nama_dokter');
        // $table->string('spesialis');
        // $table->foreignId('layanan_id');
        // $table->string('tgl_lahir');
        // $table->string('no_hp');
        // $table->string('alamat');
        // $table->timestamps();
        $doctors = [
            [
                'nama_dokter' => 'Argo Pribadi, dr, Sp.A',
                'spesialis' => 'Ibu dan Anak',
                'layanan_id' => 1,
                'tgl_lahir' => '1988-05-22',
                'no_hp' => '087771525333',
                'alamat' => 'Jl. Rumah Sakit Umum No.1, Kotabaru, Kec. Serang, Kota Serang, Banten 42112',
                'username' => 'argo_pribadi',
                'email' => 'argo_pribadi@gmail.com',
                'password' => bcrypt('password123')
            ],
            [
                'nama_dokter' => 'Eris Sejahtera, drg',
                'spesialis' => 'Gigi',
                'layanan_id' => 2,
                'tgl_lahir' => '1981-07-12',
                'no_hp' => '087771525323',
                'alamat' => 'Jl. sochari, Kota Serang, Banten 42112',
                'username' => 'eris_sejahtera',
                'email' => 'eris_sejahtera@gmail.com',
                'password' => bcrypt('password123')
            ],
            [
                'nama_dokter' => 'M. Erwin Jaya Sanjaya, SpOG',
                'spesialis' => 'Kehamilan',
                'layanan_id' => 3,
                'tgl_lahir' => '1970-05-22',
                'no_hp' => '0877715211111',
                'alamat' => 'Jl. Rumah Sakit Umum No.1, Kotabaru, Kec. Serang, Kota Serang, Banten 42112',
                'username' => 'erwin_jaya',
                'email' => 'erwin_jaya@gmail.com',
                'password' => bcrypt('password123')
            ],
        ];

        foreach ($doctors as $doctor) {
            // Buat user baru
            $user = User::create([
                'name' => $doctor['nama_dokter'],
                'username' => $doctor['username'],
                'email' => $doctor['email'],
                'email_verified_at' => now(),
                'password' => $doctor['password'],
                'is_dokter' => true,
            ]);

            // Buat dokter baru dan kaitkan dengan user
            Dokter::create([
                'id_user' => $user->id,
                'nama_dokter' => $doctor['nama_dokter'],
                'spesialis' => $doctor['spesialis'],
                'layanan_id' => $doctor['layanan_id'],
                'tgl_lahir' => $doctor['tgl_lahir'],
                'no_hp' => $doctor['no_hp'],
                'alamat' => $doctor['alamat'],
            ]);
        }
    }
}
