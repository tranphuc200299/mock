<?php

namespace App\Repositories\MediaRepository;

use App\Repositories\BaseRepository;
use App\Models\Company;
use App\Models\Media;

class MediaRepository extends BaseRepository implements MediaRepositoryInterface
{
    public function getModel(): string
    {
        return Media::class;
    }
    public function getMediaPagination($limit)
    {
        return $this->model->paginate($limit);
    }

    public function saveFileUploadCompany($request){
        $fileUpload = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $store_path = "upload/files";
            $name = md5(uniqid(rand(), true)) . str_replace(' ', '-', $file->getClientOriginalName());
            $path = $store_path .'/'. $name;
            $modelType = Company::class;

            $fileUpload = $this->model->create([
                "modelable_id" => $request->id,
                "modelable_type" => $modelType,
                "model_type" => Company::MODEL_TYPE,
                "media_type" => 'file',
                "path" => $path,
                "title" => $file->getClientOriginalName()
            ]);
            if ($fileUpload){
                $file->move(public_path('/' . $store_path), $name);
            }
            return $fileUpload;
        }
        return $fileUpload;
    }
    public function getFileUploadedById($id, $modelbleType, $modelType){
        return $this->model->where('modelable_id', $id)
                        ->where('modelable_type', $modelbleType)
                        ->where('model_type', $modelType)
                        ->get();
    }

}
