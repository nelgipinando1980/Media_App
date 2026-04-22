<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan seluruh data prodi 
    public function index()
    {
        $prodi = Prodi::all(); 
        return response()->json($prodi, 200);
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
    // Menyimpan data prodi baru ke database
    public function store(Request $request)
    {
        // Validasi data input dari request
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string',
            'singkatan' => 'required|string'
        ]);

        // Menampilkan jika gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
    }

        // Simpan data
        $prodi = Prodi::create($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => "Prodi berhasil ditambah",
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
    // Mengupdate data pribadi berdasarkan id
    public function update(Request $request, string $id)
    {
        // Validasi input update data
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string',
            'singkatan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        // Cari data berdasarkan Id
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Prodi tidak ditemukan'
            ], 404);
        }

        // Update data
        $prodi->update($validator->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Prodi berhasil diupdate',
            'data' => $prodi
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    // Menghapus data pribadi berdasarkan id
    public function destroy(string $id)
    {
        // Cari data berdasarkan Id
        $prodi = Prodi::find($id);

        if (!$prodi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Prodi tidak ditemukan'
            ], 404);
        }

        // Hapus data
        $prodi->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Prodi berhasil dihapus'
        ], 200);
    }
}