<?php

namespace App\Http\Controllers;

use App\Components\CategoryRecusive;
use App\Http\Requests\RequestPostCategory;
use App\Models\PostCategory;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminPostCategory extends Controller
{   
    use DeleteModelTrait, DeleteSelectedTrait;
    private $post_cate;
    public function __construct(PostCategory $post_cate)
    {
        $this->post_cate = $post_cate;
    }
    public function index () {
        $data = $this->post_cate->latest()->get();
        return view('backend.pages.category.post.index', compact('data'));
    }
    public function create ($parentId = '') {
        $htmlOption = $this->getCategory($parentId);
        return view('backend.pages.category.post.create' , compact('htmlOption'));
    }

    public function store(RequestPostCategory $request){
        try {
            DB::beginTransaction();
            $this->post_cate->firstOrCreate([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);

            DB::commit();
            return redirect()-> route('category.post.index')->with('message' , 'Bạn đã tạo danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }

    }

    public function getCategory ($parentId) {
        $data = $this->post_cate->all();
        $recusive = new CategoryRecusive ($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function edit($id){
        $category = $this->post_cate->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('backend.pages.category.post.edit', compact('category' , 'htmlOption'));
    }

    public function update ($id , RequestPostCategory $request) {
        try {
            DB::beginTransaction();
            $this->post_cate->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('category.post.index')->with('message-edit' , 'Bạn đã cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->post_cate);
    }

    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->post_cate);
        }
    }
}
