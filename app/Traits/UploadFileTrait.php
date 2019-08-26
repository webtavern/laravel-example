<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 8/15/19
 * Time: 10:35 PM
 */
namespace AttendanceSystem\Traits;


use AttendanceSystem\Image;
use Illuminate\Support\Facades\Auth;


trait UploadFileTrait
{

    public function multiple($images)
    {

        $ids = [];

        foreach ($images as $image){
            $path = $image->store('uploads', 'public');

            $model = new Image();

            $model->path = $path;
            $model->user_id = Auth::user()->id;
            $model->save();

            $ids[] = $model->id;

        }

        return $ids;

    }
}