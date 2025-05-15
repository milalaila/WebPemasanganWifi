<h2>Diterima</h2>
@foreach ($accepted as $a)
    <p>{{ $a->nama }} - {{ $a->whatsapp }}</p>
@endforeach

<h2>Ditolak</h2>
@foreach ($rejected as $r)
    <p>{{ $r->nama }} - {{ $r->whatsapp }} ({{ $r->reason }})</p>
@endforeach
