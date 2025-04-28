
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
                                        <li><a class="dropdown-item" href="#">Provinsi</a></li>
                                        <li><a class="dropdown-item" href="#">Kabupaten</a></li>
                                        <li><a class="dropdown-item" href="#">Kecamatan</a></li>
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
        <table class="table table-stripped">
        <tr>
            <th>No</th>
            <th>Nama Provinsi</th>
            <th>Nama Kabupaten</th>
            <th>Aksi</th>
        </tr>
        @foreach($kabupatens as $item)
        <tr>
    <td>{{ $loop->iteration}}</td>
    <td>{{ $item->provinsi->name }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <a href="{{ route('kabupaten.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

        <form action="{{ route('kabupaten.delete', $item->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
        </form>
    </td>
</tr>

        @endforeach
    </table>    
        </div>
    </div>



    <div class="modal fade" id="tambahKabModal" tabindex="-1" aria-labelledby="tambahKabModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="tambahKabModalLabel">Tambah Kabupaten</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('kabupaten.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <select class="form-select" name="provinsi_id" required>
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                    @foreach ($provinsi as $item)
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
            </div>
        </form>
    </div>
  </div>
</div>
    
    
@endsection