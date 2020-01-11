<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/21/19
 * Time: 10:01 PM
 */

namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Product;

use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository {


    /**
     * Create a new ProductRepository instance.
     *
     * @param  Product $product
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Get product list for change parent assembly.
     *
     * @return array
     */

    public function getAssemblyList() {

        $product = $this->model->select(['id','title'])->where(['is_assembly' => 1])->get();

        $assembly_list = [];

        foreach ($product as $p) {

                $assembly_list[$p->id] = $p->title;
        }

        return $assembly_list;
    }


}
