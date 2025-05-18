<!DOCTYPE html>
<html>
<head>
    <title>Edit Metode Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Metode Pembayaran</h2>
        <form action="{{ route('payment_methods.update', $method->id) }}" method="POST">
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

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('payment-methods.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
