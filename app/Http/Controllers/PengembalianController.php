<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;

class PengembalianController extends Controller
{
    //
    public function index()
    {
        $pengembalians = Pengembalian::all();
        return response()->json($pengembalians);
    }

    public function store(Request $request)
    {
        $pengembalian = Pengembalian::create($request->all());
        return response()->json($pengembalian, 201);
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::find($id);
        if (is_null($pengembalian)) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        return response()->json($pengembalian);
    }

    public function update(Request $request, $id)
    {
        $pengembalian = Pengembalian::find($id);
        if (is_null($pengembalian)) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        $pengembalian->update($request->all());
        return response()->json($pengembalian);
    }

    public function destroy($id)
    {
        $pengembalian = Pengembalian::find($id);
        if (is_null($pengembalian)) {
            return response()->json(['message' => 'Pengembalian not found'], 404);
        }
        $pengembalian->delete();
        return response()->json(null, 204);
    }
}
