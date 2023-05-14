<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;

class ShopController extends Controller
{


    public function index() {
        $pagination = 12;
        if(request()->category) {
            $category = Category::where('slug', request()->category)->get()->first();
            $products = Product::where('category_id', $category->id);
            $categoryName = $category->name;
        } else if(request()->tag) {
            $tag = Tag::where('slug', request()->tag)->get()->first();
            $products = $tag->products();
            $tagName = $tag->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Featured';
        }
        if(request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } else if(request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = $products->inRandomOrder()->paginate($pagination);
        }
        $categories = Category::all();
        $tags = Tag::all();
        return view('shop')->with([
            'products' => $products,
            'categories'=> $categories,
            'tags'=> $tags,
        'categoryName' => $categoryName ?? null,
            'tagName' => $tagName ?? null
            ]);
    }

    public function show($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $images = json_decode($product->images);
        $mightLike = Product::where('slug', '!=', $product->slug)->mightAlsoLike()->get();
        $avis = Avis::query()->where('product_id', $product->id)->get();
        $stockLevel = $this->getStockLevel($product->quantity);
        return view('product')->with([
            'product' => $product,
            'mightLike' => $mightLike,
            'images' => $images,
            'stockLevel' => $stockLevel,
            'avis' => $avis
        ]);
    }

    public function search($query) {
        if(strlen($query) < 3) return back()->with('error', 'minimum query length is 3');
        $products = Product::search($query)->paginate(10);
        return view('search')->with(['products' => $products, 'query' => $query]);
    }

    protected function getStockLevel($quantity) {
        if($quantity > 0) {
            return 'In Stock';
        } else if($quantity <=0 && $quantity > 0) {
            return 'Low Stock';
        } else {
            return 'Out Of Stock';
        }
    }

    protected function str_limit($string, $limit) {
        return strlen($string) > $limit ? substr($string, 0, $limit) . ' ...' : $string;
    }


}
