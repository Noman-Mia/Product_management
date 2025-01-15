<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Product Details</h1>

        <div class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
            <p><strong>Product ID:</strong> {{ $product->product_id }}</p>
            <p><strong>Name:</strong> {{ $product->name }}</p>
            <p><strong>Description:</strong> {{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
            <p><strong>Stock:</strong> {{ $product->stock }}</p>

            @if ($product->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded mt-4">
            @else
                <p><strong>Image:</strong> No Image Available</p>
            @endif

            <div class="mt-6">
                <a href="{{ route('products.index') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Back to Product List
                </a>
            </div>
        </div>
    </div>
</body>
</html>
