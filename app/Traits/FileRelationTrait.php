<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 8/16/19
 * Time: 7:58 PM
 */

namespace AttendanceSystem\Traits;




trait FileRelationTrait {

    public function set_relation($model, $relationColumn, $file_ids, $id) {

        $flag = false;

        foreach ($file_ids as $f) {

            $model = new $model;
            $model->timestamps = false;
            $model->image_id = $f;
            $model->$relationColumn = $id;

            if($model->save()) {
                $flag = true;
            }

        }

        if($flag){
            return true;
        } else {
            return false;

        }

    }
}