@extends('layouts.pages')

@section('content')

    @if(isset($category))
        <b>{{ $category->name }}</b>
    @endif

    <span class="glyphicon glyphicon-user"></span>


    @foreach($products->chunk(4) as $product)
        <div class="row">
            @foreach($product as $eachProduct)
                <div class="col-md-3 product-box">
                    <div class="product-box-inner">
                        <div class="title">
                            <a href="{{ route('expand.product', ['slug' => $eachProduct->slug, 'id' => $eachProduct->id]) }}">
                                {{ ucfirst($eachProduct->title) }}
                            </a> <br>
                            <span class="@if($eachProduct->type == 'subscribers') product-subscriber @else  product-members @endif">{{ $eachProduct->type }}</span> <br>

                        </div>

                        <div class="thumbnail">
                            <a href="{{ route('expand.product', ['slug' => $eachProduct->slug, 'id' => $eachProduct->id]) }}">
                                <img width="30%" src="/storage/{{ $eachProduct->thumbnail }}">
                            </a>
                        </div>

                        <p class="snippet"> {{ $eachProduct->snippet }} </p>

                        <br>
                        <div class="download">
                            <a href="{{ route('download.ebook', ['product_id' => $eachProduct->id]) }}">Download</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endforeach

@endsection