<?php

namespace AttendanceSystem\Http\Controllers;

use AttendanceSystem\Http\Requests\ProductRequest;

use AttendanceSystem\Repositories\ProductRepository;
use AttendanceSystem\Models\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{

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
     * @param  ProductRequest  $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
        $result = $this->productRepository->store($request, $product);

        if($result) {
            return redirect()->route('product.index')->with(['success' => "Product successfully saved."]);
        } else {
            return back()->withErrors(['msg' => "Saving error"])->withInput();
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
        $product = $this->productRepository->getById($id);

        if(empty($product)) {
            return back()->withErrors(['msg' => "Record id =[{$id}] not found"])->withInput();
        }

        $result = $this->productRepository->update($request, $product);

        if($result) {
            return redirect()->route('product.edit', $product->id)->with(['success' => "Product successfully saved."]);
        } else {
            return back()->withErrors(['msg' => "Saving error"])->withInput();
        }
    }

    /**
     * @param $id
     * @return mixed
     */

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id);

        if(empty($product)) {
            return back()->withErrors(['msg' => "Record id =[{$id}] not found"])->withInput();
        }

        $result = $this->productRepository->deleteWithImages($product);

        if($result) {
            return redirect()->route('product.index')->withStatus(__('Product successfully deleted.'));
        } else {
            return back()->withErrors(['msg' => "Saving error"])->withInput();
        }
    }
}
