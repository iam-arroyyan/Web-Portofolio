@extends('admin.layouts.app')
@section('title', 'Upload Galeri')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
@csrf
<x-drag-drop-upload name="image" label="Gambar Foto" :required="true" />
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection