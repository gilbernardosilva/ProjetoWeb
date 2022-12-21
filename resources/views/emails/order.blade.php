<x-mail::message>
# Thanks for your purchase @ GLQuadrics!

You have purchased the following items:
<x-mail::table >
    | Product       | Key           | Price    |
    | ------------- |:-------------:| --------:|
    @foreach ( $cart as $product)
    | {{$product->name}}      | Centered      |{{intval($product->price - ($product->price * ($product->options->discount/100))) /100}} €|
    @endforeach

</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
