<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/21/19
 * Time: 10:01 PM
 */

namespace AttendanceSystem\Repositories;

use AttendanceSystem\Models\Product;

use AttendanceSystem\Traits\ImageUpload;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class ProductRepository extends BaseRepository {

    use ImageUpload;

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
     * Get product list for set parent assembly.
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

    public function store($request, $product) {

        $data = $request->all();

        $images = $request->file('images');

        if(!empty($images)) {

            $arr = $this->processingImages($images, 'product');

            $product->fill($data)->save();

            $result = $product->images()->saveMany($arr);

        } else {

            $result = $product->fill($data)->save();

        }

        return ($result) ? true : false;
    }

    public function update($request, $product) {

        $data = $request->all();

        $images = $request->file('images');

        if(!empty($images)) {

            $arr = $this->processingImages($images, 'product');

            $product->update($data);

            $result = $product->images()->sync($arr);

        } else {

            $result = $product->update($data);

        }

        return ($result) ? true : false;
    }

    public function deleteWithImages($product) {

        $images = $product->images()->get();

        foreach ($images as $image) {

            if(File::exists(public_path('storage/uploads/'.$image->name))) {

                File::delete(public_path('storage/uploads/'.$image->name));

                File::delete(public_path('storage/uploads/thumbs/'.$image->name));

            }
        }

        return ($product->images()->delete() && $product->delete()) ? true : false;

    }


}
