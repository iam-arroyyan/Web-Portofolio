@extends('admin.layouts.app')
@section('title', 'Prestasi')
@section('content')
<div class="page-actions"><a href="{{ route('admin.achievements.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Prestasi</a></div>
<div class="panel-card"><div class="panel-header"><h2>Daftar Prestasi</h2></div><div class="panel-body table-responsive">
<table class="admin-table"><thead><tr><th>Judul</th><th>Tahun</th><th>Aksi</th></tr></thead>
<tbody>@foreach($items as $item)
<tr><td>{{ $item->title }}</td><td>{{ $item->year }}</td><td class="table-actions">
<a href="{{ route('admin.achievements.edit', $item) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
<form method="POST" action="{{ route('admin.achievements.destroy', $item) }}" class="inline-form" onsubmit="return confirm('Hapus?');">
@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
</td></tr>@endforeach</tbody></table>
{{ $items->links('pagination::bootstrap-4') }}
</div></div>
@endsection