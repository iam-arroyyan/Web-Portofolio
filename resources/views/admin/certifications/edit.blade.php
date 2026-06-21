@extends('admin.layouts.app')
@section('title', 'Edit Sertifikat')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.certifications.update', $item) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="form-group"><label>Judul</label><input type="text" name="title" value="{{ $item->title }}" required class="form-control"></div>
<div class="form-group"><label>Deskripsi</label><textarea name="description" required class="form-control">{{ $item->description }}</textarea></div>
<x-drag-drop-upload name="image" label="Ganti Gambar (Opsional)" :currentImage="$item->image" />
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.certifications.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection