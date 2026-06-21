<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\MusicTrack;
use App\Models\Achievement;
use App\Models\Certification;
use App\Models\Portfolio;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index()
    {
        $siteSettings = SiteSetting::first();
        $musicTracks = MusicTrack::all();
        $achievements = Achievement::orderBy('year', 'desc')->get();
        $certifications = Certification::orderBy('created_at', 'desc')->get();
        $portfolios = Portfolio::orderBy('created_at', 'desc')->get();
        $galleries = Gallery::orderBy('created_at', 'desc')->get();
        $contacts = Contact::all();
        $comments = Comment::orderBy('created_at', 'desc')->get();

        return view('home', compact(
            'siteSettings',
            'musicTracks',
            'achievements',
            'certifications',
            'portfolios',
            'galleries',
            'contacts',
            'comments'
        ));
    }

    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'komentar' => 'required|string',
        ]);

        Comment::create($validated);

        return redirect()->to('/#comments')->with('success', 'Komentar berhasil dikirim!');
    }
}
