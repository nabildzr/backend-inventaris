<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBarang;

class JenisBarangController extends Controller
{
    public function index()
    {
        $jenisBarang = JenisBarang::all();
        return response()->json($jenisBarang);
    }

    public function show($id)
    {
        $jenisBarang = JenisBarang::find($id);
        if (is_null($jenisBarang)) {
            return response()->json(['message' => 'Jenis Barang not found'], 404);
        }
        return response()->json($jenisBarang);
    }

    public function store(Request $request)
    {
        $jenisBarang = JenisBarang::create($request->all());
        return response()->json($jenisBarang, 201);
    }

    public function update(Request $request, $id)
    {
        $jenisBarang = JenisBarang::find($id);
        if (is_null($jenisBarang)) {
            return response()->json(['message' => 'Jenis Barang not found'], 404);
        }
        $jenisBarang->update($request->all());
        return response()->json($jenisBarang);
    }

    public function destroy($id)
    {
        $jenisBarang = JenisBarang::find($id);
        if (is_null($jenisBarang)) {
            return response()->json(['message' => 'Jenis Barang not found'], 404);
        }
        $jenisBarang->delete();
        return response()->json(null, 204);
    }
}
