@extends('admin.layouts.app')
@section('title', 'Edit Lagu')
@section('content')
<div class="panel-card">
    <div class="panel-body">
        <form method="POST" action="{{ route('admin.music.update', $music->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Judul Lagu <span class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ $music->title }}" required class="form-control">
            </div>
            <div class="form-group">
                <label>Penyanyi / Artis <span class="text-danger">*</span></label>
                <input type="text" name="artist" value="{{ $music->artist }}" required class="form-control">
            </div>
            
            <x-drag-drop-upload 
                name="audio_file" 
                label="Ganti File Audio (Opsional)" 
                accept="audio/*" 
                formatText="Disarankan menggunakan format <strong>.mp3</strong> atau <strong>.wav</strong>. (Maks 20MB)"
                icon="fa-music" 
                :currentFile="$music->audio_file"
            />

            <x-drag-drop-upload name="cover_image" label="Ganti Cover Image (Opsional)" :currentImage="$music->cover_image" recommendedSize="300x300 px (Rasio 1:1)" />

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('admin.music.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection