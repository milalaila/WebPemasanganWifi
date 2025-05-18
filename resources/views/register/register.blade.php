@extends('layout.nosidebar')
@section('content')

<style>
    .alert {
        display: flex;
        text-align: left;
        align-items: center;
        left: 0px; 
    }
    .alert .bi-exclamation-triangle-fill{
        font-size: 20px;
        padding: 0 10px;
    }

    .paket-label {
        cursor: pointer;
        position: relative;
    }

    .paket-label input[type="radio"] {
        display: none; /* Sembunyikan radio button */
    }

    .paket-label .paket-card {
        transition: 0.3s;
        border: 2px solid transparent;
        cursor: pointer;
    }

    .paket-label input[type="radio"]:checked + .paket-card {
        border: 2px solid #007bff; /* Highlight border biru saat dipilih */
        background-color: #f8f9fa; /* Warna latar lebih terang */
    }



</style>
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
        <div class="form-data-diri">
            <form action="{{ route('registrasi.submit')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="mb-3">
                    <label for="">Nama Lengkap*</label>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap kamu">
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="">Nomor Handphone*</label>
                        <input type="number" class="form-control" name="no_hp" placeholder="Masukkan nomor aktif WhatsApp kamu">
                        <small class="text-muted">Pastikan nomor yang dimasukkan aktif WhatsApp</small>
                    </div>
                
                    <div class="col-md-6">
                        <label for="">Email*</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email kamu">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">NIK*</label>
                    <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK kamu">
                    <small class="text-muted">Pastikan NIK yang dimasukkan terdaftar resmi</small>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto KTP*</label>
                    <input class="form-control" type="file" id="formFile" name="ktp_file">
                    <small class="text-muted">Gunakan KTP asli dan jelas untuk verifikasi identitas. Tenang data kamu aman ko!</small>
                </div>
                <div class="label-paket">
                    <label for="">Pilih Paket Wifi*</label>
                    <div class="d-flex flex-wrap gap-4">
                        @foreach ($paket as $item)
                            <label class="paket-label">
                                <input type="radio" name="paket_wifi_id" value="{{ $item->id }}" class="paket-radio" data-harga="{{ $item->harga }}">
                                <div class="card paket-card">
                                    <div class="card-body">
                                        <div class="icon mb-3"><i class="bi bi-wifi fs-1 text-primary"></i></div>
                                        <h5 class="card-title">{{ $item->nama }}</h5>
                                        <p class="card-text">
                                            <strong>Kecepatan:</strong> {{ $item->kecepatan }}<br>
                                            {{ $item->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>       
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
                    <label for="provinsi" class="form-label">Provinsi</label>
                    <select class="form-select" name="provinsi_id" id="provinsi" required>
                        <option value="">Pilih Provinsi</option>
                        @foreach ($prov as $provinsi)
                            <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                
                <div class="mb-3">
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
                </div> 
                
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap*</label>
                    <textarea id="alamat" name="alamat" class="form-control"></textarea>
                </div>
                {{-- <div class="form-group">
                    <label>Lokasi (GPS)</label>
                    <div class="input-group">
                        <input type="text" id="latitude" name="latitude" class="form-control" placeholder="Latitude" readonly>
                        <input type="text" id="longitude" name="longitude" class="form-control" placeholder="Longitude" readonly>
                        <button type="button" class="btn btn-primary" onclick="getLocation()">Ambil Lokasi</button>
                    </div>
                </div>                 --}}
                <div class="form-group">
                    <label for="kebutuhan">Kebutuhan*</label>
                    <select id="kebutuhan" name="kebutuhan" class="form-control">
                        <option value="">Pilih Kebutuhan</option>
                        <option value="Perumahan">Perumahan</option>
                        <option value="Kantor">Kantor</option>
                        <option value="Sekolah">Sekolah</option>
                        <option value="Hotel">Hotel</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Rencana Tanggal Pemasangan*</label>
                    <input type="date" class="form-control" name="tanggal_pemasangan" placeholder="Masukkan Tanggal rencana pemasangan">
                </div>
                <div class="form-group">
                    <label for="total">Total Harga (Bulan Pertama)</label>
                    <input type="number" id="total_harga" name="total" class="form-control" readonly>
                    <p id="total_harga_display" style="margin-top: 5px; font-weight: bold;"></p>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>                                 
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.paket-label input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.paket-card').forEach(card => {
                card.classList.remove('selected');
            });
            this.nextElementSibling.classList.add('selected'); 
        });
    });

    document.getElementById('provinsi').addEventListener('change', function () {
        let provId = this.value;
        let kabSelect = document.getElementById('kabupaten');
        let kecSelect = document.getElementById('kecamatan');

        kabSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (provId) {
            fetch(`/get-kabupaten/${provId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(kabupaten => {
                        let option = document.createElement('option');
                        option.value = kabupaten.id;
                        option.textContent = kabupaten.name;
                        kabSelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('kabupaten').addEventListener('change', function () {
        let kabId = this.value;
        let kecSelect = document.getElementById('kecamatan');

        kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

        if (kabId) {
            fetch(`/get-kecamatan/${kabId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(kecamatan => {
                        let option = document.createElement('option');
                        option.value = kecamatan.id;
                        option.textContent = kecamatan.name;
                        kecSelect.appendChild(option);
                    });
                });
        }
    });

    document.querySelectorAll('.paket-radio').forEach(radio => {
        radio.addEventListener('change', function () {
            let harga = this.getAttribute('data-harga'); 

            if (harga) {
                document.getElementById('total_harga').value = harga; // Simpan angka asli
                document.getElementById('total_harga_display').textContent = formatRupiah(harga); // Tampilkan format rupiah
            } else {
                document.getElementById('total_harga').value = '';
                document.getElementById('total_harga_display').textContent = '';
            }
        });
    });

    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
        } else {
            alert("Geolocation tidak didukung di browser ini.");
        }
    }

    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("Izinkan akses lokasi untuk mengambil GPS!");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Informasi lokasi tidak tersedia.");
                break;
            case error.TIMEOUT:
                alert("Permintaan lokasi melebihi batas waktu.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Terjadi kesalahan yang tidak diketahui.");
                break;
        }
    }

    function previewKTP(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewKTPImage');

        if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        } else {
        preview.src = '#';
        preview.style.display = 'none';
        }
    }
</script>

@endsection