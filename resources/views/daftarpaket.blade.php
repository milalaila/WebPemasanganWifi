@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Paket Wifi</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahPaketModal">Tambah Data</button>
</div>

<!-- Tambahkan class z-index agar daftar paket tidak tertutup -->
<div class="row" style="position: relative; z-index: 1;">
    @foreach ($pakets as $paket)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0" style="background-color: #f9f9f9; border-left: 5px solid #007bff;">
                <div class="card-body">
                    <h4 class="card-title text-primary">{{ $paket->nama_paket }}</h4>
                    <p class="card-text"><strong>Kecepatan:</strong> {{ $paket->kecepatan }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>

                    <div class="d-flex gap-2 mt-3">
                        <!-- Modal Detail Button -->
                        <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $paket->id }}">Detail</button>

                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#editModal{{ $paket->id }}">Edit</button>

                        <form action="{{ route('paketwifi.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Yakin mau dihapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Modal Tambah Data -->
<div class="modal fade" id="tambahPaketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="tambahPaketModalLabel">Tambah Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('paketwifi.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
                    </div>

                    <div class="mb-3">
                        <label for="kecepatan" class="form-label">Kecepatan</label>
                        <input type="text" class="form-control" id="kecepatan" name="kecepatan" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga per Bulan</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Paket</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Paket -->
@foreach($pakets as $paket)
<div class="modal fade" id="editModal{{ $paket->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $paket->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="editModalLabel{{ $paket->id }}">Edit Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('paketwifi.update', $paket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_paket" class="form-label">Nama Paket</label>
                        <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kecepatan" class="form-label">Kecepatan</label>
                        <input type="text" name="kecepatan" class="form-control" value="{{ $paket->kecepatan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Paket</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $paket->deskripsi }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail Paket -->
<div class="modal fade" id="detailModal{{ $paket->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $paket->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $paket->id }}">Detail Paket: {{ $paket->nama_paket }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>{{ $paket->nama_paket }}</h4>
                <p><strong>Kecepatan:</strong> {{ $paket->kecepatan }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($paket->harga, 0, ',', '.') }}</p>
                <p><strong>Deskripsi:</strong> {{ $paket->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection
