<form method="POST" action="{{ url('/wilayah/store') }}">
    @csrf

    <!-- Provinsi -->
    <input type="text" name="provinsi" placeholder="Nama Provinsi">
    <button type="submit">Tambah Provinsi</button>
</form>

<form method="POST" action="{{ url('/wilayah/store') }}">
    @csrf

    <!-- Kabupaten -->
    <select name="provinsi_id">
        @foreach ($provinsis as $provinsi)
            <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
        @endforeach
    </select>
    <input type="text" name="kabupaten" placeholder="Nama Kabupaten">
    <button type="submit">Tambah Kabupaten</button>
</form>

<form method="POST" action="{{ url('/wilayah/store') }}">
    @csrf

    <!-- Kecamatan -->
    <select name="provinsi_id" id="provinsi-select">
        @foreach ($provinsis as $provinsi)
            <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
        @endforeach
    </select>

    <select name="kabupaten_id" id="kabupaten-select"></select>

    <input type="text" name="kecamatan" placeholder="Nama Kecamatan">
    <button type="submit">Tambah Kecamatan</button>
</form>

<script>
document.getElementById('provinsi-select').addEventListener('change', function() {
    let provinsiId = this.value;
    fetch('/get-kabupaten/' + provinsiId)
        .then(response => response.json())
        .then(data => {
            let kabSelect = document.getElementById('kabupaten-select');
            kabSelect.innerHTML = '';
            data.forEach(function(kab) {
                kabSelect.innerHTML += `<option value="${kab.id}">${kab.name}</option>`;
            });
        });
});
</script>
