@extends('layout.main')

@section('content')
<div class="container">
    <h2>Edit Paket Wifi</h2>

    <form action="{{ route('paketwifi.update', $paket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_paket" class="form-label">Nama Paket</label>
            <input type="text" name="nama_paket" value="{{ $paket->nama_paket }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="kecepatan" class="form-label">Kecepatan</label>
            <input type="text" name="kecepatan" value="{{ $paket->kecepatan }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" value="{{ $paket->harga }}" class="form-control">
        </div>
        <div class="mb-3">
    <label for="deskripsi" class="form-label">Deskripsi Paket</label>
    <textarea name="deskripsi" class="form-control" rows="4">{{ $paket->deskripsi }}</textarea>
</div>


        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
