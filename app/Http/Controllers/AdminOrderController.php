<?php

namespace App\Http\Controllers;

use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    use StorageImageTrait ,DeleteModelTrait , DeleteSelectedTrait;
    private $category;
    private $post;
    private $post_tag;
    public function __construct()
    {

    }
   

    public function index () {
        return view('backend.pages.order.index');
    }
    public function create () {

    }

    public function store (Request $request) {
        try {
            DB::beginTransaction();
            
            DB::commit();
            return redirect()->route('post.index')->with('message' , 'Tạo bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit ($id){

    }


    public function update (Request $request , $id) {
        try {
            DB::beginTransaction();
            
            DB::commit();
            return redirect()->route('post.index')->with('message' ,'Cập nhật bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }



    public function delete ($id){
 
    }

    public function deleteSelected ( Request $request ) {
      
    }


}
