<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Read di ambil dari semua kategori
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json($kategori, 200);
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
    //Create tambah kategori baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string'
        ]);

        // Jika validasi gagal, tampilkan error
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        
        }

        // Simpan data kategori baru
        $kategori = Kategori::create($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => "Kategori berhasil ditambah",
                'data' => $kategori
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
    public function update(Request $request, string $id)
    {
        // validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 422);
        }

        // cari data berdasarkan ID
        $kategori = Kategori::find($id);

        // jika tidak ditemukan
        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
        // update data
        $kategori->update($validator->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Kategori berhasil diupdate',
                'data' => $kategori
            ], 200);
        }

    

    /**
     * Remove the specified resource from storage.
     */
    // DELETE: hapus kategori
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $kategori->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Kategori berhasil dihapus'
        ], 200);
    }
}