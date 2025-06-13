<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class MatkulController extends Controller
{
    public function index()
    {
        // Tampilkan semua mata kuliah
        $matkuls = Matakuliah::all();
        return response()->json($matkuls);
    }

    public function tambah(Request $request)
    {
        \Log::info('Matkul ID: ' . json_encode($request->all()));

        // Ambil user yang sedang login
        $user = JWTAuth::parseToken()->authenticate();

        $matkulId = $request->input('matkul_id');

        // Bisa dicek dulu apakah matkulId valid dan mahasiswa sudah terdaftar
        $matkul = Matakuliah::find($matkulId);
        if (!$matkul) {
            return response()->json(['error' => 'Matakuliah tidak ditemukan'], 404);
        }

        // Hubungkan matkul dengan mahasiswa (many-to-many)
        $user->matakuliahs()->attach($matkulId);

        return response()->json(['message' => 'Matakuliah berhasil ditambahkan']);
    }

    // public function show($id)
    // {
    //     // Ambil mahasiswa yang login (dari 'nim' nya)
    //     $user = JWTAuth::parseToken()->authenticate();

    //     // Kalau param id disini untuk matkul, maka endpoint ini hrsnya utk cek matkul tertentu yang dimiliki mahasiswa
    //     // Tapi sebenarnya kalau ingin lihat semua matkul milik mahasiswa yang login, id gak perlu di-passing di URL
    //     // Misal ini untuk ambil matkul dengan id tertentu milik mahasiswa yang lagi login:
    //     $matkul = $user->matakuliahs()->where('id', $id)->first();

    //     if (!$matkul) {
    //         return response()->json(['error' => 'Matakuliah tidak ditemukan untuk mahasiswa ini'], 404);
    //     }

    //     return response()->json($matkul);
    // }

    public function getByNim($nim)
    {
        $user = JWTAuth::parseToken()->authenticate();
    
        // Mastiin mahasiswa yang login hanya bisa akses data matkul milik dirinya sendiri
        if ($user->nim !== $nim) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }
    
        // Ambil daftar matkul milik mahasiswa login
        $matkulList = $user->matakuliahs;
    
        return response()->json($matkulList);
    }
}