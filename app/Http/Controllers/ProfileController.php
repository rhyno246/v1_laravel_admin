<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAvatar;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{   
    use StorageImageTrait;
    private $user;
    private $user_avatar;
    public function __construct(User $user , UserAvatar $user_avatar)
    {   
        $this->user = $user;
        $this->user_avatar = $user_avatar;
    }
    public function index () {
        $users = Auth::user();
        $avartar = $this->user_avatar->where('user_id', $users->id)->first();
        Session::put('avartar', $avartar);
        return view('backend.pages.profile.index' ,compact('users', 'avartar'));
    }

    public function update (Request $request , $id) {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $dataUploadFeatureImage = $this->storageTraitUpload($request ,'image_path' , 'avartars');
            if(!empty($dataUploadFeatureImage)){
                $this->user_avatar->where('user_id', $id)->delete();
                $this->user->avartar()->firstOrCreate([
                    'src'=>$dataUploadFeatureImage['file_path'],
                    'image_name'=>$dataUploadFeatureImage['file_name'],
                    'user_id' => auth()->user()->id
                ]);
            }
            DB::commit();
            return redirect()->route('profile.index')->with('message' ,  'Cập nhât tài khoản thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }
}
