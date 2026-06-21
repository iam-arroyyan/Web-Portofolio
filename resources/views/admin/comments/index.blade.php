@extends('admin.layouts.app')
@section('title', 'Komentar Pengunjung')
@section('content')
<div class="panel-card"><div class="panel-header"><h2>Daftar Komentar</h2></div><div class="panel-body table-responsive">
<table class="admin-table"><thead><tr><th>Nama</th><th>Komentar</th><th>Aksi</th></tr></thead>
<tbody>@foreach($items as $item)
<tr><td>{{ $item->nama }}</td><td>{{ $item->komentar }}</td><td class="table-actions">
<form method="POST" action="{{ route('admin.comments.destroy', $item) }}" class="inline-form" onsubmit="return confirm('Hapus komentar?');">
@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
</td></tr>@endforeach</tbody></table>
{{ $items->links('pagination::bootstrap-4') }}
</div></div>
@endsection