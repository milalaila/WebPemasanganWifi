@extends('layout.main')

@section('content')
<div class="container">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Metode Pembayaran</h5>
                        
                        <div class="d-flex align-items-center gap-2">
                            @if(auth()->user()->role == 'admin')
                            <button type="button" class="btn btn-primary btn-sm rounded-pill" style="background-color: #344767" data-bs-toggle="modal" data-bs-target="#tambahMetodeModal">
                                <i class="bi bi-plus"></i>
                                <span class="d-none d-md-inline">Tambah</span>
                            </button>
                            @endif
                        </div>
                    </div>                        
                </div>
            </div>
        <div class="card">
        <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="table-responsive">
                 <table class="table table-striped ">
                    <thead style="text-align: center">
                        <tr>
                            <th>No</th>
                            <th>Nama Metode</th>
                            <th>Tipe</th>
                            <th>Nomor</th>
                            <th>Atas Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="text-align:center">
                        @foreach($methods as $method)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $method->nama_metode }}</td>
                                <td>{{ ucfirst($method->tipe) }}</td>
                                <td>{{ $method->nomor }}</td>
                                <td>{{ $method->atas_nama }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMetodeModal{{ $method->id }}">
                                        <i class="bi bi-pen"></i>
                                    </button> 
                                    <form action="{{ route('payment-methods.destroy', $method->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Modal Tambah Metode -->
<div class="modal fade" id="tambahMetodeModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('payment-methods.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="tambahMetodeModalLabel">Tambah Metode Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Metode</label>
                    <input type="text" name="nama_metode" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipe</label>
                    <select name="tipe" class="form-select" required>
                        <option value="ewallet">E-wallet</option>
                        <option value="bank">Bank</option>
                        <option value="cod">COD</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor</label>
                    <input type="text" name="nomor" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Atas Nama</label>
                    <input type="text" name="atas_nama" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div> 

                @foreach($methods as $metode)
                <div class="modal fade" id="editMetodeModal{{ $metode->id }}" tabindex="-1" aria-labelledby="editMetodeModalLabel{{ $metode->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editMetodeModalLabel{{ $metode->id }}">Form Edit Metode Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('payment_methods.update', $metode->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Nama Metode</label>
                                        <input type="text" name="nama_metode" class="form-control" value="{{ $method->nama_metode }}" required>
                                    </div>
                        
                                    <div class="mb-3">
                                        <label>Tipe</label>
                                        <select name="tipe" class="form-control" required>
                                            <option value="cod" {{ $method->tipe == 'cod' ? 'selected' : '' }}>COD</option>
                                            <option value="bank" {{ $method->tipe == 'bank' ? 'selected' : '' }}>Bank</option>
                                            <option value="ewallet" {{ $method->tipe == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="qris" {{ $method->tipe == 'qris' ? 'selected' : '' }}>QRIS</option>
                                        </select>
                                    </div>
                        
                                    <div class="mb-3">
                                        <label>Nomor / QR Code</label>
                                        <input type="text" name="nomor" class="form-control" value="{{ $method->nomor }}">
                                    </div>
                        
                                    <div class="mb-3">
                                        <label>Atas Nama</label>
                                        <input type="text" name="atas_nama" class="form-control" value="{{ $method->atas_nama }}">
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
@endsection
