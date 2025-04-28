@extends('layout.main')

@section('content')
<div class="container">
    <h1>Kecamatan di Kabupaten</h1>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalKecamatan">Tambah Kecamatan</button>
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
            <th>No</th>
            <th>Nama Kecamatan</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kecamatans as $kecamatan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kecamatan->name }}</td>
            <td>{{ $kecamatan->provinsi->name }}</td> 
            <td>{{ $kecamatan->kabupaten->name }}</td> 
            <td>
                <a href="{{ route('kecamatan.edit', $kecamatan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('kecamatan.delete', $kecamatan->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    


<!-- Modal -->
<div class="modal fade" id="modalKecamatan" tabindex="-1" aria-labelledby="modalKecamatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('kecamatan.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        
        <div class="modal-body">
          
          <div class="mb-3">
            <label for="provinsi_id" class="form-label">Provinsi</label>
            <select name="provinsi_id" id="provinsi_id" class="form-control" required>
              <option value="">Pilih Provinsi</option>
              @foreach($provinsis as $provinsi)
              <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
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
            <label for="name" class="form-label">Nama Kecamatan</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
    <!-- JavaScript-nya di sini -->
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

@endsection
