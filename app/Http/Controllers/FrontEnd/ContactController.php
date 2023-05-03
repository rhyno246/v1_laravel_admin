<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Menu;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $menu , $gallery;
    public function __construct( Menu $menu , Gallery $gallery)
    {
        $this->menu = $menu;
        $this->gallery = $gallery;
    }
    public function index () {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        return view('frontend.pages.contact.index' , compact( 'menu' , 'gallery'));
    }
}
