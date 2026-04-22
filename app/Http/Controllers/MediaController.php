<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // READ: ambil semua data media + relasi mahasiswa & kategori
    public function index()
    {
        $media = Media::with(['mahasiswa', 'kategori'])->get();
        return response()->json($media, 200);
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
     // CREATE: upload / tambah media
    public function store(Request $request)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file_url' => 'required|url'
        ]);

        // jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // simpan data
        $media = Media::create($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Media berhasil diunggah',
                'data' => $media
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
    // UPDATE: update data media
    public function update(Request $request, string $id)
    {
        // validasi input update
        $validator = Validator::make($request->all(), [
            'mahasiswa_id' => 'required|exists:mahasiswa,mahasiswa_id',
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'file_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // cari data media
        $media = Media::find($id);

        // jika tidak ditemukan
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // update data
        $media->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Media berhasil diupdate',
                'data' => $media
            ], 200);
        }

    /**
     * Remove the specified resource from storage.
     */
    // DELETE: hapus media
    public function destroy(string $id)
    {
        // cari data media
        $media = Media::find($id);

        // jika tidak ada
        if (!$media) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // hapus data
        $media->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Media berhasil dihapus'
        ], 200);
    }
}