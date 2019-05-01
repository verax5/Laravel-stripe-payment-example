@php $categories = \App\Category::all(); @endphp

@foreach($categories->chunk(3) as $category)
        @foreach($category as $eachCategory)
            <div class="col-md-4">
                <a href="{{ route('expand.category', ['slug' => $eachCategory->slug, 'id' => $eachCategory->id]) }}">{{ $eachCategory->name }}</a>
            </div>
        @endforeach
@endforeach