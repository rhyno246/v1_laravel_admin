<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use App\Models\Customer;
use App\Models\Gallery;
use App\Models\Menu;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    use StorageImageTrait;
    private $customer,  $menu, $gallery , $coupons;
    public function __construct(Customer $customer, Menu $menu, Gallery $gallery , Coupons $coupons)
    {
        $this->customer = $customer;
        $this->menu = $menu;
        $this->gallery = $gallery;
        $this->coupons = $coupons;
    }
    public function login()
    {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id', 0)->get();
        return view('frontend.pages.login.login', compact('menu', 'gallery'));
    }

    public function register()
    {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id', 0)->get();
        return view('frontend.pages.login.register', compact('menu', 'gallery'));
    }

    public function loginPost(Request $request)
    {
        $user =  $this->customer->where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->name);
                $request->session()->put('users', $user);
                return redirect()->route('home');
            } else {
                return back()->with('fail', 'Bạn nhập sai email hoặc password');
            }
        } else {
            return back()->with('fail', 'Tài khoản này chưa đăng kí');
        }
    }


    public function registerPost(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                "name" => $request->name,
                "password" => Hash::make($request->password),
                'password_dehash' => $request->password,
                "email" => $request->email,
                'phone' => $request->phone
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'src', 'customers');
            if (!empty($dataUploadFeatureImage)) {
                $data['src'] = $dataUploadFeatureImage['file_path'];
                $data['image_name'] = $dataUploadFeatureImage['file_name'];
            }
            $this->customer->create($data);
            $request->session()->put('loginId', $data['name']);
            DB::commit();
            return redirect()->route('login')->with('message', 'Đăng ký thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }


    public function changePassword (Request $request , $id) {
        $user =  $this->customer->where('id', $id)->first();
        if($request->old_password == $user->password_dehash){
            $this->customer->find($id)->update([
                'password' => Hash::make($request->new_password),
                'password_dehash' => $request->new_password
            ]);
            return redirect()->route('users.index', $id)->with('message', 'Đổi mật khẩu thành công');
        }else {
            return redirect()->route('users.index', $id)->with('fail', 'Mật khẩu cũ không chính xác');
        }
    } 



    public function logout()
    {
        if (session()->has('loginId')) {
            session()->pull('loginId');
            session()->pull('users');
            return redirect()->route('login');
        }
    }


    public function profile($id)
    {
        $user = $this->customer->find($id);
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id', 0)->get();
        $user_coupons = $this->coupons->where('customer_group', $user->role)->get();
        return view('frontend.pages.users.profile', compact('user', 'menu', 'gallery' , 'user_coupons'));
    }

    public function update (Request $request , $id)
    {
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
            $user = $this->customer->find($id);
            $request->session()->put('loginId', $user->name);
            $request->session()->put('users', $user);
            DB::commit();
            return redirect()->route('users.index', $id)->with('message' , 'Cập nhật thông tin thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }


    public function forgot () {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id', 0)->get();
        return view('frontend.pages.login.forgot', compact('menu', 'gallery'));
    }

    public function forgotPost (Request $request){
        $token = Str::random(64);
        $email = $request->email;
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);
        $action_link = route('reset', ['token' => $token, 'email'=>$email]);
        $body = "Chúng tôi nhận được yêu cầu thay đổi password từ bạn với email là " . $email . ' ' . "Bạn có thể reset lại password bằng cách nhấn vào link phía dưới";
        Mail::send('frontend.pages.login.template', ['action_link' => $action_link, 'body' => $body], function ($message) use ($request) {
            $message->from('test@gmail.com', 'ShopOnline');
            $message->to($request->email, 'ShopOnline')->subject('ShopOnline reply reset password');
        });
        return back()->with('success', 'Chúng tôi có email reset lại password mới cho bạn , vui lòng kiểm tra hộp thư mail hoặc trong thư rác');
    }


    

    public function reset (Request $request , $token = null) {
        $gallery = $this->gallery->latest()->get();
        $menu = $this->menu->where('parent_id', 0)->get();
        return view('frontend.pages.login.reset' , compact('menu', 'gallery'))->with(['token' => $token, 'email' => $request->email]);
    }
    public function resetPost (Request $request){
        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();
        if(!$check_token){
            return back()->with('fail' , 'Invalid token');
        }else{
            $this->customer->where('email',$request->email)->update([
                'password' => Hash::make($request->new_password)
            ]);
            DB::table('password_resets')->where('email', $request->email)->delete();
            return redirect()->route('login')->with('message', 'Bạn đã reset password thành công , bạn có thể sử dụng password vừa reset để đăng nhập lại')->with('verifyEmail' ,$request->email);
        }
    }
}
