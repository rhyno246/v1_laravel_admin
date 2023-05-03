<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Post;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class AdminDashBoardController extends Controller
{
    private $products;
    private $posts;
    private $customer;
    public function __construct(Products $products , Post $posts , Customer $customer)
    {
        $this->products = $products;
        $this->posts = $posts;
        $this->customer = $customer;
    }
    public function index () {
        $product = $this->products->latest()->get();
        $post = $this->posts->latest()->get();
        $data = $this->customer->latest()->get();
        // $product_chart = $this->products->select(
        //     DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name")
        // )->whereYear('created_at', date('Y'))->groupBy('month_name')->get();
        

        $product_chart = $this->products->select(
            DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as date")
        )->whereYear('created_at', date('Y'))->groupBy('date')->get();
        
        $post_chart = $this->posts->select(
            DB::raw("COUNT(*) as count"), DB::raw("DATE(created_at) as date")
        )->whereYear('created_at', date('Y'))->groupBy('date')->get();


        
        return view('backend.pages.dashboard', compact('product' , 'post' , 'product_chart' , 'post_chart' , 'data'));
    }
}
