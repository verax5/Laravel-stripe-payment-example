@extends('layouts.pages')

@section('content')
    <div class="row"><div class="col-md-12"> <h4>{{ ucfirst($product->title) }} </h4> </div> </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <img width="200px" src="/storage/{{ $product->thumbnail }}">
        </div>

        <div class="col-md-9">
            <p> {!! $product->body !!} </p>

            <hr>

            <a href="{{ route('download.ebook', ['product_id' => $product->id]) }}">
                @if($product->type == 'subscribers')
                    Download
                @elseif($product->type == 'members')
                    <button class="btn btn-primary">Download for free!</button>
                @else
                    <p> <a href="{{ route('user.register') }}">Register Now</a> or <a href="{{ route('user.login') }}"> Login </a> to download for free! </p>
                @endif
            </a>
        </div>
    </div>


    @php
        $similarProducts = $product->where('category_id', $product->category_id)->limit(5)->get();
    @endphp

    <br>
    <div class="row">
        <div class="col-md-12">
            <h6>More in {{ $product->category->name }} (<a href="{{ route('expand.category', ['slug' => $product->category->name, 'id' => $product->category->id]) }}">more</a>)</h6>
        </div>
    </div>

    <div class="row similar-products">
        @foreach($similarProducts as $similarProduct)
            @if($similarProduct->id != $product->id)
                <div class="col-md-2">
                    <a href="{{ route('expand.product', ['slug' => $similarProduct->slug, 'id' => $similarProduct->id]) }}">
                        <img width="100px" src="/storage/{{ $similarProduct->thumbnail }}">
                        <p>
                            {{ ucfirst($similarProduct->title) }}
                        </p>
                    </a>
                </div>
            @endif
        @endforeach
    </div>

@endsection