<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
 
    public function index(Request $request)
    {
        // Retrieve search input
        $search = $request->input('search');
        $sort = $request->input('sort', 'name'); // Default sorting column is 'name'
        $direction = $request->input('direction', 'asc'); // Default sorting direction is ascending
    
        // Query builder with optional search functionality
        $query = Product::query();
    
        // Apply search filter if a search term is provided
        if ($search) {
            $query->where('product_id', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }
    
        // Apply sorting
        $query->orderBy($sort, $direction);
    
        // Paginate the results
        $products = $query->paginate(10);
    
        // Pass the filtered, sorted, and paginated products to the view
        return view('products.index', compact('products'));
    }
    

public function create()
{
    return view('products.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'product_id' => 'required|unique:products',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'image' => 'required|string|max:255',
    ]);

    Product::create($validated);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

public function edit($id)
{
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    $validated = $request->validate([
        'product_id' => 'required|unique:products,product_id,' . $id,
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'image' => 'nullable|string|max:255',
    ]);

    $product->update($validated);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}

public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}

}