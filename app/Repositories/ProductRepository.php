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

class ProductRepository {


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
     * Get product collection.
     *
     * @return Collection
     */
    public function index()
    {
        return $this->model->get();
    }

    /**
     * Get product.
     * @param $id
     * @return Product
     */

    public function getById($id) {
        return $this->model->findOrFail($id);
    }

    /**
     * Get product list for change parent assembly.
     *
     * @return Collection
     */

    public function getAssemblyList() {

        $product = $this->model->select(['title', 'assembly_id'])->get();

        $assembly_list[1] = [];

        foreach ($product as $p) {

            if($p->assembly_id != null || $p->assembly_id) {
                $n = $this->model->select(['title'])->where(['id' => $p->assembly_id])->first();
                $assembly_list[$p->assembly_id] = $n->title;
            }

        }

        return $assembly_list;
    }


}
