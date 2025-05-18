<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Models\Kabupaten;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::with(['provinsi', 'kabupaten'])->get();
        $provinsis = Provinsi::all();
        $kabupatens = Kabupaten::all();

        return view('wilayah.kecamatan', compact('kecamatans', 'provinsis', 'kabupatens'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi_id' => 'required|exists:provinsis,id', 
            'kabupaten_id' => 'required|exists:kabupatens,id', 
        ]);

        Kecamatan::create([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id, 
            'kabupaten_id' => $request->kabupaten_id,
        ]);
        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'provinsi_id' => 'required|exists:provinsis,id',
            'kabupaten_id' => 'required|exists:kabupatens,id',
        ]);

        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->update([
            'name' => $request->name,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
        ]);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus!');
    }

    public function getByKabupaten($kab_id)
    {
        $kecamatan = Kecamatan::where('kabupaten_id', $kab_id)->get();
    
        return response()->json($kecamatan->map(function ($item) {
            return [
                'id' => $item->id,
                'nama' => $item->name
            ];
        }));
    }
    


}
