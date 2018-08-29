<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
      $this->middleware('permission:products.index')->only(['index', 'getProducts']);
      $this->middleware('permission:products.create')->only(['create', 'store']);
      $this->middleware('permission:products.show')->only('show');
      $this->middleware('permission:products.edit')->only(['edit', 'update']);
      $this->middleware('permission:products.destroy')->only('destroy');
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $products = Product::all();
      return view('products.index');
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $product = New Product();
      return view('products.create', compact('product'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      //
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\Product $product
    * @return \Illuminate\Http\Response
    */
   public function show(Product $product)
   {
      return view('products.show', compact('product'));
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Product $product
    * @return \Illuminate\Http\Response
    */
   public function edit(Product $product)
   {
      return view('products.edit', compact('product'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request $request
    * @param  \App\Product $product
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Product $product)
   {
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Product $product
    * @return \Illuminate\Http\Response
    */
   public function destroy(Product $product)
   {
      /*Charles antes de poner la logica para eliminar config. el eliminado suave en los modales*/
   }

   /**
    * Obtiene lista de productos.
    *
    * @param  \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
   public function getProducts(Request $request)
   {
      $products = Product::all();
      return Datatables::of($products)
         ->editColumn('name', function (Product $product) {
            if (strlen($product->name) > 40)
               return substr($product->name, 0, 40) . '...';
            else
               return $product->name;
         })
         ->editColumn('description', function (Product $product) {
            if (strlen($product->description) > 40)
               return substr($product->description, 0, 40) . '...';
            else
               return $product->description;
         })
         ->addColumn('action', 'products.partials.btn-action')
         ->make(true);
   }
}
