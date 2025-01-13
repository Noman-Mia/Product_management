<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create New Product</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" required>
        <br>

        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>

        <label for="description">Description:</label>
        <textarea name="description"></textarea>
        <br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <br>

        <label for="stock">Stock:</label>
        <input type="number" name="stock">
        <br>

        <label for="image">Image URL:</label>
        <input type="text" name="image" required>
        <br>

        <button type="submit">Create Product</button>
    </form>
</body>
</html>
