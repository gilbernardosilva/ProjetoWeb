<section class="pt-5 pb-5">
    <div class="container">
        <h1 class="text-center mb-6"> Profile Edit </h1>

        
        <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
            <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h4>{{ $average }}</h4>
            </div>
            
            <div class="d-flex flex-column ml-4 mt-4">
                <div class="d-flex flex-row post-title">
                    <h2 class="text-center">Products Reviews</h2><span class="ml-2"></span>
                </div>
                <div class="d-flex flex-row align-items-center align-content-center post-title">
                    <span class="mr-2 comments">{{ count($reviews) }} reviews &nbsp;</span>
                </div>
            </div>
        </div>
        <form class="coment-bottom bg-white p-2 px-4">
            @forelse($reviews as $review)
            @php
                $order_item = $review->orderItem;
                $game = $order_item->game;
            @endphp
                <div class="commented-section mt-2">
                    <div class="d-flex flex-row align-items-center commented-user">
                        <h3 class="mr-2">{{ $game->name }} by {{ $review->user->name }}</h3>
                        <span class ="ml-2">Price: {{ intval($order_item->final_price/100) }}</span>
                        <span class= "ml-2">Description: {{ $review->description }}</span>
                        <span class="ml-4">{{ $review->rating }}</span>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <span class=" ml-5 float-right">{{ $review->updated_at }}</span>
                    </div>
                </div>
            @empty
            <div class="commented-section mt-2">
                <div class="comment-text-sm"><span>No Reviews Found</span></div>
            </div>
            @endforelse
        </form>
        
        <table id="shoppingCart" class="table table-condensed table-responsive mt-4">
            <thead>
                <tr>
                    <th style="width:30%">Products</th>
                    <th style="width:12%">Price</th>
                    <th style="width:12%">Discount</th>
                    <th style="width:10%">Discounted Price</th>
                    <th style="width:8%"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($sellingProducts as $product)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-md-3 text-left">
                                <img src="{{ asset('storage/images/' . $product->game->photos->path) }}" alt="" class=" d-none  d-md-block rounded mb-2 shadow " width="75" height="60">
                            </div>
                            <div class="col-md-9 text-left mt-sm-2">
                                <h4>{{ $product->game->name }} - {{ $product->platform->name }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{ $product->price }}€</td>
                    <td data-th="Discount">{{ $product->discount }}%</td>
                    <td data-th="Discounted Price" class="text-center">
                        {{ $product->price - $product->price * ($product->discount / 100) }}
                    </td>
                    <td class="actions" data-th="">
                        <div class="text-right">
                            <livewire:add-cart :product_id="$product->id" />
                        </div>
                    </td>
                </tr>
                </form>
                @empty
                <h5 class="text-center">No Products Found!</h5>
                @endforelse
            </tbody>
        </table>
        <a class="btn btn-primary float-right" href="{{ route('messages.create') }}">Send a Message</a>
    </div>
    </div>
    </div>
</section>
