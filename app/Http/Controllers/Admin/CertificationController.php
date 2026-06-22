<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificationController extends Controller
{
    public function index() {
        $items = Certification::orderBy('id', 'desc')->paginate(10);
        return view('admin.certifications.index', compact('items'));
    }
    public function create() {
        return view('admin.certifications.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAs('certifications', $request->file('image')->getClientOriginalName(), 'public');
        }
        Certification::create($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }
    public function edit(Certification $certification) {
        return view('admin.certifications.edit', ['item' => $certification]);
    }
    public function update(Request $request, Certification $certification) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->storeAs('certifications', $request->file('image')->getClientOriginalName(), 'public');
        }
        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Sertifikat diperbarui.');
    }
    public function destroy(Certification $certification) {
        $certification->delete();
        return redirect()->route('admin.certifications.index')->with('success', 'Sertifikat dihapus.');
    }
}