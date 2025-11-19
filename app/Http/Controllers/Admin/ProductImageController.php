<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    public function update(Request $request)
{
    $image = $request->file('image');

    if (!$image) {
        return response()->json([
            'status' => false,
            'message' => 'No image uploaded'
        ]);
    }

    $ext = $image->getClientOriginalExtension();
    $sourcePath = $image->getPathName();

    // Save a new ProductImage entry with temporary NULL
    $productImage = new ProductImage();
    $productImage->product_id = $request->product_id;
    $productImage->image = 'NULL';
    $productImage->save();

    // Generate unique image name
    $imageName = $request->product_id . '-' . $productImage->id . '-' . time() . '.' . $ext;
    $productImage->image = $imageName;
    $productImage->save();

    // Large Image
    $destPathLarge = public_path('uploads/products/large/' . $imageName);
    $imgLarge = Image::make($sourcePath);
    $imgLarge->resize(1400, null, function ($constraint) {
        $constraint->aspectRatio();
    });
    $imgLarge->save($destPathLarge);

    // Small Image
    $destPathSmall = public_path('uploads/products/small/' . $imageName);
    $imgSmall = Image::make($sourcePath);
    $imgSmall->fit(300, 300);
    $imgSmall->save($destPathSmall);

    // Return JSON for Dropzone preview
    return response()->json([
        'status' => true,
        'image_id' => $productImage->id,
        'ImagePath' => asset('uploads/products/large/' . $productImage->image),
        'message' => 'Image Saved successfully'
    ]);
}


    public function destroy(Request $request)
    {
        $productImage = ProductImage::find($request->id);

        if (empty($productImage)) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }

        File::delete(public_path() . '/uploads/products/large/' . $productImage->image);
        File::delete(public_path() . '/uploads/products/small/' . $productImage->image);

        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
