<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Products;
use App\Models\Slider;

class HomeController extends Controller
{   
    private $slider, $category , $menu , $products, $gallery;
    public function __construct(Slider $slider, Category $category , Products $products, Menu $menu , Gallery $gallery)
    {
        $this->slider = $slider;
        $this->category = $category;
        $this->gallery = $gallery;
        $this->products = $products;
        $this->menu = $menu;
    }
    public function index () {
        $slider = $this->slider->latest()->get();
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $product_hot = $this->products->where('is_show_home' , 1)->latest()->get();
        $product_recommended = $this->products->latest('view_count' , 'desc')->take(12)->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        return view('frontend.pages.home.index' , compact('slider', 'category', 'product_hot' , 'product_recommended' , 'menu' , 'gallery'));
    }
}
