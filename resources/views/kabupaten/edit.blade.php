@extends('layout.main')

@section('content')
<div class="container">
    <h2>Edit Kabupaten</h2>

    <!-- Form Edit -->
    <form action="{{ route('kabupaten.update', $kabupaten->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kabupaten</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $kabupaten->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="provinsi_id" class="form-label">Provinsi</label>
            <select class="form-select" name="provinsi_id" required>
                @foreach($provinsis as $provinsi)
                    <option value="{{ $provinsi->id }}" {{ $kabupaten->provinsi_id == $provinsi->id ? 'selected' : '' }}>
                        {{ $provinsi->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Kabupaten</button>
    </form>
</div>
@endsection
