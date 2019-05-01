@extends('layouts.pages')

<script src="https://js.stripe.com/v3/"></script>
@section('content')
    @foreach($products as $product)
        @if($product->type == 'paid' && $product->orders()->where('user_id', auth()->guard('user')->user()->id)->exists())
            <a href="{{ route('expand.product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                {{ $product->title }}
            </a> @if ($product->type =='paid')(<b>{{ $product->price }}</b>)@endif <br>

            {{ $product->body }} <br>
        @endif
    @endforeach
@endsection












