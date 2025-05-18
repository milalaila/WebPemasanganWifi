<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;

class KabupatenController extends Controller
{
    public function index()
    {
        $kabupatens = Kabupaten::with('provinsi')->get();
        $provinsis = Provinsi::all();
        return view('wilayah.kabupaten', compact('kabupatens', 'provinsis'));
    }

    public function destroy($kabupaten_id)
    {
        $kabupaten = Kabupaten::findOrFail($kabupaten_id);
        $kabupaten->delete();
        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'provinsi_id' => 'required|exists:provinsis,id',
        ]);
        $kabupaten = Kabupaten::findOrFail($id);

        $kabupaten->update([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id,
        ]);
        return redirect()->route('kabupaten.index')->with('success', 'Kabupaten berhasil diupdate!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'provinsi_id' => 'required|exists:provinsis,id'
        ]);

        Kabupaten::create([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id
        ]);

        return redirect()->back()->with('success', 'Kabupaten berhasil ditambahkan!');
    }

    public function getByProvinsi($prov_id)
    {
        $kabupaten = Kabupaten::where('provinsi_id', $prov_id)->get();

        return response()->json($kabupaten->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->name // karena di tabel kolomnya "name"
            ];
        }));
    }







}