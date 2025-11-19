<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    // Display all sizes and the create form
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    // Show form to create new size (optional if using same page)
    public function create()
    {
        return view('admin.size.index'); // Redirects to same page
    }

    // Store new size
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sizes,name|max:255',
        ]);

        Size::create([
            'name' => $request->name,
        ]);

        return redirect()->route('sizes.index')->with('success', 'Size created successfully.');
    }

    // Show edit form
    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
    }

    // Update size
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|unique:sizes,name,' . $size->id . '|max:255',
        ]);

        $size->update([
            'name' => $request->name,
        ]);

        return redirect()->route('sizes.index')->with('success', 'Size updated successfully.');
    }

    // Delete size
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('sizes.index')->with('success', 'Size deleted successfully.');
    }

    // Optional: show single size
  
}
