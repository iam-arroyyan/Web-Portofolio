@extends('admin.layouts.app')
@section('title', 'Kontak / Sosial Media')
@section('content')
<div class="page-actions"><a href="{{ route('admin.contacts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kontak</a></div>
<div class="panel-card"><div class="panel-header"><h2>Daftar Kontak</h2></div><div class="panel-body table-responsive">
<table class="admin-table"><thead><tr><th>Platform</th><th>Label</th><th>Username</th><th>Aksi</th></tr></thead>
<tbody>@foreach($items as $item)
<tr><td>{{ $item->platform }}</td><td>{{ $item->label }}</td><td>{{ $item->username }}</td><td class="table-actions">
<a href="{{ route('admin.contacts.edit', $item) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
<form method="POST" action="{{ route('admin.contacts.destroy', $item) }}" class="inline-form" onsubmit="return confirm('Hapus?');">
@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
</td></tr>@endforeach</tbody></table>
{{ $items->links('pagination::bootstrap-4') }}
</div></div>
@endsection