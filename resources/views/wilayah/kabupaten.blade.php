@extends('layout.main')
@section('content')
<div class="container">
    <h2>Daftar Kabupaten</h2>
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
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" style="background-color: #344767" data-bs-toggle="modal" data-bs-target="#tambahKabModal">
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
                                    <th style="text-align: center">Nama Kabupaten</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kabupatens as $item)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration}}</td>
                                    <td style="text-align: center">{{ $item->provinsi->name }}</td>
                                    <td style="text-align: center">{{ $item->name }}</td>
                                    <td style="text-align: center">
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editKabModal{{ $item->id }}">
                                            <i class="bi bi-pen"></i>
                                        </button>
                                        <form action="{{ route('kabupaten.delete', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')"><i class="bi bi-trash3"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal Tambah Provinsi -->
                <div class="modal fade" id="tambahKabModal" tabindex="-1" aria-labelledby="tambahKabModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('kabupaten.store') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kabupaten</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-select" name="provinsi_id" required>
                                            <option value="" disabled selected>Pilih Provinsi</option>
                                            @foreach ($provinsis as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label class="form-label">Kabupaten</label>
                                        <input type="text" class="form-control" name="name" placeholder="Masukkan Kabupaten" required>
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
                @foreach($kabupatens as $kab)
                <div class="modal fade" id="editKabModal{{ $kab->id }}" tabindex="-1" aria-labelledby="editKabModalLabel{{ $kab->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editKabModalLabel{{ $kab->id }}">Form Edit kabupaten</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kabupaten.update', $kab->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-select" name="provinsi_id" required>
                                            <option value="" disabled>Pilih Provinsi</option>
                                            @foreach ($provinsis as $p)
                                                <option value="{{ $p->id }}" {{ $p->id == $kab->prov_id ? 'selected' : '' }}>
                                                    {{ $p->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                                                            
                                    <div class="mb-3">
                                        <label class="form-label">Kabupaten</label>
                                        <input type="text" class="form-control" name="name" value="{{ $kab->name }}" required>
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
