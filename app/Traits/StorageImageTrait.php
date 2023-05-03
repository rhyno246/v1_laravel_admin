<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload ($request , $feildName , $folderName) {
        if($request->hasFile($feildName)){
            $file = $request->$feildName;
            $fileNameOrigin = $file->getClientOriginalName(); //get name file
            $fileNameHash = md5($fileNameOrigin) . '.' . $file->getClientOriginalExtension(); // get path name file
            $path = $request->file($feildName)->storeAs('public/' . $folderName . '/' . auth()->id() , $fileNameHash);
            $dataUploadTrait = [
                "file_name" => $fileNameOrigin,
                "file_path" => Storage::url($path),
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMutiple ($file , $folderName) {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = md5($fileNameOrigin) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/' . $folderName . '/' . auth()->id() , $fileNameHash);
        $dataUploadTrait = [
            "file_name" => $fileNameOrigin,
            "file_path" => Storage::url($path),
        ];
        return $dataUploadTrait;
    }

}
