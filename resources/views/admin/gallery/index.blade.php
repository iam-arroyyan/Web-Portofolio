@extends('admin.layouts.app')
@section('title', 'Galeri')
@section('content')
<div class="page-actions"><a href="{{ route('admin.gallery.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Upload Foto</a></div>
<div class="panel-card"><div class="panel-header"><h2>Daftar Galeri</h2></div><div class="panel-body table-responsive">
<table class="admin-table"><thead><tr><th>ID</th><th>Gambar</th><th>Aksi</th></tr></thead>
<tbody>@foreach($items as $item)
<tr><td>{{ $item->id }}</td><td><img src="{{ asset($item->image) }}" width="50" height="50" style="object-fit:cover;"></td><td class="table-actions">
<form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" class="inline-form" onsubmit="return confirm('Hapus?');">
@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
</td></tr>@endforeach</tbody></table>
{{ $items->links('pagination::bootstrap-4') }}
</div></div>
@endsection