@extends('Admin.layouts.app')

@section('style')
<style>
    .size-pill {
        position: relative;
        cursor: pointer;
        user-select: none;
    }

    .size-pill input {
        display: none;
    }

    .size-pill span {
        display: inline-block;
        padding: 8px 18px;
        border: 2px solid #0d6efd;
        border-radius: 30px;
        color: #0d6efd;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .size-pill input:checked+span {
        background: #0d6efd;
        color: #fff;
    }

</style>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Product</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('products.list') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <form action="" method="post" class="productForm" id="productForm">
        @csrf
        <div class="container-fluid">
            <div class="row">

                {{-- LEFT SIDE --}}
                <div class="col-md-8">

                    {{-- BASIC INFO --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control">
                                <p class="error"></p>
                            </div>

                            <div class="mb-3">
                                <label for="slug">Slug</label>
                                <input type="text" readonly name="slug" id="slug" class="form-control">
                                <p class="error"></p>
                            </div>

                            <div class="mb-3">
                                <label>Short Description</label>
                                <textarea name="short_description" class="summernote"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="summernote"></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Shipping & Returns</label>
                                <textarea name="shipping_returns" class="summernote"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- MEDIA --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Media</h4>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    Drop files here or click to upload.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="product-gallery"></div>

                    {{-- PRICING --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Pricing</h4>

                            <div class="mb-3">
                                <label>Price</label>
                                <input type="text" name="price" id="price" class="form-control">
                                <p class="error"></p>
                            </div>

                            <div class="mb-3">
                                <label>Compare at Price</label>
                                <input type="text" name="compare_price" id="compare_price" class="form-control">
                                <p class="text-muted mt-2">
                                    Enter original price here. Use lower price in “Price”.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- INVENTORY --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Inventory</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>SKU</label>
                                    <input type="text" name="sku" id="sku" class="form-control">
                                    <p class="error"></p>
                                </div>

                                <div class="col-md-6">
                                    <label>Barcode</label>
                                    <input type="text" name="barcode" id="barcode" class="form-control">
                                </div>
                            </div>

                            <div class="mt-3 custom-control custom-checkbox">
                                <input type="hidden" name="track_qty" value="No">
                                <input class="custom-control-input" type="checkbox" value="Yes" id="track_qty" name="track_qty" checked>
                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                            </div>

                            <div class="mt-3">
                                <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                            </div>

                            {{-- Optional Size --}}
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="enable-sizes">
                                    <label class="form-check-label" for="enable-sizes">Add Sizes</label>
                                </div>
                                <div class=" flex-wrap gap-2 mt-2" id="size-container" style="display: none;">
                                    @foreach($sizes as $size)
                                    <label class="size-pill mx-2 my-2">
                                        <input type="checkbox" name="size_id[]" value="{{ $size->id }}">
                                        <span>{{ $size->name }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Optional Color --}}
                            <div class="mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="enable-colors">
                                    <label class="form-check-label" for="enable-colors">Add Colors</label>
                                </div>
                                <div id="color-container" style="display: none;" class="mt-2">
                                    <div class="d-flex align-items-center mb-2 color-row">
                                        <input type="text" name="color_name[]" class="form-control me-2" placeholder="Color Name">
                                        <input type="color" name="color_code[]" class="form-control form-control-color" value="#ff0000">
                                        <button type="button" class="btn btn-danger btn-sm ms-2 remove-color">Remove</button>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2" id="add-color">Add Color</button>
                                </div>
                            </div>

                        </div>
                    </div>  
                </div>

                {{-- RIGHT SIDE --}}
                <div class="col-md-4">

                    {{-- STATUS --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Product Status</h4>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                        </div>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Category</h4>

                            <label>Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select</option>
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>

                            <label class="mt-3">Sub Category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">Select</option>
                            </select>

                        </div>
                    </div>

                    {{-- BRAND --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Brand</h4>
                            <select name="brand" class="form-control">
                                <option value="">Select</option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- FEATURED --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Featured Product</h4>
                            <select name="is_featured" class="form-control">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div>
                    </div>

                    {{-- RELATED PRODUCTS --}}
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4>Related Products</h4>
                            <select multiple class="related-products w-100" name="related_products[]" id="related_products"></select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="pt-3 pb-5">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('products.list') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
</section>
@endsection


@section('customJs')
              {{-- Script --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Size toggle
                            const enableSizes = document.getElementById('enable-sizes');
                            const sizeContainer = document.getElementById('size-container');

                            enableSizes.addEventListener('change', function() {
                                sizeContainer.style.display = this.checked ? 'flex' : 'none';
                            });

                            // Color toggle and dynamic add/remove
                            const enableColors = document.getElementById('enable-colors');
                            const colorContainer = document.getElementById('color-container');
                            const addColorBtn = document.getElementById('add-color');

                            enableColors.addEventListener('change', function() {
                                colorContainer.style.display = this.checked ? 'block' : 'none';
                            });

                            addColorBtn.addEventListener('click', function() {
                                const newColorRow = document.createElement('div');
                                newColorRow.classList.add('d-flex', 'align-items-center', 'mb-2', 'color-row');
                                newColorRow.innerHTML = `
            <input type="text" name="color_name[]" class="form-control me-2" placeholder="Color Name">
            <input type="color" name="color_code[]" class="form-control form-control-color" value="#ff0000">
            <button type="button" class="btn btn-danger btn-sm ms-2 remove-color">Remove</button>
        `;
                                colorContainer.insertBefore(newColorRow, addColorBtn);
                            });

                            colorContainer.addEventListener('click', function(e) {
                                if (e.target.classList.contains('remove-color')) {
                                    e.target.closest('.color-row').remove();
                                }
                            });
                        });

                    </script>
<script>
    /* RELATED PRODUCTS */
    $('.related-products').select2({
        ajax: {
            url: '{{ route("products.getProducts") }}'
            , dataType: 'json'
            , minimumInputLength: 3
            , processResults: data => ({
                results: data.tags
            })
        }
    });


    /* FORM SUBMIT */
    $("#productForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);

        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("products.store") }}'
            , type: 'POST'
            , data: form.serializeArray()
            , dataType: 'json'
            , success: function(response) {

                $("button[type=submit]").prop('disabled', false);

                if (response.status === true) {
                    window.location.href = "{{ route('products.list') }}";
                } else {
                    $(".error").html("").removeClass("invalid-feedback");
                    $("input, select").removeClass('is-invalid');

                    $.each(response.errors, function(key, value) {
                        $("#" + key)
                            .addClass("is-invalid")
                            .siblings("p")
                            .addClass("invalid-feedback")
                            .html(value);
                    });
                }
            }
        });
    });


    /* AUTO SLUG */
    $("#title").change(function() {
        $.ajax({
            url: '{{ route("getSlug") }}'
            , type: 'GET'
            , data: {
                title: $(this).val()
            }
            , success: function(res) {
                if (res.status) $("#slug").val(res.slug);
            }
        });
    });


    /* LOAD SUB CATEGORY */
    $('#category').change(function() {
        $.ajax({
            url: '{{ route("product-subCategories.list") }}'
            , type: 'GET'
            , data: {
                category_id: $(this).val()
            }
            , success: function(res) {
                $('#sub_category').find("option").not(":first").remove();

                $.each(res.subCategories, function(_, item) {
                    $('#sub_category').append(`<option value="${item.id}">${item.name}</option>`);
                });
            }
        });
    });


    /* DROPZONE */
    Dropzone.autoDiscover = false;

    $("#image").dropzone({
        url: "{{ route('temp-images.create') }}"
        , maxFiles: 10
        , paramName: "image"
        , acceptedFiles: "image/*"
        , addRemoveLinks: true
        , headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function(file, response) {
            let html = `
            <div class="col-md-3" id="image-row-${response.image_id}">
                <div class="card mb-3">
                    <input type="hidden" name="image_array[]" value="${response.image_id}">
                    <img src="${response.ImagePath}" class="card-img-top">
                    <div class="card-body p-2">
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger btn-sm w-100">Delete</a>
                    </div>
                </div>
            </div>`;
            $("#product-gallery").append(html);
        },

        complete: function(file) {
            this.removeFile(file);
        }
    });


    /* DELETE IMAGE */
    function deleteImage(id) {
        $("#image-row-" + id).remove();
    }

</script>
@endsection
