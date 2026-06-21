@extends('admin.layouts.app')
@section('title', 'Edit Portofolio')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.portfolio.update', $item) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="form-group"><label>Judul</label><input type="text" name="title" value="{{ $item->title }}" required class="form-control"></div>
<div class="form-group"><label>Deskripsi</label><textarea name="description" class="form-control">{{ $item->description }}</textarea></div>
<div class="form-group"><label>Tech Stack</label><input type="text" name="tech_stack" value="{{ $item->tech_stack }}" class="form-control"></div>
<div class="form-group"><label>Link URL</label><input type="url" name="project_link" value="{{ $item->project_link }}" class="form-control"></div>
<x-drag-drop-upload name="image" label="Ganti Gambar (Opsional)" :currentImage="$item->image" />
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection