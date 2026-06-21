@extends('admin.layouts.app')
@section('title', 'Edit Kontak')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.contacts.update', $item) }}">
@csrf @method('PUT')
<div class="form-group"><label>Platform</label><input type="text" name="platform" value="{{ $item->platform }}" required class="form-control"></div>
<div class="form-group"><label>Label</label><input type="text" name="label" value="{{ $item->label }}" required class="form-control"></div>
<div class="form-group"><label>Username</label><input type="text" name="username" value="{{ $item->username }}" required class="form-control"></div>
<div class="form-group"><label>URL</label><input type="url" name="url" value="{{ $item->url }}" required class="form-control"></div>
<div class="form-group"><label>Icon Class (FontAwesome)</label><input type="text" name="icon_class" value="{{ $item->icon_class }}" required class="form-control"></div>
<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Batal</a>
</form>
</div></div>
@endsection