<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;


class ProdiController extends Controller
{
    // Tampilkan semua prodi
    public function index()
    {
        return response()->json(Prodi::all());
    }

    // Simpan prodi baru
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:100',
        ]);

        $prodi = Prodi::create([
            'nama' => $request->nama,
        ]);

        return response()->json($prodi, 201);
    }

    // Tampilkan detail prodi
    public function show($id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return response()->json(['message' => 'Prodi tidak ditemukan'], 404);
        }
        return response()->json($prodi);
    }

    // Update prodi
    public function update(Request $request, $id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return response()->json(['message' => 'Prodi tidak ditemukan'], 404);
        }

        $prodi->update([
            'nama' => $request->nama,
        ]);

        return response()->json($prodi);
    }

    public function filterByProdi($id) {
        $mahasiswa = Mahasiswa::with('prodi')->where('prodi_id', $id)->get();
        return response()->json($mahasiswa);
    }
    

    // Hapus prodi
    public function destroy($id)
    {
        $prodi = Prodi::find($id);
        if (!$prodi) {
            return response()->json(['message' => 'Prodi tidak ditemukan'], 404);
        }

        $prodi->delete();
        return response()->json(['message' => 'Prodi berhasil dihapus']);
    }
}
