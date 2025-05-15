<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\PaketWifi;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // Menampilkan form registrasi
    public function form()
    {
        $provinsis = Provinsi::all();  // Ambil semua provinsi
        $paketWifi = PaketWifi::all();  // Ambil semua paket WiFi

        return view('registrasi', compact('provinsis', 'paketWifi'));
    }

    // Menangani submission dari form
    public function submit(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'provinsi_id' => 'required|exists:provinsis,id',
            'kabupaten_id' => 'required|exists:kabupatens,id',
            'kecamatan_id' => 'required|exists:kecamatans,id',
            'paket_wifi_id' => 'required|exists:paket_wifis,id',
            'ktp_file' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Upload file KTP
        $ktp_file_path = $request->file('ktp_file')->store('ktp_files');

        // Simpan data pelanggan
        Pelanggan::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'provinsi_id' => $request->provinsi_id,
            'kabupaten_id' => $request->kabupaten_id,
            'kecamatan_id' => $request->kecamatan_id,
            'paket_wifi_id' => $request->paket_wifi_id,
            'ktp_file' => $ktp_file_path,
        ]);

        return redirect()->route('registrasi.form')->with('success', 'Pendaftaran berhasil');
    }

    // Mengambil data Kabupaten berdasarkan Provinsi
    public function getKabupaten($provinsi_id)
    {
        $kabupatens = Kabupaten::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kabupatens);
    }

    // Mengambil data Kecamatan berdasarkan Kabupaten
    public function getKecamatan($kabupaten_id)
    {
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupaten_id)->get();
        return response()->json($kecamatans);
    }
}
