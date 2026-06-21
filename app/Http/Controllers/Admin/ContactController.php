<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        // contacts don't have created_at
        $items = Contact::orderBy('id', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('items'));
    }
    public function create() {
        return view('admin.contacts.create');
    }
    public function store(Request $request) {
        $data = $request->validate([
            'platform' => 'required|string|unique:contacts,platform',
            'label' => 'required|string',
            'username' => 'required|string',
            'url' => 'required|string',
            'icon_class' => 'required|string'
        ]);
        Contact::create($data);
        return redirect()->route('admin.contacts.index')->with('success', 'Kontak ditambahkan.');
    }
    public function edit(Contact $contact) {
        return view('admin.contacts.edit', ['item' => $contact]);
    }
    public function update(Request $request, Contact $contact) {
        $data = $request->validate([
            'platform' => 'required|string|unique:contacts,platform,' . $contact->id,
            'label' => 'required|string',
            'username' => 'required|string',
            'url' => 'required|string',
            'icon_class' => 'required|string'
        ]);
        $contact->update($data);
        return redirect()->route('admin.contacts.index')->with('success', 'Kontak diperbarui.');
    }
    public function destroy(Contact $contact) {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Kontak dihapus.');
    }
}