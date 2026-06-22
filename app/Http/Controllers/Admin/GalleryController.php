<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index() {
        $items = Gallery::orderBy('id', 'desc')->paginate(10);
        return view('admin.gallery.index', compact('items'));
    }
    public function create() {
        return view('admin.gallery.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'image' => 'required|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAs('gallery', $request->file('image')->getClientOriginalName(), 'public');
        }
        Gallery::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Foto ditambahkan.');
    }
    public function destroy(Gallery $gallery) {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Foto dihapus.');
    }
}