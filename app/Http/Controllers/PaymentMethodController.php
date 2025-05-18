<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $methods = PaymentMethod::all();
        return view('payment_methods.index', compact('methods'));
    }

    public function create()
    {
        return view('admin.payment_methods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_metode' => 'required|string',
            'tipe' => 'required|in:cod,bank,ewallet,qris',
            'nomor' => 'nullable|string',
            'atas_nama' => 'nullable|string',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('payment-methods.index')->with('success', 'Metode pembayaran ditambahkan!');
    }

    public function edit($id)
{
    $method = PaymentMethod::findOrFail($id);
    return view('admin.payment_methods.edit', compact('method'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_metode' => 'required|string',
        'tipe' => 'required|in:cod,bank,ewallet,qris',
        'nomor' => 'nullable|string',
        'atas_nama' => 'nullable|string',
    ]);

    $method = PaymentMethod::findOrFail($id);
    $method->update($request->all());

    return redirect()->route('payment-methods.index')->with('success', 'Data berhasil diupdate!');
}

public function destroy($id)
{
    $method = PaymentMethod::findOrFail($id);
    $method->delete();

    return redirect()->route('payment-methods.index')->with('success', 'Data berhasil dihapus!');
}

}
