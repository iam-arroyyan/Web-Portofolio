@extends('admin.layouts.app')
@section('title', 'Pengaturan Website')
@section('content')
<div class="panel-card"><div class="panel-body">
<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
@csrf
<div class="form-group"><label>Nama Lengkap</label><input type="text" name="full_name" value="{{ $settings->full_name ?? '' }}" class="form-control"></div>
<div class="form-group"><label>Sapaan (Greeting)</label><input type="text" name="greeting" value="{{ $settings->greeting ?? '' }}" class="form-control"></div>
<div class="form-group"><label>Tagline</label><input type="text" name="tagline" value="{{ $settings->tagline ?? '' }}" class="form-control"></div>
<div class="form-group"><label>Nama Footer</label><input type="text" name="footer_name" value="{{ $settings->footer_name ?? '' }}" class="form-control"></div>
<div class="form-group"><label>Teks Footer</label><input type="text" name="footer_text" value="{{ $settings->footer_text ?? '' }}" class="form-control"></div>
<x-drag-drop-upload name="profile_image" label="Ganti Foto Profil (Opsional)" :currentImage="$settings->profile_image ?? null" recommendedSize="500x500 px (Rasio 1:1)" />
<button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
</form>
</div></div>
@endsection