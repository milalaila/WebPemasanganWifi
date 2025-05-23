@extends('layout.main')
@section('content')
<div class="container">
    <h2>Daftar Provinsi</h2>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cakupan Wilayah</h5>
                        <div class="d-flex align-items-center gap-2">
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Wilayah
                                </button>

                                <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{url('/provinsi')}}">Provinsi</a></li>
                                        <li><a class="dropdown-item" href="{{url('/kabupaten')}}">Kabupaten</a></li>
                                        <li><a class="dropdown-item" href="{{url('/kecamatan')}}">Kecamatan</a></li>
                                </ul>
                            </div>
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" style="background-color: #344767" data-bs-toggle="modal" data-bs-target="#modalTambahProvinsi">
                                    <i class="bi bi-plus"></i>
                                    <span class="d-none d-md-inline">Tambah</span>
                                </button>
                        </div>
                    </div>                        
                </div>
            </div>
                <div class="card">
                    <div class="card-body">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Nama Provinsi</th>
                                    <th style="text-align: center">Aksi</th> <!-- Kolom untuk Aksi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($provinsis as $item)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td style="text-align: center">{{ $item->name }}</td>

                                    <!-- Kolom Aksi -->
                                    <td style="text-align: center">
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProvinsi{{ $item->id }}">
                                            <i class="bi bi-pen"></i>
                                        </button>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('provinsi.delete', $item->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash3"></i></button>
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
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditProvinsiLabel{{ $provinsi->id }}">Form Edit Provinsi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('provinsi.update', $provinsi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')                                                           
                                    <div class="mb-3">
                                        <label for="provinsiNameEdit" class="form-label">Nama Provinsi</label>
                                        <input type="text" name="name" id="provinsiNameEdit" class="form-control" value="{{ $provinsi->name }}" required>
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
                @endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
