<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Post;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $category , $menu , $news , $gallery;
    public function __construct(Category $category , Menu $menu , Gallery $gallery , Post $news)
    {
        $this->category = $category;
        $this->news = $news;
        $this->menu = $menu;
        $this->gallery = $gallery;
    }
    public function index () {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $news = $this->news->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        return view('frontend.pages.news.index' , compact('category', 'news' , 'menu' , 'gallery'));
    }
    public function detail ($slug) {
        $category = $this->category->where('parent_id' , 0)->get();
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        $news = $this->news->where('slug', $slug)->first();
        return view('frontend.pages.news.detail' , compact('category' , 'menu' , 'news' , 'gallery'));
    }
}
