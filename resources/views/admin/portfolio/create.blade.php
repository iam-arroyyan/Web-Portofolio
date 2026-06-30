@extends('admin.layouts.app')
@section('title', 'Tambah Portofolio')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.portfolio.store') }}" enctype="multipart/form-data">
@csrf
<div class="form-group"><label>Judul</label><input type="text" name="title" required class="form-control"></div>
<div class="form-group"><label>Deskripsi</label><textarea name="description" required class="form-control"></textarea></div>
<div class="form-group"><label>Tech Stack</label><input type="text" name="tech_stack" class="form-control"></div>
<div class="form-group"><label>Link URL</label><input type="url" name="project_link" class="form-control"></div>
<x-drag-drop-upload name="image" label="Gambar" :required="true" />
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.portfolio.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection