<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; // Importa el modelo Product
use App\Models\ProductType; // Importa el model ProductType
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('product_type')->paginate(10);
        $productTypes = ProductType::all();
        return view('admin.productsTable', compact('products', 'productTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'product_type_id' => 'required|exists:product_types,product_type_id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'img_name' => 'nullable|image|mimes:jpg,jpeg,png|max:2040',
        ]);

        $filename = 'default.png';

        if($request->hasFile('img_name')){
            $file = $request->file('img_name');
            $filename = time() . '_' . $file->getClientOriginalName();
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
    public function update(Request $request, Product $product)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'product_type_id' => 'required|exists:product_types,product_type_id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'stock' => 'required|integer|min:0',
            'img_name' => 'nullable|image|mimes:jpg,jpeg,png|max:2040',
        ]);

        if ($request->hasFile('img_name')) {
            // Si se sube una nueva imagen, eliminar la antigua (si no es la por defecto)
            if ($product->img_name && $product->img_name != 'default.png') {
                Storage::delete('public/img/products/' . $product->img_name);
            }
            $file = $request->file('img_name');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/products', $filename);
            $validatedData['img_name'] = $filename; // Asignar el nuevo nombre de archivo
        } else {
            // Si NO se sube una nueva imagen, usar la imagen existente del producto.
            // Si $product->img_name es null, usar 'default.png'.
            $validatedData['img_name'] = $product->img_name ?? 'default.png';
        }

        // Ya tienes el objeto $product gracias al Route Model Binding, no necesitas Product::find($product)
        $product->update($validatedData); // Esto actualiza todos los campos de golpe

        //dd('Producto después de actualizar (recargado de DB):', $product->fresh()->toArray());

        // Redirigir a una ruta apropiada, por ejemplo, la lista de productos o el detalle del producto
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado con éxito');
        // O si quieres ir al detalle del producto:
        // return redirect()->route('admin.products.show', $product)->with('success', 'Producto actualizado con éxito');
    }

    public function destroy(Product $product)
    {
        // Implementar la lógica para eliminar la imagen del almacenamiento
        if ($product->img_name && $product->img_name != 'default.png') {
            Storage::delete('public/img/products/' . $product->img_name);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado con éxito');
    }
}
