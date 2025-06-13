<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaMatakuliahSeeder extends Seeder
{
    public function run()
    {
        $mahasiswas = [
            '220001', '210002', '220003', '230004', '230005',
            '210006', '230007', '220008', '210009', '230010',
        ];

        $matkulIds = [1, 2, 3, 4, 5];
        $pivotData = [];

        // Setiap matkul akan memiliki 3-5 mahasiswa secara acak
        foreach ($matkulIds as $mkId) {
            $jumlahMahasiswa = rand(3, 5);
            $mahasiswaUntukMatkul = collect($mahasiswas)->shuffle()->take($jumlahMahasiswa);

            foreach ($mahasiswaUntukMatkul as $nim) {
                $pivotData[] = [
                    'mhsNim' => $nim,
                    'mkId' => $mkId,
                ];
            }
        }

        // Hapus duplikat jika ada mahasiswa yang sama di matkul yang sama
        $uniquePivotData = collect($pivotData)
            ->unique(fn ($item) => $item['mhsNim'] . '-' . $item['mkId'])
            ->values()
            ->all();

        DB::table('mahasiswa_matakuliah')->insert($uniquePivotData);
    }
}