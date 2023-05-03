<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Http\Requests\RequestCreateMenu;
use App\Models\Menu;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminMenuController extends Controller
{
    use DeleteModelTrait, DeleteSelectedTrait;
    private $menu;
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }
    public function index () {
        $data = $this->menu->latest()->get();
        return view('backend.pages.menu.index', compact('data'));
    }
    public function create ($parentId = '') {
        $htmlOption = $this->getMenus($parentId);
        return view('backend.pages.menu.create', compact('htmlOption'));
    }

    public function getMenus ($parentId){
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $htmlOption = $recusive->menuRecusive($parentId);
        return $htmlOption;
    }

    public function store (RequestCreateMenu $request){
        try {
            DB::beginTransaction();
            $this->menu->firstOrCreate([
                "name" => $request->name,
                "icon_menu" => $request->icon_menu,
                "parent_id" => $request->parent_id,
                "slug" => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()->route('menu.index')->with('message', 'Tạo menu thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->menu);
    }

    public function deleteSelected(Request $request) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->menu);
        }
    }

    public function edit($id){
        $menu = $this->menu->find($id);
        $htmlOption = $this->getMenus($menu->parent_id);
        return view('backend.pages.menu.edit', compact('menu', 'htmlOption'));
    }

    public function update(Request $request ,$id){
        try {
            DB::beginTransaction();
            $this->menu->find($id)->update([
                "name" => $request->name,
                "icon_menu" => $request->icon_menu,
                "parent_id" => $request->parent_id,
                "slug" => Str::slug($request->name)
            ]);
            DB::commit();
            return redirect()-> route('menu.index')->with('message', 'Chỉnh sửa menu thành công');;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
    
}
