@extends('layout.main')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Daftar Provinsi</h2>
        <div>
            <!-- Tombol Tambah Provinsi -->
            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#modalTambahProvinsi">
                + Tambah Provinsi
            </button>

            <!-- Dropdown Pilih Wilayah -->
            <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Pilih Wilayah
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/provinsi">Provinsi</a></li>
                    <li><a class="dropdown-item" href="/kabupaten/">Kabupaten</a></li>
                    <li><a class="dropdown-item" href="/kecamatan/1">Kecamatan</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Provinsi</th>
                        <th>Aksi</th> <!-- Kolom untuk Aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($provinsis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>

                        <!-- Kolom Aksi -->
                        <td>
                            <!-- Tombol Edit -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProvinsi{{ $item->id }}">
                                Edit
                            </button>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('provinsi.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal Tambah Provinsi -->
    <div class="modal fade" id="modalTambahProvinsi" tabindex="-1" aria-labelledby="modalTambahProvinsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('provinsi.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Provinsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="provinsiName" class="form-label">Nama Provinsi</label>
                            <input type="text" name="name" id="provinsiName" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Provinsi -->
    @foreach($provinsis as $provinsi)
    <div class="modal fade" id="modalEditProvinsi{{ $provinsi->id }}" tabindex="-1" aria-labelledby="modalEditProvinsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('provinsi.update', $provinsi->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Provinsi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="provinsiNameEdit" class="form-label">Nama Provinsi</label>
                            <input type="text" name="name" id="provinsiNameEdit" class="form-control" value="{{ $provinsi->name }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
