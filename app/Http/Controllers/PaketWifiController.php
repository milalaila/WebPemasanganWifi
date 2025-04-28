<?php

namespace App\Http\Controllers;

use App\Models\PaketWifi;
use Illuminate\Http\Request;


class PaketWifiController extends Controller
{
    public function index()
    {
        $pakets = PaketWifi::all();
        return view('daftarpaket', compact('pakets'));
    }

    public function create()
    {
        return view('tambahpaket');
    }

    public function store(Request $request)
    {
        PaketWifi::create($request->all());
        return redirect()->route('paketwifi.index')->with('success', 'Paket berhasil ditambahkan');
    }

    public function show($id)
    {
        $paket = PaketWifi::findOrFail($id);
        return view('detailpaket', compact('paket'));
    }

    public function edit($id)
    {
        $paket = PaketWifi::findOrFail($id);
        return view('editpaket', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketWifi::findOrFail($id);
        $paket->update($request->all());
        return redirect()->route('paketwifi.index')->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy($id)
    {
        PaketWifi::destroy($id);
        return redirect()->route('paketwifi.index')->with('success', 'Paket berhasil dihapus');
    }

    

}
