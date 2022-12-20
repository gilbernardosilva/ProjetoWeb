@extends('layouts.app')
@section('content')
@include('partials.navbartest')
@include('partials.header')
<section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($products as $product)
                @php
                    if($product->discount>0){
                        $sale=true;
                    }else{
                    $sale=false;
                }
                @endphp
                <div class="col mb-5" >
                    <div class="card h-100">
                        <!-- Sale badge-->
                        @if($sale)
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top" style="border-top-radius:1.6rem" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />

                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $product->game->name }}</h5>

                                @if($sale)
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">$20.00</span>
                                @endif
                                $18.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $products->links('pagination::bootstrap-5') }}
        </div>

</section>
@include('partials.footer')
@endsection
