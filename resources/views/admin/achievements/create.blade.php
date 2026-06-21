@extends('admin.layouts.app')
@section('title', 'Tambah Prestasi')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.achievements.store') }}" enctype="multipart/form-data">
@csrf
<div class="form-group"><label>Judul</label><input type="text" name="title" required class="form-control"></div>
<div class="form-group"><label>Tahun</label><input type="number" name="year" required class="form-control"></div>
<div class="form-group"><label>Deskripsi</label><textarea name="description" required class="form-control"></textarea></div>
<x-drag-drop-upload name="image" label="Gambar (Opsional)" />
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.achievements.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection