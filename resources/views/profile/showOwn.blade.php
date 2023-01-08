<section class="pt-5 pb-5">
    <div class="container">
        <div class="text-center mb-6">
        <h1 class="text-center mb-6">Profile</h1>
        <a class="btn btn-primary" href="{{ route('profile.edit') }}">Edit Profile info</a>
        </div>
        <div class="d-flex flex-row align-items-center text-left mt-4 comment-top p-2 bg-white border-bottom px-4">
            <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                <i class="fa fa-star" aria-hidden="true"></i>
                <h4>{{ $average }}</h4>
            </div>
            <div class="d-flex flex-column ml-4">
                <div class="d-flex flex-row post-title">
                    <h2 class="text-center">Reviews</h2><span class="ml-2"></span>
                </div>
                <div class="d-flex flex-row align-items-center align-content-center post-title">
                    <span class="mr-2 comments">{{ count($reviews) }} reviews &nbsp;</span>
                </div>
            </div>
        </div>
        <form class="coment-bottom bg-white p-2 px-4">
            @forelse($reviews as $review)
                <div class="commented-section mt-2">
                    <div class="d-flex flex-row align-items-center commented-user">
                        <h3 class="mr-2">{{ $review->user->name }}</h5>
                        <span class= "ml-2">{{ $review->description }}</span>
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
        @if(count($sellingProducts)>0)
        <h1 class="text-center mb-6 mt-6">Own Products</h1>
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
                @foreach ($sellingProducts as $product)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    <img src="{{ asset('storage/images/' . $product->game->photos[0]->path) }}"
                                        alt="" class=" d-none  d-md-block rounded mb-2 shadow " width="75"
                                        height="60">
                                </div>
                                <div class="col-md-9 text-left mt-sm-2">
                                    <h4>{{ $product->game->name }} - {{ $product->platform->name }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{ $product->price }}€</td>
                        <td data-th="Discount">{{ $product->discount }}%</td>
                        <td data-th="Discounted Price" class="text-center">
                            {{ $product->price - $product->price * ($product->discount / 100) }} € </td>
                        <td>
                            <form action=" {{ route('products.destroy', compact('product')) }} " method="POST">
                                @csrf
                                <a class="btn btn-primary"
                                    href="{{ route('products.edit', compact('product')) }}">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </form>
                @endforeach
            </tbody>
        </table>
        @endif
        <h1 class="text-center mt-4"> No products for Sale </h1>
    </div>
</section>
