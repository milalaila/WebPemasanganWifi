@extends('layout.main')

@section('content')
<div class="container">
    <h2>Detail Paket: {{ $paket->nama_paket }}</h2>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h4 class="card-title">{{ $paket->nama_paket }}</h4>
            <p class="card-text"><strong>Kecepatan:</strong> {{ $paket->kecepatan }}</p>
            <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $paket->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
           
            <a href="{{ route('paketwifi.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
