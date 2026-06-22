@extends('admin.layouts.app')
@section('title', 'Kelola Music Player')
@section('content')
<div class="panel-card">
    <div class="panel-header">
        <h2 class="panel-title">Daftar Lagu</h2>
        <a href="{{ route('admin.music.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Lagu</a>
    </div>
    <div class="panel-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul Lagu</th>
                    <th>Penyanyi / Artis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($music_tracks as $item)
                <tr>
                    <td>
                        @if($item->cover_image)
                            <img src="{{ Storage::url($item->cover_image) }}" alt="Cover" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                        @else
                            <div style="width: 50px; height: 50px; background: #eee; border-radius: 5px; display: flex; align-items: center; justify-content: center;"><i class="fas fa-music text-muted"></i></div>
                        @endif
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->artist }}</td>
                    <td>
                        <a href="{{ route('admin.music.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.music.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus lagu ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection