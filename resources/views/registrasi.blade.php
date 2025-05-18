@extends('layout.nosidebar')
@section('content')
    <div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <div class="judul">
                <h1>Hai Cust,</h1>
                <h4>Lengkapi seluruh informasi dibawah untuk mendapatkan layanan dari kami!</h4>
            </div>
        </div>
    </div>

<div class="card mb-3">
    <div class="card-body">
        <div class="header-data-diri">
            <h4><b>Data Diri</b></h4>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }} 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif 
            @if ($errors->any())
                <div class="alert alert-danger">    
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle-fill"></i> 
                Semua data ini wajib diisi untuk kebutuhan proses pemesanan kamu.
            </div>    
        </div>

    <form action="{{ route('registrasi.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="no_hp" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" name="alamat" required>
        </div>

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" name="nik" required>
        </div>

        <div class="mb-3">
            <label for="kebutuhan" class="form-label">Kebutuhan</label>
            <select class="form-select" name="kebutuhan" required>
                <option value="">Pilih Kebutuhan</option>
                <option value="Perumahan">Perumahan</option>
                <option value="Kantor">Kantor</option>
                <option value="Sekolah">Sekolah</option>
                <option value="Hotel">Hotel</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_pemasangan" class="form-label">Tanggal Pemasangan</label>
            <input type="date" class="form-control" name="tanggal_pemasangan" required>
        </div>

        
        <div class="mb-3">
            <label for="total" class="form-label">Total Harga</label>
            <input type="text" class="form-control" name="total" required>
        </div>

        
        <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <select class="form-select" name="provinsi_id" id="provinsi" required>
                <option value="">Pilih Provinsi</option>
                @foreach ($prov as $provinsi)
                    <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                @endforeach
            </select>
        </div>

        
        <!-- <div class="mb-3">
            <label for="kabupaten" class="form-label">Kabupaten</label>
            <select class="form-select" name="kabupaten_id" id="kabupaten">
                <option value="">Pilih Kabupaten</option>
            </select>
        </div>

        
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <select class="form-select" name="kecamatan_id" id="kecamatan">
                <option value="">Pilih Kecamatan</option>
            </select>
        </div> -->

        
        <div class="mb-3">
            <label for="paket_wifi_id" class="form-label">Paket Wifi</label>
            <select class="form-select" name="paket_wifi_id" required>
                <option value="">Pilih Paket</option>
                @foreach ($paket as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }} (Rp{{ number_format($p->harga) }})</option>
                @endforeach
            </select>
        </div>

       
        <div class="mb-3">
            <label for="payment_method_id" class="form-label">Metode Pembayaran</label>
            <select class="form-select" name="payment_method_id" required>
                <option value="">Pilih Metode</option>
                @foreach ($paymentMethods as $method)
                    <option value="{{ $method->id }}">{{ $method->nama_metode }}</option>
                @endforeach
            </select>
        </div>

        
        <div class="mb-3">
            <label for="ktp_file" class="form-label">Upload KTP</label>
            <input type="file" class="form-control" name="ktp_file" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<!-- <script>
 $(document).ready(function() {
    $('#provinsi').on('change', function () {
        const provinsiId = $(this).val();
        $('#kabupaten').prop('disabled', true);
        $('#kecamatan').prop('disabled', true);

        if (provinsiId) {
            $.get('/get-kabupaten/' + provinsiId, function (data) {
                $('#kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
                $.each(data, function (key, value) {
                    $('#kabupaten').append(`<option value="${value.id}">${value.nama}</option>`);
                });
                $('#kabupaten').prop('disabled', false);
            });
        }
    });

    $('#kabupaten').change(function() {
        var kabupaten_id = $(this).val();
        if(kabupaten_id) {
            $.ajax({
                url: '/get-kecamatan/' + kabupaten_id,
                type: 'GET',
                success: function(data) {
                    $('#kecamatan').html('<option value="">Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#kecamatan').append('<option value="'+value.id+'">'+value.nama+'</option>');
                    });
                    $('#kecamatan').prop('disabled', false);
                }
            });
        } else {
            $('#kecamatan').prop('disabled', true);
        }
    });
});
</script> -->

<script>
    document.getElementById('provinsi').addEventListener('change', function () {
        const provId = this.value;
        const kabSelect = document.getElementById('kabupaten');
        const kecSelect = document.getElementById('kecamatan');

        kabSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (provId) {
            fetch(`/get-kabupaten/${provId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(kabupaten => {
                        const option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.name;
                        kabSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching kabupaten:', error));
        }
    });

    document.getElementById('kabupaten').addEventListener('change', function () {
        const kabId = this.value;
        const kecSelect = document.getElementById('kecamatan');

        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (kabId) {
            fetch(`/get-kecamatan/${kabId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.name;
                        kecSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching kecamatan:', error));
        }
    });
</script>
@endsection