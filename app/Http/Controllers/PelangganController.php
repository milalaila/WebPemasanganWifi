<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\PaketWifi;
use App\Models\PaymentMethod;
use App\Models\Pelanggan;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class PelangganController extends Controller
{

    public function submit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'provinsi_id' => 'required|exists:provinsis,id',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'paket_wifi_id' => 'required|exists:paket_wifis,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'kebutuhan' => 'required|string|max:255',
            'ktp_file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

       
        $paket = PaketWifi::findOrFail($request->paket_wifi_id);
        $totalHarga = $paket->harga;

        
        $ktp_file_path = $request->file('ktp_file')->store('ktp_files', 'public');

        Pelanggan::create([
            'nama' => $request->nama,
            'nik' => $request->nik, 
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'provinsi_id' => $request->provinsi_id, 
            'kabupaten_id' => $request->kabupaten_id, 
            'kecamatan_id' => $request->kecamatan_id, 
            'paket_wifi_id' => $request->paket_wifi_id,
            'payment_method_id' => $request->payment_method_id,
            'kebutuhan' => $request->kebutuhan,
            'tanggal_pemasangan' => now(), 
            'total_harga' => $totalHarga,
            'foto_ktp' => $ktp_file_path,
            'status' => 'pending',
        ]);

        return redirect()->route('registrasi.form')->with('success', 'Pendaftaran berhasil!');
    }

    
    public function register()
{
    $prov = Provinsi::all(); // Sesuai dengan model Anda
    $paket = PaketWifi::all();
    $paymentMethods = PaymentMethod::all();
    return view('register.register', compact('paket', 'prov','paymentMethods'));
}

public function getKabupaten($prov_id)
{
    $kabupaten = Kabupaten::where('provinsi_id', $prov_id)->get(['id', 'name']); // gunakan 'name'
    return response()->json($kabupaten);
}

public function getKecamatan($kab_id)
{
    $kecamatan = Kecamatan::where('kabupaten_id', $kab_id)->get(['id', 'name']); // gunakan 'name'
    return response()->json($kecamatan);
}


}