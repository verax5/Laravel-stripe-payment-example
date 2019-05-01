@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-6">
            <form method="post" action="{{ route('add.product') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title"> Title </label>
                    <input data-validation="required"
                           class="form-control"
                           name="title" id="title"
                           placeholder="Product name or title"
                           value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label for="snippet">Snippet</label>
                    <input data-validation="required"
                           class="form-control" name="snippet"
                           id="snippet"
                           placeholder="A short snippet about this product.."
                           value="{{ old('snippet') }}">
                </div>

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea data-validation="required"
                              class="form-control" id="body"
                              name="body"
                              value="{{ old('title') }}">
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="product-type">Choose product type</label>
                    <select class="form-control" id="product-type" name="type">
                        <option value="subscribers">SUBSCRIBERS</option>
                        <option value="members">MEMBERS</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" id="category" name="category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="ebook">Choose pdf..</label>
                    <input id="ebook" type="file" name="ebook">
                </div>

                <div class="form-group">
                    <label for="file">Choose thumbnail</label>
                    <input id="file" type="file" name="thumbnail">
                </div>

                {{ csrf_field() }}

                <br>
                <input class="btn btn-primary add-product-button" type="submit" value="Add product">
            </form>
        </div>
    </div>


    <hr> <h5>
        Products list
    </h5>

    @foreach($products as $product)
        <p>
            <a target="_blank" href="{{ route('expand.product', ['slug' => $product->slug, 'id' => $product->id]) }}">
                {{ $product->title }}
            </a> @if($product->type == 'free') (free) @elseif($product->type == 'members') (members) @else paid @endif <br>
            {{ $product->snippet }}
        </p>
    @endforeach

    <script>
        $(document).ready(function(){
            $('#body').summernote({
                tabsize: 2,
                height:200
            });

            $.validate();
        });

    </script>

@endsection