@extends('layout.main') {{-- atau 'layouts.app' kalau itu yang kamu pakai --}}

@section('content')
    <h2>Daftar Menunggu Review</h2>

    @if ($pending->isEmpty())
        <div class="alert alert-warning" role="alert">
            Belum ada pendaftaran yang perlu direview.
        </div>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">WhatsApp</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pending as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->whatsapp }}</td>
                        <td>
                            <!-- Terima Form -->
                            <form method="POST" action="/admin/order-review/accept/{{ $item->id }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>

                            <!-- Tolak Form -->
                            <form method="POST" action="/admin/order-review/reject/{{ $item->id }}" class="d-inline">
                                @csrf
                                <input type="text" name="reason" class="form-control mb-2" placeholder="Alasan tolak" required style="max-width: 200px; display: inline-block;">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
