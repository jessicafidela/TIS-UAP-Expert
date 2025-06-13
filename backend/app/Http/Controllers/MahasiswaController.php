<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    // Tampilkan semua mahasiswa
    public function index()
    {
        return response()->json(Mahasiswa::all());
    }

    // Filter mahasiswa berdasarkan prodi_id
    public function filterByProdi($id)
    {
        $mahasiswa = Mahasiswa::where('prodi_id', $id)->get();

        if ($mahasiswa->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($mahasiswa);
    }

    // Tampilkan detail mahasiswa berdasarkan NIM
    public function show($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        return response()->json($mahasiswa);
    }

    // Tambahkan mahasiswa baru
    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'angkatan' => 'required|numeric',
            'password' => 'required|min:6',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi_id,
        ]);

        return response()->json(['message' => 'Mahasiswa berhasil ditambahkan', 'data' => $mahasiswa], 201);
    }

    // Update data mahasiswa berdasarkan NIM
    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->update($request->all());

        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $mahasiswa]);
    }

    // Hapus mahasiswa berdasarkan NIM
    public function destroy($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa tidak ditemukan'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa berhasil dihapus']);
    }
}