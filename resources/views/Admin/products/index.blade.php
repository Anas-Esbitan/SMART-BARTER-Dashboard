@extends('layouts.master')

@section('title', 'Products Management')

@section('content')
<div class="container-fluid px-4">
    <!-- العنوان وزر إضافة منتج -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manage Products</h4>
        <a href="{{ route('admin.create-product') }}" class="btn btn-primary">Add Product</a>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <!-- نموذج البحث -->
            <form action="{{ route('admin.products') }}" method="GET" class="d-flex mt-2">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name..." value="{{ request('search') }}">
                <button class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="card-body">
            @if($products->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Category</th>
                        <th>Owner</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->price }}</td>
                            <td>{{ ucfirst($product->status) }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->user->name }}</td>
                            <td>
                                <a href="{{ route('admin.edit-product', $product->id) }}" class="btn btn-success btn-sm">Edit</a>
                                <form action="{{ route('admin.delete-product', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
            @else
            <p class="text-center">No products found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
