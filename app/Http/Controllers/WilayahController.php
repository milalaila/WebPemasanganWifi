<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;

class WilayahController extends Controller
{
    // ==================== PROVINSI ====================
    
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
    public function edit($id)
{
    $data = Provinsi::findOrFail($id); 
    $provinsi = Provinsi::all(); 
    return view('folder.edit', compact('data', 'provinsi'));
}

    public function deleteProvinsi($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        return redirect()->back()->with('success', 'Provinsi berhasil dihapus!');
    }

    // ==================== KABUPATEN ====================

    public function indexKabupaten($provinsiId = null)
{
    $provinsis = Provinsi::all();
    $provinsi = $provinsiId ? Provinsi::with('kabupatens')->findOrFail($provinsiId) : null;
    $kabupatens = $provinsi ? $provinsi->kabupatens : collect();

    return view('kabupaten.index', compact('provinsis', 'provinsi', 'kabupatens'));
}


    public function storeKabupaten(Request $request)
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

    public function editKabupaten($id){
        $kabupaten = Kabupaten::findOrFail($id);
        return view('kabupaten.edit');
    }

    public function updateKabupaten(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100'
        ]);

        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->update([
            'name' => $request->name
        ]);

        return redirect()->back()->with('success', 'Kabupaten berhasil diupdate!');
    }

    public function deleteKabupaten($id)
    {
        $kabupaten = Kabupaten::findOrFail($id);
        $kabupaten->delete();

        return redirect()->back()->with('success', 'Kabupaten berhasil dihapus!');
    }

    public function index()
{
    $kabupaten = Kabupaten::all(); 
    return view('wilayah.kabupaten', compact('kabupaten'));
}
}