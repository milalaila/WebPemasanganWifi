<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    
    public function indexProvinsi()
    {
        $provinsis = Provinsi::all();
        return view('wilayah.provinsi', compact('provinsis'));
    }

    public function storeProvinsi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        Provinsi::create([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Provinsi berhasil ditambahkan!');
    }

    public function updateProvinsi(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $provinsi = Provinsi::findOrFail($id);
        $provinsi->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Provinsi berhasil diupdate!');
    }

    public function deleteProvinsi($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->back()->with('success', 'Provinsi berhasil dihapus!');
    }


}