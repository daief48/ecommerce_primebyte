@extends('Front.layouts.app')

@section('style')
<!-- EasyZoom CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/easyzoom/2.5.0/easyzoom.css" integrity="sha512-K/qe6a8tW+dKf/lZH/9O9cLFELzIq96vAcoJYp/0vZy6TPGTOs7Y9ylc6O5CkX+kXxSUoRcbL2u7s2kTnyFhAA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
/* ---------- Breadcrumb ---------- */
.section-5 {
    background: #f8f9fa;
}
.section-5 .breadcrumb a {
    text-decoration: none;
    font-weight: 500;
    color: #555;
}
.section-5 .breadcrumb li {
    font-size: 0.9rem;
}

/* ---------- Product Section ---------- */
.section-7 .product-image-wrapper {
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    cursor: zoom-in;
}
.section-7 .product-image-wrapper img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

/* Thumbnail gallery */
.thumb-images img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.thumb-images img:hover {
    border: 2px solid #007bff;
    transform: scale(1.1);
}

/* ---------- Product Details ---------- */
.section-7 h1 {
    font-weight: 700;
    font-size: 2rem;
}
.section-7 .price h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #d9534f;
}
.section-7 .price del {
    color: #999;
    font-size: 1rem;
    margin-left: 10px;
}
.section-7 .badge-sale {
    background-color: #d9534f;
    color: #fff;
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
    position: absolute;
    top: 10px;
    left: 10px;
    border-radius: 5px;
}
.section-7 .btn-dark {
    border-radius: 50px;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}
.section-7 .btn-dark:hover {
    background-color: #007bff;
}

/* ---------- Star Rating ---------- */
.star-rating {
    font-size: 1.2rem;
    position: relative;
}
.star-rating .back-stars i {
    color: #e4e5e9;
}
.star-rating .front-stars {
    overflow: hidden;
    white-space: nowrap;
    position: absolute;
    top: 0;
    left: 0;
    color: #ffc107;
}

/* ---------- Tabs ---------- */
.nav-tabs .nav-link {
    border: none;
    border-bottom: 2px solid transparent;
    font-weight: 600;
    color: #333;
}
.nav-tabs .nav-link.active {
    border-color: #007bff;
    color: #007bff;
}

/* ---------- Reviews ---------- */
.review-card {
    border: 1px solid #e3e3e3;
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

/* ---------- Related Products ---------- */
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
}
.card h6 {
    font-weight: 600;
}
.card del {
    color: #999;
}

/* ---------- Sticky Add to Cart ---------- */
.sticky-cart {
    position: sticky;
    top: 20px;
}
</style>
@endsection

@section('content')
<!-- Breadcrumb -->
<section class="section-5 pt-4 pb-2">
    <div class="container">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('front.shop') }}">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </div>
</section>

<!-- Product Section -->
<section class="section-7 py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Product Images -->
            <div class="col-md-5">
                @if($product->product_images->count() > 0)
                <div class="easyzoom easyzoom--overlay mb-3">
                    <a href="{{ asset('uploads/products/large/' . $product->product_images[0]->image) }}">
                        <img src="{{ asset('uploads/products/large/' . $product->product_images[0]->image) }}" class="img-fluid rounded shadow">
                        @if($product->compare_price > 0)
                        <span class="badge-sale">Sale</span>
                        @endif
                    </a>
                </div>

                <!-- Thumbnails -->
                <div class="d-flex gap-2 overflow-auto thumb-images">
                    @foreach($product->product_images as $img)
                    <a href="{{ asset('uploads/products/large/' . $img->image) }}" class="easyzoom-thumb" data-standard="{{ asset('uploads/products/large/' . $img->image) }}">
                        <img src="{{ asset('uploads/products/large/' . $img->image) }}" class="img-thumbnail">
                    </a>
                    @endforeach
                </div>
                @else
                <img class="img-fluid shadow rounded" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="No Image">
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-md-7">
                <div class="p-4 bg-white rounded shadow sticky-cart">
                    <h1 class="mb-3">{{ $product->title }}</h1>

                    <!-- Rating -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="star-rating me-2 position-relative">
                            <div class="back-stars">@for($i=0;$i<5;$i++)<i class="fa fa-star"></i>@endfor</div>
                            <div class="front-stars position-absolute top-0 start-0 overflow-hidden" style="width:{{ $avgRatingPer }}%">@for($i=0;$i<5;$i++)<i class="fa fa-star"></i>@endfor</div>
                        </div>
                        <small>({{ $product->product_ratings_count }} Reviews)</small>
                    </div>

                    <!-- Price -->
                    <div class="price mb-3">
                        <h2>${{ $product->price }}</h2>
                        @if($product->compare_price > 0)
                        <del>${{ $product->compare_price }}</del>
                        @endif
                    </div>

                    <!-- Short Description -->
                    <div class="mb-4">{!! $product->short_description !!}</div>

                    <!-- Add to Cart Button -->
                    @php $inStock = $product->track_qty=='Yes'? $product->qty>0 : true; @endphp
                    <a class="btn btn-dark btn-lg {{ $inStock ? '' : 'disabled' }}" href="javascript:void(0);" @if($inStock) onclick="addToCart({{ $product->id }});" @endif>
                        <i class="fa fa-shopping-cart"></i> {{ $inStock ? 'Add to Cart' : 'Out of Stock' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(!empty($relatedProducts))
        <section class="py-5 bg-white mt-5">
            <h3 class="mb-4">Related Products</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $rel)
                @php $image = $rel->product_images->first(); @endphp
                <div class="col-md-3">
                    <div class="card h-100 shadow-sm rounded hover-shadow">
                        <a href="{{ route('front.product', $rel->slug) }}">
                            <img class="card-img-top rounded-top" style="height:250px; object-fit:cover;" src="{{ $image ? asset('uploads/products/large/'.$image->image) : asset('admin-assets/img/default-150x150.png') }}">
                        </a>
                        <div class="card-body text-center">
                            <h6>{{ $rel->title }}</h6>
                            <p><strong>${{ $rel->price }}</strong> @if($rel->compare_price>0)<del class="text-muted ms-2">${{ $rel->compare_price }}</del>@endif</p>
                            @php $inStock = $rel->track_qty=='Yes'? $rel->qty>0 : true; @endphp
                            <a class="btn btn-dark btn-sm mt-2 {{ $inStock ? '' : 'disabled' }}" href="javascript:void(0);" @if($inStock) onclick="addToCart({{ $rel->id }});" @endif>
                                {{ $inStock ? 'Add to Cart' : 'Out of Stock' }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</section>
@endsection

@section('customJs')
<!-- EasyZoom JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/easyzoom/2.5.0/easyzoom.js" integrity="sha512-6X6T8XJHUMCSd4ebQuUVuQ2avhF3Kj+GZg0WrXT4LxjT0CjRjrN+Y/NZb53Nq6Rjjzk77x6p9YqF/j3KHXdnSA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function(){
    var $easyzoom = $('.easyzoom').easyZoom();
    var api = $easyzoom.data('easyZoom');

    $('.easyzoom-thumb').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        api.swap($this.attr('href'), $this.data('standard'));
    });
});
</script>
@endsection
