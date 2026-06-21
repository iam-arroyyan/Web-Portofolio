<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

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
            $data['image'] = 'assets/img/certifications/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/certifications'), $request->file('image')->getClientOriginalName());
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
            $data['image'] = 'assets/img/certifications/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/certifications'), $request->file('image')->getClientOriginalName());
        }
        $certification->update($data);
        return redirect()->route('admin.certifications.index')->with('success', 'Sertifikat diperbarui.');
    }
    public function destroy(Certification $certification) {
        $certification->delete();
        return redirect()->route('admin.certifications.index')->with('success', 'Sertifikat dihapus.');
    }
}