<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function frontend(){
        $latestProduct = Product::with(['Category', 'SubCategory', 'ProductAttribute'])->latest()->get();
        return view('Frontend.main', [
            'latest_products' => $latestProduct,
        ]);
    }

    function singleProduct($slug){
        $product = Product::where('slug', $slug)->first();
        $productAttri = ProductAttribute::where('product_id', $product->id )->get();
        $collect = collect($productAttri);
        $groupby = $collect->groupBy('color_id');
        return view('Frontend.pages.single-products', [
           'singleProducts' => $product,
           'groupByColor' => $groupby,
        ]);
    }

    function getProductSize($colorId, $productId){
        $sizes = ProductAttribute::where('color_id', $colorId )->where('product_id', $productId)->get();
        return response()->json($sizes);
    }

    function getProductSize2($colorId, $productId){
        $sizes = ProductAttribute::where('color_id', $colorId )->where('product_id', $productId)->get();
        return response()->json($sizes);
    }

    // function getProductSizeModal($color, $product){
    //     $sizes = ProductAttribute::where('color_id', $color )->where('product_id', $product)->get();
    //     return response()->json($sizes);
    // }

    function shop(){
        return view('frontend.pages.shop', [
            'categories' => Category::with('Product')->orderBy('category_name', 'asc')->get(),
            'products' => Product::with(['Category', 'ProductAttribute', 'SubCategory'])->latest()->get(),
        ]);
    }

    function blogs(){
        return view('Frontend.pages.blogs',[
            'blogs' => Blog::latest()->get(),

        ]);
    }

    function singleBlog($slug){
        return view('Frontend.pages.single-blog',[
            'singleBlogs' => Blog::where('slug', $slug)->first(),
            'categories' => Category::orderBy('category_name', 'asc')->get(),
            'blogs' => Blog::latest()->limit(5)->get(),
        ]);
    }

}
