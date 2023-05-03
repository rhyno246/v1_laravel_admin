<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $category , $menu , $services , $gallery;
    public function __construct(Category $category , Menu $menu , Gallery $gallery , Services $services)
    {
        $this->category = $category;
        $this->services = $services;
        $this->menu = $menu;
        $this->gallery = $gallery;
    }
    public function index () {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $service = $this->services->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        return view('frontend.pages.service.index' , compact('category', 'service' , 'menu' , 'gallery'));
    }
    public function detail ($slug) {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        $service = $this->services->where('slug', $slug)->first();
        return view('frontend.pages.service.detail' , compact('category' , 'menu' , 'service' , 'gallery'));
    }
}
