<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    @vite('resources/css/app.css') <!-- Link to Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 shadow-md rounded-md">
        <h1 class="text-2xl font-bold text-center mb-6">Edit Product</h1>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Product ID -->
            <div>
                <label for="product_id" class="block text-sm font-medium text-gray-700">Product ID:</label>
                <input 
                    type="text" 
                    name="product_id" 
                    value="{{ old('product_id', $product->product_id) }}" 
                    required 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $product->name) }}" 
                    required 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea 
                    name="description" 
                    required 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input 
                    type="number" 
                    step="0.01" 
                    name="price" 
                    value="{{ old('price', $product->price) }}" 
                    required 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Stock -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                <input 
                    type="number" 
                    name="stock" 
                    value="{{ old('stock', $product->stock) }}" 
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <!-- Show existing image -->
                @if ($product->image)
                    <div class="mb-4">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="Product Image" 
                            class="w-32 h-32 object-cover rounded-md shadow-md"
                        >
                    </div>
                @endif
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Update Product
            </button>
        </form>
    </div>
</body>
</html>
