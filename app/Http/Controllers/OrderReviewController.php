<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReview;

class OrderReviewController extends Controller
{
    public function create()
    {
        return view('order_review.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'whatsapp' => 'required|string|max:20',
    ]);

    // Simpan data dengan status 'pending'
    OrderReview::create([
        'nama' => $request->nama,
        'whatsapp' => $request->whatsapp,
        'status' => 'pending', // pastikan ini ada
    ]);

    return redirect()->back()->with('success', 'Registrasi berhasil dikirim!');
}


    public function index()
    {
        $pending = OrderReview::where('status', 'pending')->get();
        
        return view('order_review.admin_review', compact('pending'));
    }

    public function accept($id)
    {
        $data = OrderReview::findOrFail($id);
        $data->update(['status' => 'accepted']);

        // TODO: Kirim WA notifikasi diterima di sini

        return back()->with('success', 'Peserta diterima.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $data = OrderReview::findOrFail($id);
        $data->update([
            'status' => 'rejected',
            'reason' => $request->reason
        ]);

        // TODO: Kirim WA notifikasi ditolak di sini

        return back()->with('success', 'Peserta ditolak.');
    }

    public function history()
    {
        $accepted = OrderReview::where('status', 'accepted')->get();
        $rejected = OrderReview::where('status', 'rejected')->get();
        return view('order_review.admin_history', compact('accepted', 'rejected'));
    }
    
}
