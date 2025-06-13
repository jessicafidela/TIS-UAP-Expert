<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        DB::table('mahasiswas')->insert([
            [
                'nim' => '220001',
                'nama' => 'Arthur James',
                'angkatan' => 2022,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 1
            ],
            [
                'nim' => '210002',
                'nama' => 'Benjamin Santoso',
                'angkatan' => 2021,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 2
            ],
            [
                'nim' => '220003',
                'nama' => 'Carmen Lestari',
                'angkatan' => 2022,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 3
            ],
            [
                'nim' => '230004',
                'nama' => 'Didi Kusuma',
                'angkatan' => 2023,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 1
            ],
            [
                'nim' => '230005',
                'nama' => 'Esther Geraldine',
                'angkatan' => 2023,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 2
            ],
            [
                'nim' => '210006',
                'nama' => 'Felix Lee',
                'angkatan' => 2021,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 3
            ],
            [
                'nim' => '230007',
                'nama' => 'Gilang Cipto',
                'angkatan' => 2023,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 1
            ],
            [
                'nim' => '220008',
                'nama' => 'Helena Wijaya',
                'angkatan' => 2022,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 2
            ],
            [
                'nim' => '210009',
                'nama' => 'Ivan Clark',
                'angkatan' => 2021,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 3
            ],
            [
                'nim' => '230010',
                'nama' => 'Kenneth Partridge',
                'angkatan' => 2023,
                'password' => Hash::make('rahasia123'),
                'prodi_id' => 1
            ],
        ]);        
    }
}
