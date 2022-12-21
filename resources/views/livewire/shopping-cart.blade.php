@extends('layouts.app')
@section('content')
    @php

        $total = 0;
    @endphp
    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row w-100">
                <div class="col-lg-12 col-md-12 col-12">
                    <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                    <h3 class="mb-5 text-center">
                        <i class="text-info font-weight-bold">{{ Cart::count() }} </i>
                        items in your cart
                    </h3>
                    <br>
                    <table id="shoppingCart" class="table table-condensed table-responsive">
                        <thead>
                            <tr>
                                <th style="width:40%">Product</th>
                                <th style="width:12%">Price</th>
                                <th style="width:12%">Discount</th>
                                <th style="width:10%">Discounted Price</th>
                                <th style="width:16%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart as $product)
                                <form wire:submit.prevent="removeFromCart({{ $product->id }})"
                                    action="{{ url('/shopping-cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_rowId" value="{{ $product->rowId }}">
                                    <tr>
                                        <td data-th="Product">
                                            <div class="row">
                                                <div class="col-md-3 text-left">
                                                    <img src="https://via.placeholder.com/250x250/5fa9f8/ffffff"
                                                        alt=""
                                                        class="img-fluid d-none d-md-block rounded mb-2 shadow "
                                                        width="75" height="75">
                                                </div>
                                                <div class="col-md-9 text-left mt-sm-2">
                                                    <h4>{{ $product->name }}</h4>
                                                    <a href=""
                                                        class="font-weight-light">{{ $product->options->sellerName }}</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">{{ $product->price / 100 }}€</td>
                                        <td data-th="Quantity">
                                            {{ $product->options->discount }} %
                                        </td>
                                        <td data-th="Quantity" class="text-center">
                                            {{intval($product->price - ($product->price * ($product->options->discount/100))) /100}} €

                                        </td>
                                        <td class="actions" data-th="">
                                            <div class="text-right">
                                                <button class="btn btn-white border-secondary bg-white btn-md mb-2"
                                                    type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </form>
                            @empty
                                <h5 class="text-center">No Products Found!</h5>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="float-right text-right">
                        <h4>Subtotal:</h4>
                        <h1>{{ $total /100}}€</h1>
                    </div>
                </div>
            </div>
            <div class="row mt-4 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right">
                    @if (!$cart->isEmpty() && Auth::user() != null)
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary mb-4 btn-lg pl-5 pr-5">Checkout</button>
                        </form>
                    @else
                        <a class="btn btn-secondary mb-4 btn-lg pl-5 pr-5" href="/login">Checkout</a>
                    @endif
                </div>
                <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left dark">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                </div>
            </div>
        </div>

    </section>
    @include('partials.footer')
@endsection
