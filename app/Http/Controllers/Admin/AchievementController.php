<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $data['image'] = $request->file('image')->storeAs('achievements', $request->file('image')->getClientOriginalName(), 'public');
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
            $data['image'] = $request->file('image')->storeAs('achievements', $request->file('image')->getClientOriginalName(), 'public');
        }
        $achievement->update($data);
        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi diperbarui.');
    }
    public function destroy(Achievement $achievement) {
        $achievement->delete();
        return redirect()->route('admin.achievements.index')->with('success', 'Prestasi dihapus.');
    }
}