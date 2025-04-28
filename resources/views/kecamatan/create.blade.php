@extends('layout.main')

@section('content')
<div class="container">
    <h1>Tambah Kecamatan</h1>

    <form action="{{ route('kecamatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kecamatan</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="provinsi_id" class="form-label">Pilih Provinsi</label>
            <select class="form-control" name="provinsi_id" id="provinsi_id" required>
                <option value="">Pilih Provinsi</option>
                @foreach($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kabupaten_id" class="form-label">Pilih Kabupaten</label>
            <select class="form-control" name="kabupaten_id" id="kabupaten_id" required>
                <option value="">Pilih Kabupaten</option>
                @foreach($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}">{{ $kabupaten->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
