@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5 text-danger mt-5">Orders</h1>
        <h2 class="text-secondary">Orders</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>TotalPrice</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id}}</td>
                        <td>{{ $order->status}}</td>
                        <td>{{ $order->totalPrice}}</td>
                        <td>
                                <a class="btn btn-info" href="{{ route('orders.show', compact('order')) }}">Show</a>
                                @if($order->status === 'paid')
                                    <a class="btn btn-info" href="{{ route('pdfFile.download', ['order' => $order->id ]) }}" target="_blank" rel="noopener">PDF</a>
                                @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection