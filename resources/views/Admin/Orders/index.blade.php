@extends('layouts.master')

@section('content')
    <h1>Orders</h1>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Add New Order</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Status</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->First_name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>
                        <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
