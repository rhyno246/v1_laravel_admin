<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait ChangeStatusTrait
{
    public function changeStatusTrait ($model , $id , $is_show , $status){
        try {
            $data = $model->find($id);
            $data->$is_show = $status;
            $data->save();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . '-------------Line : ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }
}
