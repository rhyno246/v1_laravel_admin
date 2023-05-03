<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestCouponsCreate;
use App\Models\Coupons;
use App\Models\RoleCustomer;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouponsController extends Controller
{
    use DeleteModelTrait , DeleteSelectedTrait;
    private $role_customer;
    private $coupons;
    public function __construct(RoleCustomer $role_customer , Coupons $coupons)
    {
        $this->role_customer = $role_customer;
        $this->coupons = $coupons;
    }
    public function index () {
        $data = $this->coupons->latest()->get();
        return view('backend.pages.coupons.index', compact('data'));
    }
    public function create () {
        $customer_group = $this->role_customer->latest()->get();
        return view('backend.pages.coupons.create', compact('customer_group'));
    }

    public function store (RequestCouponsCreate $request){
        try {
            DB::beginTransaction();
            $data = [
                'coupons_key' => $request->coupons_key,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'coupons_value' => $request->coupons_value,
                'coupons_cart_value' => $request->coupons_cart_value,
                'customer_group' => $request->customer_group,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'coupons_price' => $request->coupons_price
            ];
            $this->coupons->firstOrCreate($data);
            DB::commit();
            return redirect()->route('coupons.index')->with('message' , 'Bạn đã tạo mã giảm giá thàng công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }

    public function edit($id){
        $data = $this->coupons->find($id);
        $customer_group = $this->role_customer->latest()->get();
        return view('backend.pages.coupons.edit' , compact('data' , 'customer_group'));
    }



    public function update(Request $request ,$id){
        try {
            DB::beginTransaction();
            $data = [
                'coupons_key' => $request->coupons_key,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'coupons_value' => $request->coupons_value,
                'coupons_cart_value' => $request->coupons_cart_value,
                'customer_group' => $request->customer_group,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'coupons_price' => $request->coupons_price
            ];
            $this->coupons->find($id)->update($data);
            DB::commit();
            return redirect()->route('coupons.index')->with('message' , 'Bạn đã cập nhật mã giảm giá thàng công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }



    

    public function delete ($id){
        return $this->deleteModelTrait($id, $this->coupons);
    } 
    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            return $this->deleteSelectedTrait($request->ids , $this->coupons);
        }
    }

}
