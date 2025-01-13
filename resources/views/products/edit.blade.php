<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" value="{{ $product->product_id }}" required>
        <br>
    
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>
        <br>
    
        <label for="description">Description:</label>
        <textarea name="description">{{ $product->description }}</textarea>
        <br>
    
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" value="{{ $product->price }}" required>
        <br>
    
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}">
        <br>
    
        <label for="image">Image:</label>
        <input type="text" name="image" value="{{ $product->image }}" required>
        <br>
    
        <button type="submit">Update Product</button>
    </form>
    

