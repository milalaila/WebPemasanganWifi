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
                                <td>{{ $method->nama_metode }}</td>
                                <td>{{ ucfirst($method->tipe) }}</td>
                                <td>{{ $method->nomor }}</td>
                                <td>{{ $method->atas_nama }}</td>
                                <td>
                                    <a href="{{ route('payment-methods.edit', $method->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pen"></i>
                                    </a>
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
@endsection
