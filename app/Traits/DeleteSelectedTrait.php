<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait DeleteSelectedTrait
{
    public function deleteSelectedTrait ($ids, $model){
        try {
            $model->whereIn('id', $ids)->delete();
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
