<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Wilayah</title>
    <!-- Tambahkan Link CDN Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">📍 Data Wilayah</h2>

        <!-- Loop untuk setiap Provinsi -->
        @foreach($provinsis as $provinsi)
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    Provinsi: {{ $provinsi->name }}
                </div>
                <div class="card-body">
                    <!-- Loop untuk setiap Kabupaten dalam Provinsi -->
                    @forelse($provinsi->kabupatens as $kabupaten)
                        <div class="mb-3">
                            <h5>Kabupaten: {{ $kabupaten->name }}</h5>
                            <!-- List Kecamatan dalam Kabupaten -->
                            @if ($kabupaten->kecamatans->count())
                                <ul class="list-group">
                                    @foreach($kabupaten->kecamatans as $kecamatan)
                                        <li class="list-group-item">
                                            Kecamatan: {{ $kecamatan->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">Belum ada kecamatan</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted">Belum ada kabupaten</p>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
