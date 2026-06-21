@extends('admin.layouts.app')
@section('title', 'Portofolio')
@section('content')
<div class="page-actions"><a href="{{ route('admin.portfolio.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Portofolio</a></div>
<div class="panel-card"><div class="panel-header"><h2>Daftar Portofolio</h2></div><div class="panel-body table-responsive">
<table class="admin-table"><thead><tr><th>Judul</th><th>Tech Stack</th><th>Aksi</th></tr></thead>
<tbody>@foreach($items as $item)
<tr><td>{{ $item->title }}</td><td>{{ $item->tech_stack }}</td><td class="table-actions">
<a href="{{ route('admin.portfolio.edit', $item) }}" class="btn btn-sm btn-secondary"><i class="fas fa-pen"></i></a>
<form method="POST" action="{{ route('admin.portfolio.destroy', $item) }}" class="inline-form" onsubmit="return confirm('Hapus?');">
@csrf @method('DELETE')<button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></form>
</td></tr>@endforeach</tbody></table>
{{ $items->links('pagination::bootstrap-4') }}
</div></div>
@endsection