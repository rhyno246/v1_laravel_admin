<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPostTags;
use App\Models\PostTags;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminPostTags extends Controller
{   
    use DeleteModelTrait, DeleteSelectedTrait;
    private $post_tag;
    public function __construct(PostTags $post_tag)
    {
        $this->post_tag = $post_tag;
    }
    public function index () {
        $data = $this->post_tag->latest()->get();
        return view('backend.pages.tags.post.index', compact('data'));
    }
    public function create () {
        return view('backend.pages.tags.post.create');
    }
    public function store (RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $this->post_tag->firstOrCreate([
                "name" => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('tags.post.index')->with('message' , 'Tạo tags thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }

    }


    public function edit($id){
        $data = $this->post_tag->find($id);
        return view('backend.pages.tags.post.edit', compact('data'));
    }

    public function update ($id , RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $this->post_tag->find($id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('tags.post.index')->with('message-edit' , 'Bạn đã cập nhật danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->post_tag);
    }
  
    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->post_tag);
        }
    }
}
