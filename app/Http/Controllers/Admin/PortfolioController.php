<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index() {
        $items = Portfolio::orderBy('id', 'desc')->paginate(10);
        return view('admin.portfolio.index', compact('items'));
    }
    public function create() {
        return view('admin.portfolio.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|string|max:255',
            'project_link' => 'nullable|url|max:255',
            'image' => 'required|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = 'assets/img/portfolio/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/portfolio'), $request->file('image')->getClientOriginalName());
        }
        Portfolio::create($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
    }
    public function edit(Portfolio $portfolio) {
        return view('admin.portfolio.edit', ['item' => $portfolio]);
    }
    public function update(Request $request, Portfolio $portfolio) {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'tech_stack' => 'nullable|string|max:255',
            'project_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = 'assets/img/portfolio/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('assets/img/portfolio'), $request->file('image')->getClientOriginalName());
        }
        $portfolio->update($data);
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }
    public function destroy(Portfolio $portfolio) {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Portofolio dihapus.');
    }
}