<?php

namespace App\Http\Controllers;

use App\Components\CategoryRecusive;
use App\Http\Requests\RequestProductCategory;
use App\Models\Category;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminProductCategoryController extends Controller
{
    use DeleteModelTrait, DeleteSelectedTrait;
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    public function index () {
        $data = $this->category->reorder('created_at', 'desc')->get();
        return view('backend.pages.category.product.index' , compact('data'));
    }
    public function create ($parentId = '') {
        $htmlOption = $this->getCategory($parentId);
        return view('backend.pages.category.product.create' , compact('htmlOption'));
    }

    public function store(RequestProductCategory $request ){
        try {
            DB::beginTransaction();
            $this->category->firstOrCreate([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()-> route('category.product.index')->with('message' , 'Bạn đã tạo danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function getCategory ($parentId) {
        $data = $this->category->all();
        $recusive = new CategoryRecusive ($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }
    public function edit($id){
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('backend.pages.category.product.edit', compact('category' , 'htmlOption'));
    }

    public function update ($id , RequestProductCategory $request) {
        try {
            DB::beginTransaction();
            $this->category->find($id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('category.product.index')->with('message-edit' , 'Bạn đã cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
      return $this->deleteModelTrait($id, $this->category);
    }

    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->category);
        }
    }
}
