<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Importa el modelo Product
use App\Models\ProductType; // Importa el model ProductType
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_type')->paginate(10); //carga los tipos de productos
        $productTypes = ProductType::all(); //carga los tipos de productos
        return view('admin.productsTable', compact('products', 'productTypes')); //envía los datos a la vista
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'name' => 'required|string|max:100',
            'product_type_id' => 'required|exists:product_types',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'img_name' => 'required|image|mimes:jpg,jpeg,png|max:2040',
        ]);

        $filename = 'default.png'; //Valor por defecto si no hay imagen

        //Subir foto del producto
        if($request->hasFile('img_name')){
            $file = $request->file('img_name');
            $filename = time() . '_' . $file->getClientOriginalName();
            //Guarda la imagen en el disco 'public' dento de la carpeta 'img/products'
            $file->storeAs('public/img/products', $filename);
        }
        

        Product::create([
            'name' => $request->name,
            'product_type_id' => $request->product_type_id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'img_name' => $filename,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('admin.products.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
