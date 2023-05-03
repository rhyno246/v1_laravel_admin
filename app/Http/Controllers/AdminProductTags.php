<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPostTags;
use App\Models\ProductTags;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminProductTags extends Controller
{
    use DeleteModelTrait, DeleteSelectedTrait;
    private $product_tag;
    public function __construct(ProductTags $product_tag)
    {
        $this->product_tag = $product_tag;
    }
    public function index () {
        $data = $this->product_tag->latest()->get();
        return view('backend.pages.tags.product.index', compact('data'));
    }
    public function create () {
        return view('backend.pages.tags.product.create');
    }
    public function store (RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $this->product_tag->firstOrCreate([
                "name" => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('tags.product.index')->with('message' , 'Tạo tags thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }

    }


    public function edit($id){
        $data = $this->product_tag->find($id);
        return view('backend.pages.tags.product.edit', compact('data'));
    }

    public function update ($id , RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $this->product_tag->find($id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('tags.product.index')->with('message-edit' , 'Bạn đã cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->product_tag);
    }
  
    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->product_tag);
        }
    }
}
