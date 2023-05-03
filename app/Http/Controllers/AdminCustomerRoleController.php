<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCustommerRole;
use App\Models\Customer;
use App\Models\RoleCustomer;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminCustomerRoleController extends Controller
{
    use DeleteModelTrait;
    private $role_customer;
    private $customer;
    public function __construct(RoleCustomer $role_customer, Customer $customer)
    {
        $this->role_customer = $role_customer;
        $this->customer = $customer;
    }
    public function index () {
      
    }
    public function create () {
        return view('backend.pages.customer-role.create');
    }

    public function store (RequestCustommerRole $request){
        try {
            DB::beginTransaction();
            $this->role_customer->firstOrCreate([
                'role' => $request->role
            ]);
            DB::commit();
            return redirect()->route('customer.index')->with('message' , 'Bạn đã tạo nhóm khách thàng công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit($id){
        $data = $this->role_customer->find($id);
        return view('backend.pages.customer-role.edit' , compact('data'));
    }
    public function update(RequestCustommerRole $request ,$id){
        try {
            DB::beginTransaction();
            $this->role_customer->find($id)->update([
                'role' => $request->role
            ]);
            DB::commit();
            return redirect()->route('customer.index')->with('message' , 'Bạn đã cập nhật nhóm khách thàng công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function delete ($id){
        $data = $this->role_customer->find($id);
        $this->customer->where('role', $data->role)->update([
            'role' => 'normal'
        ]);
        return $this->deleteModelTrait($id, $this->role_customer);
    } 
}
