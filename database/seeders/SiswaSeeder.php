<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswas = [
            ['name' => 'Ahmad Rizki', 'email' => 'ahmad@siswa.local', 'nis' => '001', 'kelas' => 'XII IPA 1', 'alamat' => 'Jl. Merdeka No. 1', 'no_hp' => '081234567801'],
            ['name' => 'Siti Nurhaliza', 'email' => 'siti@siswa.local', 'nis' => '002', 'kelas' => 'XII IPA 2', 'alamat' => 'Jl. Sudirman No. 2', 'no_hp' => '081234567802'],
            ['name' => 'Budi Santoso', 'email' => 'budi@siswa.local', 'nis' => '003', 'kelas' => 'XI IPS 1', 'alamat' => 'Jl. Thamrin No. 3', 'no_hp' => '081234567803'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi@siswa.local', 'nis' => '004', 'kelas' => 'XI IPS 2', 'alamat' => 'Jl. Gatot Subroto No. 4', 'no_hp' => '081234567804'],
            ['name' => 'Andi Pratama', 'email' => 'andi@siswa.local', 'nis' => '005', 'kelas' => 'X IPA 1', 'alamat' => 'Jl. Diponegoro No. 5', 'no_hp' => '081234567805'],
        ];

        foreach ($siswas as $siswa) {
            User::create([
                'name' => $siswa['name'],
                'email' => $siswa['email'],
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'nis' => $siswa['nis'],
                'kelas' => $siswa['kelas'],
                'alamat' => $siswa['alamat'],
                'no_hp' => $siswa['no_hp'],
            ]);
        }
    }
}
