<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    @vite('resources/css/app.css') <!-- Link Tailwind CSS -->
</head>
<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold text-center mb-6">Product List</h1>

        <!-- Success and Error Messages -->
        @if(session('success'))
            <p class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-4">
                {{ session('success') }}
            </p>
        @endif

        @if(session('error'))
            <p class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-4">
                {{ session('error') }}
            </p>
        @endif

        <!-- Search Form -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-6">
            <div class="flex items-center gap-2">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by Product ID or Description" 
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                >
                    Search
                </button>
            </div>
        </form>

        <div class="flex justify-between items-center mb-6">
          
        
            <!-- Create New Product Button -->
            <a 
                href="{{ route('products.create') }}" 
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
            >
                Create New Product
            </a>
        </div>
        
        <!-- Product Table -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 text-left">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border border-gray-300">
                            <a href="{{ route('products.index', ['sort' => 'product_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="hover:underline">
                                Product ID
                                @if (request('sort') === 'product_id')
                                    {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                @endif
                            </a>
                        </th>
                        <th class="p-3 border border-gray-300">
                            <a href="{{ route('products.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="hover:underline">
                                Name
                                @if (request('sort') === 'name')
                                    {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                @endif
                            </a>
                        </th>
                        <th class="p-3 border border-gray-300">Description</th>
                        <th class="p-3 border border-gray-300">
                            <a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}" class="hover:underline">
                                Price
                                @if (request('sort') === 'price')
                                    {{ request('direction') === 'asc' ? '↑' : '↓' }}
                                @endif
                            </a>
                        </th>
                        <th class="p-3 border border-gray-300">Stock</th>
                        <th class="p-3 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="p-3 border border-gray-300">{{ $product->product_id }}</td>
                            <td class="p-3 border border-gray-300">{{ $product->name }}</td>
                            <td class="p-3 border border-gray-300">{{ $product->description }}</td>
                            <td class="p-3 border border-gray-300">{{ $product->price }}</td>
                            <td class="p-3 border border-gray-300">{{ $product->stock }}</td>
                            <td class="p-3 border border-gray-300">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-red-500 hover:underline ml-2"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $products->appends(['sort' => request('sort'), 'direction' => request('direction'), 'search' => request('search')])->links() }}
        </div>
    </div>
</body>
</html>
