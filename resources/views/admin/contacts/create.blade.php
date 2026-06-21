@extends('admin.layouts.app')
@section('title', 'Tambah Kontak')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.contacts.store') }}">
@csrf
<div class="form-group"><label>Platform</label><input type="text" name="platform" required class="form-control"></div>
<div class="form-group"><label>Label</label><input type="text" name="label" required class="form-control"></div>
<div class="form-group"><label>Username</label><input type="text" name="username" required class="form-control"></div>
<div class="form-group"><label>URL</label><input type="url" name="url" required class="form-control"></div>
<div class="form-group"><label>Icon Class (FontAwesome)</label><input type="text" name="icon_class" required class="form-control"></div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection