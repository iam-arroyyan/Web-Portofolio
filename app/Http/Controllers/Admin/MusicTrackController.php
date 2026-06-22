<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MusicTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MusicTrackController extends Controller
{
    public function index()
    {
        $music_tracks = MusicTrack::orderBy('id', 'desc')->get();
        return view('admin.music.index', compact('music_tracks'));
    }

    public function create()
    {
        return view('admin.music.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'audio_file' => 'required|file|mimes:mp3,wav,ogg|max:20480',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('audio_file')) {
            $originalName = $request->file('audio_file')->getClientOriginalName();
            $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = time() . '_' . $safeName;
            $request->file('audio_file')->storeAs('audio', $fileName, 'public');
            $validated['audio_file'] = 'assets/audio/' . $fileName;
        }

        if ($request->hasFile('cover_image')) {
            $originalName = $request->file('cover_image')->getClientOriginalName();
            $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = time() . '_' . $safeName;
            $request->file('cover_image')->storeAs('images', $fileName, 'public');
            $validated['cover_image'] = 'assets/img/' . $fileName;
        }

        MusicTrack::create($validated);

        return redirect()->route('admin.music.index')->with('success', 'Lagu berhasil ditambahkan.');
    }

    public function edit(MusicTrack $music)
    {
        return view('admin.music.edit', compact('music'));
    }

    public function update(Request $request, MusicTrack $music)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'audio_file' => 'nullable|file|mimes:mp3,wav,ogg|max:20480',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('audio_file')) {
            if ($music->audio_file && Storage::disk('public')->exists($music->audio_file)) {
                Storage::disk('public')->delete($music->audio_file);
            }
            $originalName = $request->file('audio_file')->getClientOriginalName();
            $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = time() . '_' . $safeName;
            $request->file('audio_file')->storeAs('audio', $fileName, 'public');
            $validated['audio_file'] = 'assets/audio/' . $fileName;
        }

        if ($request->hasFile('cover_image')) {
            if ($music->cover_image && Storage::disk('public')->exists($music->cover_image)) {
                Storage::disk('public')->delete($music->cover_image);
            }
            $originalName = $request->file('cover_image')->getClientOriginalName();
            $safeName = preg_replace('/[^A-Za-z0-9_\-\.]/', '_', $originalName);
            $fileName = time() . '_' . $safeName;
            $request->file('cover_image')->storeAs('images', $fileName, 'public');
            $validated['cover_image'] = 'assets/img/' . $fileName;
        }

        $music->update($validated);

        return redirect()->route('admin.music.index')->with('success', 'Lagu berhasil diperbarui.');
    }

    public function destroy(MusicTrack $music)
    {
        if ($music->audio_file && Storage::disk('public')->exists($music->audio_file)) {
                Storage::disk('public')->delete($music->audio_file);
            }
        if ($music->cover_image && Storage::disk('public')->exists($music->cover_image)) {
                Storage::disk('public')->delete($music->cover_image);
            }
        $music->delete();
        return redirect()->route('admin.music.index')->with('success', 'Lagu berhasil dihapus.');
    }
}