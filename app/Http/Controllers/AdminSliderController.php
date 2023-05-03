<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPostTags;
use App\Models\Slider;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSliderController extends Controller
{
    use DeleteModelTrait, DeleteSelectedTrait, StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {   
        $this->slider = $slider;
    }

    public function index () {
        $data = $this->slider->latest()->get();
        return view('backend.pages.slider.index', compact('data'));
    }



    public function create () {
        return view('backend.pages.slider.create');
    }
    public function store (RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataImageUploaded = $this->storageTraitUpload($request, 'feature_image_path', 'slider');
            if(!empty($dataImageUploaded)){
                $data['image_name'] = $dataImageUploaded['file_name'];
                $data['image_path'] = $dataImageUploaded['file_path'];
            }
            $this->slider->create($data);
            DB::commit();
            return redirect()->route('slider.index')->with('message' , 'Tạo slider thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }

    }


    public function edit($id){
        $data = $this->slider->find($id);
        return view('backend.pages.slider.edit', compact('data'));
    }

    public function update ($id , RequestPostTags $request) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
            ];
            $dataImageUploaded = $this->storageTraitUpload($request, 'feature_image_path', 'slider');
            if(!empty($dataImageUploaded)){
                $data['image_name'] = $dataImageUploaded['file_name'];
                $data['image_path'] = $dataImageUploaded['file_path'];
            }

            $this->slider->find($id)->update($data);
            DB::commit();
            return redirect()->route('slider.index')->with('message-edit' , 'Bạn đã cập slider thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->slider);
    }
  
    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->slider);
        }
    }
}
