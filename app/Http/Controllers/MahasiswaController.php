<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //READ: ambil semua data mahasiswa + relasi prodi
    public function index()
    {
        // with('prodi') → mengambil data relasi prodi (foreign key)
        $mahasiswa = Mahasiswa::with('prodi')->get();
        return response()->json($mahasiswa, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // CREATE: tambah mahasiswa baru
    public function store(Request $request)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim',
            'nama_lengkap' => 'required|string',
            'prodi_id' => 'required|exists:prodi,prodi_id'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }
        // simpan data
        $mahasiswa = Mahasiswa::create($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil ditambah',
                'data' => $mahasiswa
            ], 201);
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // UPDATE: update data mahasiswa
    public function update(Request $request, string $id)
    {
        // validasi input update
        $validator = Validator::make($request->all(), [
            'nim' => 'required|unique:mahasiswa,nim,' . $id,
            'nama_lengkap' => 'required|string',
            'prodi_id' => 'required|exists:prodi,prodi_id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }
        // cari data mahasiswa
        $mhs = Mahasiswa::find($id);

        // jika tidak ditemukan
        if (!$mhs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // update data
        $mhs->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Mahasiswa berhasil diupdate',
                'data' => $mhs
            ], 200);
        }


    /**
     * Remove the specified resource from storage.
     */
    // DELETE: hapus mahasiswa
    public function destroy(string $id)
    {
        // cari data mahasiswa
        $mhs = Mahasiswa::find($id);

        // jika tidak ada
        if (!$mhs) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // hapus data
        $mhs->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Mahasiswa berhasil dihapus'
        ], 200);
    }
}