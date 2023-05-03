<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCreateUsers;
use App\Http\Requests\RequestEditUser;
use App\Models\Role;
use App\Models\User;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminSettingController extends Controller
{
    use DeleteModelTrait , DeleteSelectedTrait;
    private $role;
    private $user;
    public function __construct(Role $role , User $user)
    {
        $this->role = $role;
        $this->user = $user;   
    }
    public function index (){
        $user = $this->user->latest()->get();
        return view('backend.pages.settings.index', compact('user'));
    }
    public function create () {
        $role = $this->role->latest()->get();
        return view('backend.pages.settings.create', compact('role'));
    }

    public function store (RequestCreateUsers $request) {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                "name"=> $request->name,
                "password" => Hash::make($request->password),
                'password_dehash' =>$request->password,
                "email" => $request->email
            ]);
            $user->rolesInstance()->attach($request->role_id); // belongtomany tao moi thi attach
            DB::commit();
            return redirect()->route('settings.index')->with('message' ,  'Tạo tài khoản thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
    public function edit($id){
        $role = $this->role->all();
        $userDetail = $this->user->find($id);
        $roleOfUser = $userDetail->rolesInstance;
        return view('backend.pages.settings.edit', compact('userDetail', 'role' ,'roleOfUser'));
    }
    public function update(RequestEditUser $request ,$id){
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'password_dehash' => $request->password,
                'email' => $request->email
            ]);
            $user = $this->user->find($id);
            $user->rolesInstance()->sync($request->role_id); // belongtomany tao moi thi sync
            DB::commit();
            return redirect()->route('settings.index')->with('message' , 'Cập nhật tài khoản thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->user);
    } 

    public function deleteSelected(Request $request){
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->user);
        }
    }
    
}
