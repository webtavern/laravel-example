<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Image;
use AttendanceSystem\Repositories\ProductRepository;
use AttendanceSystem\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
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


       // return view('product.create', )
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \AttendanceSystem\Product  $product
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {

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

//        dd($assemblyList);

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
        $result = $product->fill($data)->save();

        if($result) {
            return redirect()->route('product.edit', $product->id)->with(['success' => "Успешно сохранено"]);
        } else {
            return back()->withErrors(['msg' => "Ошибка сохранения"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \AttendanceSystem\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
