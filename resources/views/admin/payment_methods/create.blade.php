@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tambah Metode Pembayaran</h2>
    <a href="{{ route('payment-methods.index') }}" class="btn btn-secondary mb-3">Kembali</a>
    <form action="{{ route('payment-methods.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Metode</label>
            <input type="text" name="nama_metode" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
                <option value="cod">COD</option>
                <option value="bank">Bank</option>
                <option value="ewallet">E-wallet</option>
                <option value="qris">QRIS</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Nomor / Link QRIS (opsional)</label>
            <input type="text" name="nomor" class="form-control">
        </div>
        <div class="mb-3">
            <label>Atas Nama (opsional)</label>
            <input type="text" name="atas_nama" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
