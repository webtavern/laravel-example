<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Traits\ImageUpload;
use AttendanceSystem\Repositories\ProductRepository;
use AttendanceSystem\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    use ImageUpload;

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        parent::__construct();
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  ProductRepository $productRepository
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->index();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $assemblyList = $this->productRepository->getAssemblyList();

       return view('product.create', ['assemblyList' => $assemblyList]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();

        $data = $request->all();
        $images = $request->file('images');

        if(!empty($images)) {

            $arr = $this->processingImages($images, 'product');

            $product->fill($data)->save();

            $created_product = Product::find($product->id);

            $result = $created_product->images()->saveMany($arr);

        } else {

            $result = $product->fill($data)->save();

        }

        if($result) {
            return redirect()->route('product.index')->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \AttendanceSystem\Models\Product  $product
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductRepository $productRepository
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->getById($id);

        $assemblyList = $this->productRepository->getAssemblyList();

        return view('product.edit', ['product' => $product, 'assemblyList' => $assemblyList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(empty($product)) {
            return back()->withErrors(['msg' => "Запись id =[{$id}] не найдена"])->withInput();
        }

        $data = $request->all();
        $images = $request->file('images');

        if(!empty($images)) {

            $arr = $this->processingImages($images, 'product');

            $product->fill($data)->save();

            $created_product = Product::find($product->id);

            $result = $created_product->images()->saveMany($arr);

        } else {

            $result = $product->fill($data)->save();

        }

        if($result) {
            return redirect()->route('product.edit', $product->id)->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * @param Product $product
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->images()->delete();
        $product->delete();
        return redirect()->route('product.index')->withStatus(__('Product successfully deleted.'));
    }
}
