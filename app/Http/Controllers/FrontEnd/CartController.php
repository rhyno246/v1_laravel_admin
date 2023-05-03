<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Gallery;
use App\Models\Menu;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $menu , $gallery , $coupons;
    public function __construct( Menu $menu , Gallery $gallery , Coupons $coupons)
    {
        $this->menu = $menu;
        $this->gallery = $gallery;
        $this->coupons = $coupons;
    }
    public function index () {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        $cart = session()->get('cart');
        return view('frontend.pages.cart.index' , compact( 'menu' , 'gallery', 'cart'));
    }
    public function update (Request $request) {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            $cart_item = view('frontend.pages.cart.components.cart_item' , compact( 'cart'))->render();
            return response()->json([
                'cart_item' => $cart_item , 
                'code' => 200,
                'message' => 'success'
            ] , 200);
        }
    }

    public function delete (Request $request) {
        if($request->id){
            $cart = session()->get('cart');
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            $cart_item = view('frontend.pages.cart.components.cart_item' , compact( 'cart'))->render();
            return response()->json([
                'cart_item' => $cart_item , 
                'code' => 200,
                'message' => 'success'
            ] , 200);
        }
    }
    public function checkout () {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id' , 0)->get();
        $cart = session()->get('cart');
        if($cart){
            return view('frontend.pages.cart.checkout' , compact( 'menu' , 'gallery', 'cart'));
        }else{
            return redirect()->route('cart.index');
        }
    }


    public function coupons (Request $request) {
        $coupons = $this->coupons->where('coupons_key' , $request->type_coupons)->first();
        if($coupons){
            session()->put('coupons', $coupons);
            return redirect()->route('cart.checkout')->with('message' , 'Áp dụng mã thành cmn công');
        }else{
            return redirect()->route('cart.checkout')->with('fail' , 'Mã không tồn tại hoặc chưa nhập mã');
        }
    }
}
