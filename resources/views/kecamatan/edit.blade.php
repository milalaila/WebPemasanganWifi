@extends('layout.main')

@section('content')
<div class="container">
    <h1>Edit Kecamatan</h1>

    <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kecamatan</label>
            <input type="text" name="name" class="form-control" value="{{ $kecamatan->name }}" required>
        </div>

        <div class="mb-3">
            <label for="provinsi_id" class="form-label">Provinsi</label>
            <select name="provinsi_id" class="form-control" required>
                @foreach($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}" {{ $kecamatan->provinsi_id == $provinsi->id ? 'selected' : '' }}>
                        {{ $provinsi->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kabupaten_id" class="form-label">Kabupaten</label>
            <select name="kabupaten_id" class="form-control" required>
                @foreach($kabupatens as $kabupaten)
                    <option value="{{ $kabupaten->id }}" {{ $kecamatan->kabupaten_id == $kabupaten->id ? 'selected' : '' }}>
                        {{ $kabupaten->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
