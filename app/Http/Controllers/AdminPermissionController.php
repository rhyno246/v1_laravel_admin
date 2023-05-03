<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    private $permission;
    public function __construct( Permissions $permission )
    {
        $this->permission = $permission;
    }
    public function create () {
        return view('backend.pages.permissions.create');
    }
    function vn_to_str ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
         
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ','',$str);
        return $str;
    }

    public function store(Request $request){
        $exitsCategory = $this->permission->where('name' , $this->vn_to_str($request->module_parent))->exists();
        if($exitsCategory){
            return redirect()->route('permissions.create')->with('warning' , 'Data đã tồn tại , mời bạn tạo data khác');
        }else{
            $data = $this->permission->create([
            'name' => $this->vn_to_str($request->module_parent),
            'display_name' => $request->module_parent,
            'key_code' => $this->vn_to_str($request->module_parent) . '_' .'parent_id'
            ]);
            foreach ($request->module_child as $item){
                $this->permission->create([
                    'name' => $this->vn_to_str($item),
                    'display_name' => $item,
                    'parent_id' => $data->id,
                    'key_code' => $this->vn_to_str($request->module_parent) . '_' . $this->vn_to_str($item)
                ]);
            }
            return redirect()->route('permissions.create')->with('success' , 'Tạo thành công quyền truy cập module');
        }
    }
}
