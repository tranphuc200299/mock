<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageImagetraits
{
    public function storageTraitUploadMutible($fileItem, $folderName)
    {
        $fileNameHash = Str::random(20) . '.' . $fileItem->getClientOriginalName();
        $store_path = "upload/images";
        $path = $store_path .'/'. $fileNameHash;
        $fileItem->move(public_path('/' . $store_path), $fileNameHash);
        return [
            'file_name' =>  $fileItem->getClientOriginalName(),
            'file_path' => $path
        ];
    }
}
