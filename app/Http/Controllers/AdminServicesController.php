<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPost;
use App\Models\Services;
use App\Traits\ChangeStatusTrait;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AdminServicesController extends Controller
{
    use StorageImageTrait , ChangeStatusTrait , DeleteModelTrait , DeleteSelectedTrait;
    private $service;
    public function __construct(Services $service)
    {
        $this->service = $service;
    }

    public function index () {
        $data = $this->service->latest()->get();
        return view('backend.pages.services.index', compact('data'));
    }
    public function create () {
        return view('backend.pages.services.create');
    }
    public function store (RequestPost $request) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
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
            $this->service->create($data);
            DB::commit();
            return redirect()->route('services.index')->with('message' , 'Tạo bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
    public function edit ($id){
        $data = $this->service->find($id);
        return view('backend.pages.services.edit', compact('data'));
    }

    public function update (RequestPost $request , $id) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
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
            $this->service->find($id)->update($data);
            DB::commit();
            return redirect()->route('services.index')->with('message' , 'Tạo bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
    public function delete ($id){
        return $this->deleteModelTrait($id, $this->service);
    }

    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->service);
        }
    }


    public function changeStatusShow (Request $request ,$id){
        if($request->ajax()){
            return $this->changeStatusTrait($this->service , $id , 'status' , $request->status );
        }

    }
    public function changeStatusHome (Request $request ,  $id) {
        if($request->ajax()){
            return $this->changeStatusTrait($this->service , $id , 'is_show_home' , $request->status );
        }
    }
}
