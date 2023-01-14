<div class="card">
  <div class="card-body mx-4">
    <div class="container">
      <p class="my-5 mx-5" style="font-size: 30px;">Thank you for your purchase</p>
      @foreach($cart as $product)
      @php
      $total = $total + intval($product->price - ($product->price * ($product->options->discount / 100)));
      @endphp
      <div class="row">
        <div class="list-unstyled">
          <h4 class="text-black">Name: {{$product->options->sellerName}}</h4>
        </div>
        <hr>
        <div class="col-xl-10">
          <p>Product: {{$product->name}}</p>
        </div>
        <div class="col-xl-2">
          <p class="float-end">Price: {{intval($product->price - ($product->price * ($product->options->discount / 100)))/100}}€</p>
        </div>
        <hr>
      </div>
      @endforeach
      <div class="row text-black">
        <div class="col-xl-12">
          <p class="float-end fw-bold">Total: {{$total}}€</p>
        </div>
        <hr style="border: 2px solid black;">
      </div>
    </div>
  </div>
</div>