<body>
    @extends('layouts.appsite')
    @section('content')

        </div> <!-- .container -->
        </div> <!-- .site-header -->
        <main class="main-content">
            <div class="container">
                <div class="page">
                    <div class="filter-bar">
                        <div class="filter">
                            <span>
                                <label>Sort by:</label>
                                <select name="#">
                                    <option value="#">Popularity</option>
                                    <option value="#">Highest Rating</option>
                                    <option value="#">Lowest price</option>
                                </select>
                            </span>
                            <span>
                                <label>Platform</label>
                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

                            </span>
                            <span>
                                <label>Show:</label>
                                <select name="#">
                                    <option value="#">8</option>
                                    <option value="#">16</option>
                                    <option value="#">24</option>
                                </select>
                            </span>
                        </div> <!-- .filter -->

                        <div class="pagination-bar">
                            <div class="pagination">
                                <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
                                {{ $searchProducts->appends(request()->input())->links('pagination::semantic-ui') }}
                                <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
                            </div> <!-- .pagination -->
                        </div>
                    </div> <!-- .filter-bar -->

                    <div class="product-list">
                        @forelse($searchProducts as $product)
                            <div class="product">
                                <div class="inner-product">
                                    <div class="figure-image">
                                        <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}"><img
                                                src="{{ asset('storage/images/games/' . $product->game->id . '/thumbnail') }}"
                                                alt="{{ $product->game->name }}"></a>
                                    </div>
                                    <h3 class="product-title"><a
                                            href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }}">{{ $product->game->name }}</a>
                                    </h3>
                                    <small class="price">{{ $product->price }} €</small>
                                    <p>{{ $product->game->description }}</p>

                                    <livewire:add-cart :product_id="$product->id" />
                                    <a href="{{ url('/products/show/' . $product->id . '/' . $product->user->id) }} "
                                        class="button muted">Read
                                        Details</a>
                                </div>
                            </div> <!-- .product -->

                        @empty
                            <h5 class="text-center">No Products Found!</h5>
                        @endforelse

                    </div> <!-- .product-list -->

                    <div class="pagination-bar">
                        <div class="pagination">
                            <a href="#" class="page-number"><i class="fa fa-angle-left"></i></a>
                            {{ $searchProducts->appends(request()->input())->links('pagination::semantic-ui') }}
                            <a href="#" class="page-number"><i class="fa fa-angle-right"></i></a>
                        </div> <!-- .pagination -->
                    </div>
                </div>
            </div> <!-- .container -->
        </main> <!-- .main-content -->
    @endsection

</body>
