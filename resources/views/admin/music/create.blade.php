@extends('admin.layouts.app')
@section('title', 'Tambah Lagu Baru')
@section('content')
<div class="panel-card">
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.music.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Judul Lagu <span class="text-danger">*</span></label>
                <input type="text" name="title" required class="form-control" placeholder="Contoh: Tak Segampang Itu">
            </div>
            <div class="form-group">
                <label>Penyanyi / Artis <span class="text-danger">*</span></label>
                <input type="text" name="artist" required class="form-control" placeholder="Contoh: Anggi Marito">
            </div>
            
            <x-drag-drop-upload 
                name="audio_file" 
                label="File Audio" 
                accept="audio/*" 
                formatText="Disarankan menggunakan format <strong>.mp3</strong> atau <strong>.wav</strong>. (Maks 20MB)"
                icon="fa-music" 
                :required="true"
            />

            <x-drag-drop-upload name="cover_image" label="Cover Image (Opsional)" recommendedSize="300x300 px (Rasio 1:1)" />

            <button type="submit" class="btn btn-primary">Simpan Lagu</button>
            <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection