<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/'. $folderName .'/'. auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => $url = Storage::url($filePath),
            ];
            return $dataUploadTrait;
        }
        return null;
    }
    public function storageTraitUploadMultiple($file, $folderName)
    {
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/'. $folderName .'/'. auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
    }
}
