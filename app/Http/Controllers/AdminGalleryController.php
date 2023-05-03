<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestGallery;
use App\Models\Gallery;
use App\Models\GalleryImages;
use App\Traits\ChangeStatusTrait;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminGalleryController extends Controller
{
    use StorageImageTrait, DeleteModelTrait, ChangeStatusTrait;
    private $gallery;
    private $gallery_image;
    public function __construct(Gallery $gallery , GalleryImages $gallery_image)
    {
        $this->gallery = $gallery;
        $this->gallery_image = $gallery_image;
    }

    public function index()
    {
        $gallerys = $this->gallery->latest()->get();
        return view('backend.pages.gallery.index', compact('gallerys'));
    }
    public function create()
    {
        return view('backend.pages.gallery.create');
    }

    public function store(RequestGallery $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'gallerys');
            if (!empty($dataUploadFeatureImage)) {
                $data['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $data['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $galleries = $this->gallery->firstOrCreate($data);

            if($request-> hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $img = $this->storageTraitUploadMutiple($fileItem , 'gallerys');
                    $galleries->images()->create([
                        'src'=>$img['file_path'],
                        'image_name'=>$img['file_name']
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('gallerys.index')->with('message', 'Tạo hình ảnh thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit($id)
    {
        $data = $this->gallery->find($id);
        return view('backend.pages.gallery.edit' , compact('data'));
    }

    public function view ($id){
        $view = $this->gallery->find($id);
        return view('backend.pages.gallery.view', compact('view'));
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->gallery);
    }
    
    public function deleteThumbnail ( Request $request , $id){
        if($request->ajax()){
            return $this->deleteModelTrait($id, $this->gallery_image);
        } 
    } 



    public function update(Request $request , $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'gallerys');
            if (!empty($dataUploadFeatureImage)) {
                $data['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $data['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->gallery->find($id)->update($data);
            $galleries = $this->gallery->find($id);

            if($request-> hasFile('image_path')){
                foreach($request->image_path as $fileItem) {
                    $imageDetail = $this->storageTraitUploadMutiple($fileItem, 'gallerys');
                    $galleries->images()->firstOrCreate([
                        'src'=>$imageDetail['file_path'],
                        'image_name'=>$imageDetail['file_name']
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('gallerys.index')->with('message', 'Tạo hình ảnh thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function changeStatusShow (Request $request ,$id){
        if($request->ajax()){
            return $this->changeStatusTrait($this->gallery , $id , 'status' , $request->status );
        }
    }
}
