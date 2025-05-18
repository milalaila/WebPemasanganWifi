@extends('layout.main')
@section('content')
<div class="container">
    <h2>Daftar Kecamatan</h2>
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
                                <button type="button" class="btn btn-primary btn-sm rounded-pill" style="background-color: #344767" data-bs-toggle="modal" data-bs-target="#modalKecamatan">
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
                                    <th style="text-align: center">Nama Kecamatan</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kecamatans as $kecamatan)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td style="text-align: center">{{ $kecamatan->provinsi->name }}</td> 
                                        <td style="text-align: center">{{ $kecamatan->kabupaten->name }}</td> 
                                        <td style="text-align: center">{{ $kecamatan->name }}</td>
                                        <td style="text-align: center">
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditKec{{ $kecamatan->id }}">
                                                <i class="bi bi-pen"></i>
                                            </button>                                            
                                            <form action="{{ route('kecamatan.delete', $kecamatan->id) }}" method="POST" style="display:inline-block;">
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
                <div class="modal fade" id="modalKecamatan" tabindex="-1" aria-labelledby="modalKecamatanLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('kecamatan.store') }}">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Kecamatan</h5>
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
                                        <label for="kabupaten_id" class="form-label">Kabupaten</label>
                                        <select name="kabupaten_id" id="kabupaten_id" class="form-control" required>
                                          <option value="">Pilih Kabupaten</option>
                                          @foreach($kabupatens as $kabupaten)
                                          <option value="{{ $kabupaten->id }}" data-provinsi="{{ $kabupaten->provinsi_id }}">{{ $kabupaten->name }}</option>
                                          @endforeach
                                        </select>
                                    </div>
                            
                                    <div class="mb-3">
                                        <label class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" name="name" placeholder="Masukkan Kecamatan" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const provinsiSelect = document.getElementById('provinsi_id');
                                const kabupatenSelect = document.getElementById('kabupaten_id');
                        
                                provinsiSelect.addEventListener('change', function () {
                                    const selectedProvinsi = this.value;
                        
                                    Array.from(kabupatenSelect.options).forEach(option => {
                                        if (!option.value) return; 
                                        const provinsiId = option.getAttribute('data-provinsi');
                                        option.style.display = (provinsiId === selectedProvinsi) ? 'block' : 'none';
                                    });
                        
                                    kabupatenSelect.value = ""; 
                                });
                            });
                        </script>
                    </div>
                </div>

                <!-- Modal Edit Kecamatan -->
                @foreach($kecamatans as $kecamatan)
                <div class="modal fade" id="modalEditKec{{ $kecamatan->id }}" tabindex="-1" aria-labelledby="modalEditKecamatanLabel{{ $kecamatan->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditKecamatanLabel{{ $kecamatan->id }}">Form Edit Kecamatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Provinsi</label>
                                        <select class="form-select" name="provinsi_id" required>
                                            <option value="" disabled>Pilih Provinsi</option>
                                            @foreach ($provinsis as $p)
                                                <option value="{{ $p->id }}" {{ $p->id == $kecamatan->prov_id ? 'selected' : '' }}>
                                                    {{ $p->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>       

                                    <div class="mb-3">
                                        <label class="form-label">Kabupaten</label>
                                        <select class="form-select" name="kabupaten_id" required>
                                            <option value="" disabled>Pilih Kabupaten</option>
                                            @foreach ($kabupatens as $k)
                                                <option value="{{ $k->id }}" {{ $k->id == $kecamatan->kab_id ? 'selected' : '' }}>
                                                    {{ $k->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kecamatan</label>
                                        <input type="text" class="form-control" name="name" value="{{ $kecamatan->name }}" required>
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
