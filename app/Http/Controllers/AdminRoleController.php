<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Models\Permissions;
use App\Models\Role;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminRoleController extends Controller
{
    use DeleteModelTrait , DeleteSelectedTrait;
    private $permission;
    private $role;
    public function __construct(Permissions $permission , Role $role)
    {
       $this->permission = $permission; 
       $this->role =$role;
    }
    public function index (){
        $data = $this->role->reorder('created_at', 'desc')->get();
        return view('backend.pages.role.index', compact('data'));
    }
    public function create (){
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        return view('backend.pages.role.create', compact('permissionParent'));
    }

    public function store( CreateRoleRequest $request ) {
        try {
            DB::beginTransaction();
            $roles = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $roles->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('role.index')->with('message' , 'Tạo vai trò thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit($id){
        $data = $this->role->find($id);
        $permissionParent = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $data->permissions;
        return view('backend.pages.role.edit' ,compact('data', 'permissionParent', 'permissionChecked'));
    }

    public function update(CreateRoleRequest $request , $id){
        try {
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('role.index')->with('message' , 'Chỉnh sửa vai trò thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ( Request $request ,$id){
        $role = $this->role->find($id);
        $role->permissions()->sync($request->permission_id);
        return $this->deleteModelTrait($id, $this->role);
    }
    public function deleteSelected (Request $request){
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->role);
        }
    }
}
