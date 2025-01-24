<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangInventarisController extends Controller
{
    // tampilkan barang inventaris
    public function index()
    {
        $barangInventaris = BarangInventaris::all();
        return response()->json($barangInventaris);
    }

    // simpan barang inventaris baru
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data[0]) && is_array($data[0])) {
            // data array
            $validator = Validator::make($request->all(), [
                '*.br_kode' => 'required|string|max:12|unique:tm_barang_inventaris,br_kode',
                '*.jns_brg_kode' => 'required|string|max:5',
                '*.user_id' => 'required|string|max:10',
                '*.br_nama' => 'required|string|max:50',
                '*.br_tgl_terima' => 'nullable|date',
                '*.br_tgl_entry' => 'required|date',
                '*.br_status' => 'required|string|max:2',
            ]);
        } else {
            // data object
            $validator = Validator::make($request->all(), [
                'br_kode' => 'required|string|max:12|unique:tm_barang_inventaris,br_kode',
                'jns_brg_kode' => 'required|string|max:5',
                'user_id' => 'required|string|max:10',
                'br_nama' => 'required|string|max:50',
                'br_tgl_terima' => 'nullable|date',
                'br_tgl_entry' => 'required|date',
                'br_status' => 'required|string|max:2',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $createdItems = [];

        if (isset($data[0]) && is_array($data[0])) {
            // data array
            foreach ($data as $item) {
                $createdItems[] = BarangInventaris::create($item);
            }
        } else {
            // data object
            $createdItems[] = BarangInventaris::create($data);
        }

        return response()->json($createdItems, 201);
    }

    // tampilkan barang inventaris berdasarkan id
    public function show($id)
    {
        $barangInventaris = BarangInventaris::find($id);
        return response()->json($barangInventaris);
    }

    // memperbarui barang inventaris
    public function update(Request $request, $id)
    {
        $barangInventaris = BarangInventaris::find($id);
        if ($barangInventaris) {
            $barangInventaris->update($request->all());
            return response()->json($barangInventaris);
        } else {
            return response()->json(['message' => 'Barang Inventaris not found'], 404);
        }
    }

    // menghapus barang inventaris berdasarkan id
    public function destroy($id)
    {
        BarangInventaris::destroy($id);
        return response()->json(null, 204);
    }
}
