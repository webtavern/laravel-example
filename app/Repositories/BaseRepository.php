<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/21/19
 * Time: 10:03 PM
 */

namespace AttendanceSystem\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository {

    /**
     * The Model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * Get number of records.
     *
     * @return array
     */
    public function getNumber()
    {
        $total = $this->model->count();

        $new = $this->model->whereSeen(0)->count();

        return compact('total', 'new');
    }

    /**
     * Destroy a model.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        $this->getById($id)->delete();
    }

    /**
     * Get Model by id.
     *
     * @param  int  $id
     * @return Model
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

}