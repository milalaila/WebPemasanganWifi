@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form method="POST" action="/order-review/store" class="container mt-4" style="max-width: 500px;">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No WhatsApp</label>
        <input type="text" name="whatsapp" class="form-control" placeholder="08xxx" required>
    </div>
    <button type="submit" class="btn btn-primary">Kirim</button>
</form>
