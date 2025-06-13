<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'angkatan' => 'required|numeric',
            'password' => 'required|min:6',
            'prodi_id' => 'required|exists:prodis,id',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mahasiswa = Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'angkatan' => $request->angkatan,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi_id
        ]);
        

        return response()->json(['message' => 'Register sukses', 'data' => $mahasiswa], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['nim', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Login gagal!'], 401);
        }

        return response()->json(['token' => $token]);
    }
}