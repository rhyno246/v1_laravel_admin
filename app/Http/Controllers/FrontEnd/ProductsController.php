<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Products;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    private $category , $menu , $products , $gallery;
    public function __construct(Category $category , Products $products, Menu $menu , Gallery $gallery)
    {
        $this->category = $category;
        $this->products = $products;
        $this->menu = $menu;
        $this->gallery = $gallery;
    }
    public function index () {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $product = $this->products->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        return view('frontend.pages.products.index' , compact('category', 'product' , 'menu' , 'gallery'));
    }
    public function detail ($slug) {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        $product = $this->products->where('slug', $slug)->first();
        return view('frontend.pages.products.detail' , compact('category' , 'menu' , 'product' , 'gallery'));
    }
    public function addToCart ($id) {
        $product  = $this->products->find($id);
        $cart = session()->get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }else{
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->sale_price,
                'feature_image_path' => $product->feature_image_path,
                'slug' => Str::slug($product->name),
                'quantity' => 1,

            ];
        }
        session()->put('cart' , $cart);
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], 200);
    }
}
