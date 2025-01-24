<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return response()->json($peminjaman);
    }

    public function store(Request $request)
    {
        $peminjaman = new Peminjaman();
        $peminjaman->user_id = $request->user_id;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->save();

        foreach ($request->barang as $barang) {
            $peminjamanBarang = new PeminjamanBarang();
            $peminjamanBarang->peminjaman_id = $peminjaman->id;
            $peminjamanBarang->barang_id = $barang['barang_id'];
            $peminjamanBarang->jumlah = $barang['jumlah'];
            $peminjamanBarang->save();
        }

        return response()->json(['message' => 'Peminjaman created successfully']);
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with('peminjamanBarang')->find($id);
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman not found'], 404);
        }
        return response()->json($peminjaman);
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman not found'], 404);
        }

        $peminjaman->user_id = $request->user_id;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->save();

        PeminjamanBarang::where('peminjaman_id', $id)->delete();
        foreach ($request->barang as $barang) {
            $peminjamanBarang = new PeminjamanBarang();
            $peminjamanBarang->peminjaman_id = $peminjaman->id;
            $peminjamanBarang->barang_id = $barang['barang_id'];
            $peminjamanBarang->jumlah = $barang['jumlah'];
            $peminjamanBarang->save();
        }

        return response()->json(['message' => 'Peminjaman updated successfully']);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return response()->json(['message' => 'Peminjaman not found'], 404);
        }

        PeminjamanBarang::where('peminjaman_id', $id)->delete();
        $peminjaman->delete();

        return response()->json(['message' => 'Peminjaman deleted successfully']);
    }
}
