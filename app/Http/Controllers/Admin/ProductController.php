<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRating;
use App\Models\SubCategory;
use App\Models\TempImage;
use App\Models\Size; // Added Size model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::latest('id')->with('product_images');
        if (!empty($request->get('keyword'))) {
            $products = $products->where('title', 'like', '%' . $request->get('keyword') . '%');
        }
        $products = $products->paginate(10);
        return view('Admin.products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get(); // Fetch all sizes
        return view('Admin.products.create', compact('categories', 'brands', 'sizes'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called', ['request_data' => $request->all()]);

        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'category' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'is_featured' => 'required|in:Yes,No',
        ];

        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }

        Log::info('Validating request', ['rules' => $rules]);

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        try {
            Log::info('Validation passed. Creating product...');

            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->category_id = $request->category;
            $product->barcode = $request->barcode;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->track_qty = $request->track_qty;
            $product->is_featured = $request->is_featured;
            $product->description = $request->description;
            $product->qty = $request->qty;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->related_products = (!empty($request->related_products)) ? implode(',', $request->related_products) : '';
            $product->sizes = json_encode($request->size_id);
            $product->color_name = json_encode($request->color_name);
            $product->color_code = json_encode($request->color_code);

            Log::info('Saving product...', ['product_data' => $product]);

            $product->save();

            Log::info('Product saved!', ['product_id' => $product->id]);

            // Save gallery images
            if (!empty($request->image_array)) {
                Log::info('Processing gallery images', ['images' => $request->image_array]);

                foreach ($request->image_array as $temp_image_id) {

                    Log::info('Finding temp image...', ['temp_image_id' => $temp_image_id]);

                    $tempImageInfo = TempImage::find($temp_image_id);

                    if (!$tempImageInfo) {
                        Log::error('Temp image not found!', ['temp_image_id' => $temp_image_id]);
                        continue;
                    }

                    Log::info('Temp image found', ['temp_image' => $tempImageInfo]);

                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id . '-' . $productImage->id . '-' . time() . '.' . $ext;
                    $productImage->image = $imageName;
                    $productImage->save();

                    $sourcePath = public_path() . '/temp/' . $tempImageInfo->name;

                    Log::info('Processing image', [
                        'source_path' => $sourcePath,
                        'image_name' => $imageName
                    ]);

                    // Large Image
                    $destPath = public_path() . '/uploads/products/large/' . $imageName;
                    Image::make($sourcePath)->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destPath);

                    // Small Image
                    $destPath = public_path() . '/uploads/products/small/' . $imageName;
                    Image::make($sourcePath)->fit(300, 300)->save($destPath);

                    Log::info('Saved image variations', ['image_name' => $imageName]);
                }
            }

            Log::info('Product stored successfully!');
            session()->flash('success', 'Product added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product added successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving product', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'errors' => ['server' => 'Something went wrong while saving the product']
            ]);
        }
    }


    public function edit($productId)
    {
        $product = Product::find($productId);
        if (empty($product)) {
            session()->flash('error', 'Product not found');
            return redirect()->route('products.list');
        }

        $productImages = ProductImage::where('product_id', $product->id)->get();
        $categories = Category::orderBy('name', 'asc')->get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get(); // Fetch sizes for dropdown

        $relatedProducts = [];
        if ($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
            $relatedProducts = Product::whereIn('id', $productArray)->with('product_images')->get();
        }

        return view('Admin.products.edit', compact('product', 'categories', 'brands', 'subCategories', 'productImages', 'relatedProducts', 'sizes'));
    }

public function update($id, Request $request)
{
    $product = Product::findOrFail($id);

    $rules = [
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
        'category' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
        'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
        'track_qty' => 'required|in:Yes,No',
        'is_featured' => 'required|in:Yes,No',
    ];

    if ($request->track_qty === 'Yes') {
        $rules['qty'] = 'required|numeric|min:0';
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    // Assign fields
    $product->title = $request->title;
    $product->slug = $request->slug;
    $product->category_id = $request->category;
    $product->sub_category_id = $request->sub_category ?? null;
    $product->brand_id = $request->brand ?? null;
    $product->price = $request->price;
    $product->compare_price = $request->compare_price ?? null;
    $product->sku = $request->sku;
    $product->barcode = $request->barcode ?? null;
    $product->track_qty = $request->track_qty;
    $product->qty = $request->track_qty === 'Yes' ? $request->qty : null;
    $product->is_featured = $request->is_featured;
    $product->description = $request->description ?? null;
    $product->short_description = $request->short_description ?? null;
    $product->shipping_returns = $request->shipping_returns ?? null;
    $product->related_products = !empty($request->related_products) ? implode(',', $request->related_products) : null;
    $product->sizes = !empty($request->size_id) ? json_encode($request->size_id) : null;
            $product->color_name = json_encode($request->color_name);
            $product->color_code = json_encode($request->color_code);

    $product->save();

    return response()->json([
        'status' => true,
        'message' => 'Product updated successfully'
    ]);
}


    public function destroy($id, Request $request)
    {
        $product = Product::find($id);
        if (empty($product)) {
            session()->flash('error', 'Product not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $productImages = ProductImage::where('product_id', $id)->get();
        if (!empty($productImages)) {
            foreach ($productImages as $productImage) {
                File::delete(public_path() . '/uploads/products/large/' . $productImage->image);
                File::delete(public_path() . '/uploads/products/small/' . $productImage->image);
            }
            ProductImage::where('product_id', $id)->delete();
        }
        $product->delete();

        session()->flash('success', 'Product deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function getProducts(Request $request)
    {
        $tempProduct = [];
        if ($request->term != '') {
            $products = Product::where('title', 'like', '%' . $request->term . '%')->get();
            if ($products != null) {
                foreach ($products as $product) {
                    $tempProduct[] = ['id' => $product->id, 'text' => $product->title];
                }
            }
        }
        return response()->json([
            'tags' => $tempProduct,
            'status' => true,
        ]);
    }

    public function productRating(Request $request)
    {
        $ratings = ProductRating::select('product_ratings.*', 'products.title as productTitle')
            ->leftJoin('products', 'products.id', '=', 'product_ratings.product_id')
            ->orderBy('product_ratings.created_at', 'desc');

        if (!empty($request->get('keyword'))) {
            $ratings = $ratings->orWhere('products.title', 'like', '%' . $request->get('keyword') . '%');
            $ratings = $ratings->orWhere('product_ratings.username', 'like', '%' . $request->get('keyword') . '%');
        }
        $ratings = $ratings->paginate(10);

        return view('Admin.products.ratings', compact('ratings'));
    }

    public function changeRatingStatus(Request $request)
    {
        $rating = ProductRating::find($request->id);
        if (empty($rating)) {
            session()->flash('error', 'Rating not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        $rating->status = $request->status;
        $rating->save();

        session()->flash('success', 'Rating status changed successfully');
        return response()->json([
            'status' => true,
            'message' => 'Rating status changed successfully'
        ]);
    }
}
