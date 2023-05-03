<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestComtomerEdit;
use App\Models\Customer;
use App\Models\RoleCustomer;
use App\Traits\ChangeStatusTrait;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminCustommerController extends Controller
{
    use StorageImageTrait, DeleteModelTrait,DeleteSelectedTrait ,ChangeStatusTrait;
    private $customer;
    public function __construct(Customer $customer , RoleCustomer $role_customer)
    {
        $this->customer = $customer;
        $this->role_customer = $role_customer;
    }
    public function index () {
        $data = $this->customer->latest()->get();
        $role_customer = $this->role_customer->latest()->get();
        return view('backend.pages.customer.index', compact('data', 'role_customer'));
    }

    

    public function edit($id){
        $users = $this->customer->find($id);
        $role_customer = $this->role_customer->latest()->get();
        return view('backend.pages.customer.edit' , compact('users' , 'role_customer'));
    }
    public function update(RequestComtomerEdit $request ,  $id){
        try {
            DB::beginTransaction();
            $data = [
                "name"=> $request->name,
                "password" => Hash::make($request->password),
                'password_dehash' =>$request->password,
                "email" => $request->email,
                'phone' => $request->phone,
                'role' => $request->role
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'src', 'customers');
            if (!empty($dataUploadFeatureImage)) {
                $data['src'] = $dataUploadFeatureImage['file_path'];
                $data['image_name'] = $dataUploadFeatureImage['file_name'];
            }
            $this->customer->find($id)->update($data);
            DB::commit();
            return redirect()->route('customer.index')->with('message' , 'Bạn đã chỉnh sửa khách thàng công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->customer);
    } 
    public function changeStatusShow (Request $request ,$id){
        if($request->ajax()){
            return $this->changeStatusTrait($this->customer , $id , 'status' , $request->status );
        }

    }

    public function deleteSelected(Request $request){
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->customer);
        }
    }
}
