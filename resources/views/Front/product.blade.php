@extends('Front.layouts.app')
@section('content')

<!-- Breadcrumb -->
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <ol class="breadcrumb primary-color mb-0">
            <li class="breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('front.shop') }}">Shop</a></li>
            <li class="breadcrumb-item active">{{ $product->title }}</li>
        </ol>
    </div>
</section>

<!-- Product Details -->
<section class="section-7 pt-3 mb-3">
    <div class="container">

        <!-- Flash Messages -->
        @foreach (['success', 'error'] as $msg)
            @if(Session::has($msg))
                <div class="alert alert-{{ $msg == 'success' ? 'success' : 'danger' }} alert-dismissible fade show">
                    {!! Session::get($msg) !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        @endforeach

        <div class="row g-4">

            <!-- Product Images Carousel -->
            <div class="col-md-5">
                <div id="product-carousel" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
                    <div class="carousel-inner bg-light rounded">
                        @if ($product->product_images->isNotEmpty())
                            @foreach ($product->product_images as $key => $productImage)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="d-block w-100 rounded" style="height: 500px; object-fit: cover;"
                                        src="{{ $productImage->image ? asset('uploads/products/large/' . $productImage->image) : asset('admin-assets/img/default-150x150.png') }}">
                                </div>
                            @endforeach
                        @else
                            <div class="carousel-item active">
                                <img class="d-block w-100 rounded" src="{{ asset('admin-assets/img/default-150x150.png') }}">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#product-carousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#product-carousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
                    </button>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-7">
                <div class="bg-white shadow-sm rounded p-4">
                    <h1 class="h3 fw-bold">{{ $product->title }}</h1>

                    <!-- Ratings -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="star-rating me-2">
                            <div class="back-stars position-relative">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fa fa-star text-muted"></i>
                                @endfor
                                <div class="front-stars position-absolute top-0 start-0 overflow-hidden" style="width: {{ $avgRatingPer }}%">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star text-warning"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <small class="text-muted">({{ $product->product_ratings_count }} {{ Str::plural('Review', $product->product_ratings_count) }})</small>
                    </div>

                    <!-- Sizes -->
                    @if(!empty($product->sizes_detail) && $product->sizes_detail->isNotEmpty())
                        <div class="mb-3">
                            <label class="fw-bold">Size:</label>
                            <div class="d-flex flex-wrap gap-2 mt-1">
                                @foreach($product->sizes_detail as $size)
                                    <span class="badge bg-secondary">{{ $size->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Colors -->
                    @if(!empty($product->color_name))
                        @php
                            $colors = json_decode($product->color_name, true) ?? [];
                            $color_codes = json_decode($product->color_code, true) ?? [];
                        @endphp
                        @if(!empty($colors))
                            <div class="mb-3">
                                <label class="fw-bold">Color:</label>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    @foreach($colors as $index => $color)
                                        <span class="color-circle rounded-circle" style="width:25px;height:25px;background-color: {{ $color_codes[$index] ?? '#000' }}" title="{{ $color }}"></span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Price -->
                    <h2 class="fw-bold text-primary">${{ $product->price }}</h2>
                    @if ($product->compare_price > 0)
                        <h4 class="text-muted"><del>${{ $product->compare_price }}</del></h4>
                    @endif

                    <!-- Short Description -->
                    <div class="mb-3">{!! $product->short_description !!}</div>

                    <!-- Add to Cart -->
                    @if ($product->track_qty == 'Yes' && $product->qty <= 0)
                        <button class="btn btn-secondary btn-lg w-100">Out Of Stock</button>
                    @else
                        <a class="btn btn-dark btn-lg w-100 text-white" href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
                            <i class="fa fa-shopping-cart me-2"></i> Add To Cart
                        </a>
                    @endif
                </div>
            </div>

            <!-- Tabs -->
            <div class="col-12 mt-5">
                <div class="bg-white shadow-sm rounded p-4">
                    <ul class="nav nav-tabs mb-3" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button">Description</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button">Shipping & Returns</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button">Reviews</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabContent">
                        <div class="tab-pane fade show active" id="description">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="shipping">
                            {!! $product->shipping_returns !!}
                        </div>
                        <div class="tab-pane fade" id="reviews">
                            <!-- Write a Review -->
                            <form id="ratingForm" class="row g-3" method="post">
                                @csrf
                                <h4 class="fw-bold mb-3">Write a Review</h4>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="me-3">Rating:</label>
                                        <div class="rating d-flex">
                                            @for($i=5;$i>=1;$i--)
                                                <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}">
                                                <label for="rating-{{ $i }}" class="me-1"><i class="fas fa-star text-warning"></i></label>
                                            @endfor
                                        </div>
                                    </div>
                                    <textarea class="form-control" name="comment" rows="4" placeholder="How was your overall experience?"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">Submit Review</button>
                                </div>
                            </form>

                            <!-- Overall Rating -->
                            <div class="mt-5">
                                <h5 class="fw-bold">Overall Rating: {{ $rating }}</h5>
                                <div class="star-rating mb-3">
                                    <div class="back-stars position-relative">
                                        @for($i=0;$i<5;$i++)
                                            <i class="fa fa-star text-muted"></i>
                                        @endfor
                                        <div class="front-stars position-absolute top-0 start-0 overflow-hidden" style="width: {{ $avgRatingPer }}%">
                                            @for($i=0;$i<5;$i++)
                                                <i class="fa fa-star text-warning"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted">({{ $product->product_ratings_count }} {{ Str::plural('Review', $product->product_ratings_count) }})</p>
                            </div>

                            <!-- Individual Reviews -->
                            @forelse ($product->productRatings as $rating)
                                @php $ratingPer = ($rating->rating * 100)/5; @endphp
                                <div class="mb-4 p-3 bg-light rounded shadow-sm">
                                    <strong>{{ $rating->username }}</strong>
                                    <div class="star-rating mt-2">
                                        <div class="back-stars position-relative">
                                            @for($i=0;$i<5;$i++)
                                                <i class="fa fa-star text-muted"></i>
                                            @endfor
                                            <div class="front-stars position-absolute top-0 start-0 overflow-hidden" style="width: {{ $ratingPer }}%">
                                                @for($i=0;$i<5;$i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-2">{{ $rating->comment }}</p>
                                </div>
                            @empty
                                <p>No reviews found for this product.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Related Products -->
@if(!empty($relatedProducts))
<section class="pt-5 section-8">
    <div class="container">
        <h2 class="mb-4">Related Products</h2>
        <div class="row g-3">
            @foreach($relatedProducts as $recordProduct)
                @php $productImage = $recordProduct->product_images->first(); @endphp
                <div class="col-md-3">
                    <div class="card product-card shadow-sm">
                        <a href="{{ route('front.product', $recordProduct->slug) }}">
                            <img class="card-img-top" style="height: 250px; object-fit: cover;" src="{{ $productImage? asset('uploads/products/large/'.$productImage->image) : asset('admin-assets/img/default-150x150.png') }}">
                        </a>
                        <div class="card-body text-center">
                            <h6>{{ $recordProduct->title }}</h6>
                            <div class="d-flex justify-content-center align-items-center gap-2 mt-2">
                                <span class="fw-bold">${{ $recordProduct->price }}</span>
                                @if($recordProduct->compare_price>0)
                                    <span class="text-muted"><del>${{ $recordProduct->compare_price }}</del></span>
                                @endif
                            </div>
                            <div class="mt-2">
                                @if($recordProduct->track_qty == 'Yes' && $recordProduct->qty <=0)
                                    <button class="btn btn-secondary btn-sm w-100">Out Of Stock</button>
                                @else
                                    <button class="btn btn-dark btn-sm w-100" onclick="addToCart({{ $recordProduct->id }})">Add To Cart</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('customJs')
<script>
    $("#ratingForm").submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '{{ route("front.saveRating", $product->id) }}',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response){
                if(response.status){
                    location.reload();
                } else {
                    // handle validation errors
                    $.each(response.errors, function(key,val){
                        let input = $("[name='"+key+"']");
                        input.addClass('is-invalid');
                        input.next('p').addClass('invalid-feedback').html(val);
                    });
                }
            },
            error: function(){ console.log('Something went wrong'); }
        });
    });
</script>
@endsection
