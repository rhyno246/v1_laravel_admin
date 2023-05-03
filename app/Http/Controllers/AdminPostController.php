<?php

namespace App\Http\Controllers;

use App\Components\CategoryRecusive;
use App\Http\Requests\RequestPost;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTags;
use App\Traits\ChangeStatusTrait;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    use StorageImageTrait , ChangeStatusTrait , DeleteModelTrait , DeleteSelectedTrait;
    private $category;
    private $post;
    private $post_tag;
    public function __construct(PostCategory $category , Post $post , PostTags $post_tag)
    {
        $this->category = $category;
        $this->post = $post;
        $this->post_tag = $post_tag;
    }
    public function getCategory ($parentId) {
        $data = $this->category->all();
        $recusive = new CategoryRecusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    public function index () {
        $data = $this->post->latest()->get();
        return view('backend.pages.post.index', compact('data'));
    }
    public function create () {
        $htmlOption = $this->getCategory($parentId = '');
        $post_tag = $this->post_tag->latest()->get();
        return view('backend.pages.post.create', compact('htmlOption' , 'post_tag'));
    }

    public function store (RequestPost $request) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'categories_id' => '',
                'content' => '',
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request ,'feature_image_path' , 'post');
            if(!empty($dataUploadFeatureImage)){
                $data['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $data['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            if(!empty($request->content)){
                $data['content'] = $request->content;
            }
            if(!empty($request->categories_id)){
                $data['categories_id'] = $request->categories_id;
            }

            $tagsIds = [];
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagsIds[] = $tagItem;
                }
            }
            $post = $this->post->create($data);
            $post->tags()->attach($tagsIds);
            DB::commit();
            return redirect()->route('post.index')->with('message' , 'Tạo bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit ($id){
        $data = $this->post->find($id);
        $htmlOption = $this->getCategory($data->categories_id);
        $post_tag = $this->post_tag->latest()->get();
        return view('backend.pages.post.edit', compact('data', 'htmlOption','post_tag'));
    }


    public function update (RequestPost $request , $id) {
        try {
            DB::beginTransaction();
            $dataUpdated = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'categories_id' => '',
                'content' => '',
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request ,'feature_image_path' , 'post');
            if(!empty($dataUploadFeatureImage)){
                $dataUpdated['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataUpdated['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            if(!empty($request->content)){
                $dataUpdated['content'] = $request->content;
            }
            if(!empty($request->categories_id)){
                $dataUpdated['categories_id'] = $request->categories_id;
            }
            $this->post->find($id)->update($dataUpdated);
            $post = $this->post->find($id);

            $tagsIds = [];
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagsIds[] = $tagItem;
                }
            }
            $post->tags()->sync($tagsIds);
            DB::commit();
            return redirect()->route('post.index')->with('message' ,'Cập nhật bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }



    public function delete ($id){
        $data = $this->post->find($id);
        $tagsIds = $data->tags;
        $data->tags()->detach($tagsIds);
        return $this->deleteModelTrait($id, $this->post);
    }

    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            $data = $this->post->find($request->ids);

            foreach ( $data as $item){
                $tagsIds = $item->tags;
                $item->tags()->detach($tagsIds);
            }

            return $this->deleteSelectedTrait($request->ids , $this->post);
        }
    }


    public function changeStatusShow (Request $request ,$id){
        if($request->ajax()){
            return $this->changeStatusTrait($this->post , $id , 'status' , $request->status );
        }

    }
    public function changeStatusHome (Request $request ,  $id) {
        if($request->ajax()){
            return $this->changeStatusTrait($this->post , $id , 'is_show_home' , $request->status );
        }
    }
}
