<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <h1>Product List</h1>


    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <!-- Search Form -->
    <form action="{{ route('products.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Product ID or Description">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr>
                <!-- Sorting Links -->
                <th>
                    <a href="{{ route('products.index', ['sort' => 'product_id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                        Product ID
                        @if (request('sort') === 'product_id')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                        Name
                        @if (request('sort') === 'name')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>Description</th>
                <th>
                    <a href="{{ route('products.index', ['sort' => 'price', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc', 'search' => request('search')]) }}">
                        Price
                        @if (request('sort') === 'price')
                            {{ request('direction') === 'asc' ? '↑' : '↓' }}
                        @endif
                    </a>
                </th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                        <a href="{{ route('products.create') }}">Create New Product</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $products->appends(['sort' => request('sort'), 'direction' => request('direction'), 'search' => request('search')])->links() }}
</body>
</html>
