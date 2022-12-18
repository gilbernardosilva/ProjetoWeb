@extends('layouts.app')
@section('content')
    <main class="main-content">
        <div class="container">
            <div class="page">

                <table class="cart">
                    <thead>
                        <tr>
                            <th class="product-name">Product Name</th>
                            <th class="product-price">Price</th>
                            <th class="product-qty">Quantity</th>
                            <th class="product-total">Total</th>
                            <th class="action"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart as $product)
                            <form wire:submit.prevent="removeFromCart({{ $product->id }})"
                                action="{{ url('/shopping-cart') }}" method="POST">
                                @csrf
                                <tr>
                                    <input type="hidden" name="product_rowId" value="{{ $product->rowId }}">
                                    <td class="product-name">
                                        <div class="product-thumbnail">
                                            <img src="{{ asset('storage/images/products/' .$product->id) }}"
                                                width="118" height="134" alt="{{ $product->game}}">
                                        </div>
                                        <div class="product-detail">
                                            <h3 class="product-title">{{ $product->game}}</h3>
                                            <p>{{ $product->game }}</p>
                                        </div>
                                    </td>
                                    <td class="product-price">{{ $product->price }}€</td>
                                    <td class="product-qty">
                                        <input type="number" min="0">
                                    </td>
                                    <td class="product-total">{{ $product->price * $product->qty }} €</td>
                                    <td class="action"><button type="submit"><i class="fa fa-times"></i></button></td>
                            </form>
                        @empty
                            <h5 class="text-center">No Products Found!</h5>
                        @endforelse
                    </tbody>
                </table> <!-- .cart -->

                <div class="cart-total">
                    <p><strong>Subtotal:</strong> {{ Cart::initial() }} €</p>
                    <p><strong>Discount:</strong> **INSERIR CODIGO DE DESCONTO**</p>
                    <p class="total"><strong>Total</strong><span class="num">{{ Cart::initial() }}€</span></p>
                    <p>
                        <a href="{{ url('/') }}" class="button muted">Continue Shopping</a>
                        @if(!$cart->isEmpty())
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button class="button">Finalize and pay</button>
                        </form>
                        @endif
                    </p>
                </div> <!-- .cart-total -->

            </div>
        </div> <!-- .container -->
    </main> <!-- .main-content -->
@endsection
