<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index() {
        $items = Achievement::orderBy('id', 'desc')->paginate(10);
        return view('admin.achievements.index', compact('items'));
    }
    public function create() {
        return view('admin.achievements.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = 'assets/img/achievements/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/achievements'), $request->file('image')->getClientOriginalName());
        }
        Achievement::create($data);
        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi ditambahkan.');
    }
    public function edit(Achievement $achievement) {
        return view('admin.achievements.edit', ['item' => $achievement]);
    }
    public function update(Request $request, Achievement $achievement) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = 'assets/img/achievements/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/achievements'), $request->file('image')->getClientOriginalName());
        }
        $achievement->update($data);
        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi diperbarui.');
    }
    public function destroy(Achievement $achievement) {
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi dihapus.');
    }
}