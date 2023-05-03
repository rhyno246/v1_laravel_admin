<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSettingsPage;
use App\Models\SettingsPage;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminSettingPageController extends Controller
{
    use StorageImageTrait, DeleteModelTrait , DeleteSelectedTrait;
    private $setting_page;
    public function __construct(SettingsPage $setting_page)
    {
        $this->setting_page = $setting_page;
    }
    public function index () {
        $setting_page = $this->setting_page->latest()->get();
        return view('backend.pages.settings-page.index', compact('setting_page'));
    }
    public function create() {
        return view('backend.pages.settings-page.create');
    }
    public function store (RequestSettingsPage $request){
        try {
            DB::beginTransaction();
            if($request-> hasFile('config_value')){
                $data = [
                    'config_key'=> $request->config_key,
                    'config_value' => '',
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'type' => $request->type
                ];
                $dataUploadFeatureImage = $this->storageTraitUpload($request, 'config_value', 'setings_page');
                if (!empty($dataUploadFeatureImage)) {
                    $data['config_value'] = $dataUploadFeatureImage['file_path'];
                }
                $this->setting_page->create($data);
            }else{
                $this->setting_page->create([
                    'config_key'=> $request->config_key,
                    'config_value'=>$request->config_value,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'type' => $request->type
                ]);
            }
            DB::commit();
            return redirect()->route('settings-pages.index')->with('message', 'Tạo config thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }



    public function edit($id){
        $data = $this->setting_page->find($id);
        return view('backend.pages.settings-page.edit', compact('data'));
    }
    public function update(RequestSettingsPage $request ,$id){
        try {
            DB::beginTransaction();
            if($request-> hasFile('config_value')){
                $data = [
                    'config_key'=> $request->config_key,
                    'config_value' => '',
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'type' => $request->type
                ];
                $dataUploadFeatureImage = $this->storageTraitUpload($request, 'config_value', 'setings_page');
                if (!empty($dataUploadFeatureImage)) {
                    $data['config_value'] = $dataUploadFeatureImage['file_path'];
                }
                $this->setting_page->find($id)->update($data);
            }else{
                $this->setting_page->find($id)->update([
                    'config_key'=> $request->config_key,
                    'config_value'=>$request->config_value,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'type' => $request->type
                ]);
            }
            DB::commit();
            return redirect()->route('settings-pages.index')->with('message', 'Tạo config thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->setting_page);
    } 

    public function deleteSelected(Request $request){
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->setting_page);
        }
    }
}
