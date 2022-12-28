@extends('layouts.app')
@section('content')

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!-- FONTS -->
<!-- Roboto, Yellowtail, and Montserrat -->
<link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:300,400|Yellowtail" rel="stylesheet">

<!-- PAGE STUFF -->
<div class="overlay">
    <div class="abs-center overlay-card">
        <div class="close">X</div>
        <div class="floated overlay-image">
            <div class="abs-center post-image">

            </div>
        </div>
        <div class="floated overlay-desc">
            <div class="rela-block desc-title"></div>
            <div class="rela-block desc-author"></div>
            <div class="rela-block desc-desc"></div>
        </div>
    </div>
</div>
<div class="rela-block container">
    <div class="rela-block profile-card">
        <div class="profile-pic" id="profile_pic">
            <img src="{{ asset('storage/images/' . $photo->path) }}" alt="Profile Photo" class="rounded img-fluid" width="70"height="70">
        </div>
        <div class="rela-block profile-name-container">
            <div class="rela-block user-name" id="user_name">{{$user->name}}</div>
            <div class="rela-block user-desc" id="user_email">{{$user->email}}</div>
            <!--<div class="rela-block user-desc" id="user_address">{{$address}}</div>-->
        </div>
        <div class="rela-block profile-card-buttons">
            @if($hideWriteOwnReview != $user)
                <a class="btn btn-primary" href="{{ route('messages.create') }}">Create New Message</a>
                <a class="btn btn-primary" href="{{ route('reviews.create') }}">Write a Review</a>
            @endif
            <a class="btn btn-primary" href="{{ route('profile.edit', compact('user', 'address', 'photo')) }}">Edit</a>
        </div>
    </div>
    @if($role === 'seller' || $role === 'admin')
        <div class="rela-block content">
            <div class="rela-inline product">
                <h1>Selling products</h1>
                @foreach($sellingProducts as $product)
                @php
                        if ($product->discount > 0) {
                            $sale = true;
                        } else {
                            $sale = false;
                        }
                    @endphp
                    <div class="col mb-5">
                        <div class="card h-100" style="border-top-radius:1.6rem">
                            <!-- Sale badge-->
                            @if ($sale)
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    Sale</div>
                            @endif
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top" style="border-top-radius:1.7rem"
                                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /></a>

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }} - [{{ $product->platform->name }}]</h5>

                                    @if ($sale)
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">{{ $product->price }}€</span>
                                        {{ number_format($product->price * ($product->discount / 100), 2, '.') }}€
                                    @else
                                        {{ $product->price }}
                                    @endif

                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <livewire:add-cart :product_id="$product->id" />
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
            {{ $sellingProducts->links('pagination::bootstrap-5') }}
        </div>
    @elseif($role === 'user')
    <div class="rela-block content">
            <div class="rela-inline product">
                <h1>Products Bought</h1>
                @foreach($productsBought as $product)
                    <div class="col mb-5">
                        <div class="card h-100" style="border-top-radius:1.6rem">
                            <!-- Product image-->
                            <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">
                                <img class="card-img-top" style="border-top-radius:1.7rem"
                                    src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /></a>

                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->game->name }} - [{{ $product->platform->name }}]</h5>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endforeach
            </div>
            {{ $productsBought->links('pagination::bootstrap-5') }}
        </div>
    @endif
    <div class="rela-block content">
        <div class="rela-inline product">
            <h1>Reviews</h1>
            @foreach($reviews as $review)
                <!-- Rating -->
                <div class="rating">{{$review->rating}}</div>
                <!-- Description -->
                <div class="description">{{$review->description}}</div>
            @endforeach
        </div>
    </div>
    {{ $reviews->links('pagination::bootstrap-5') }}
</div>
@endsection