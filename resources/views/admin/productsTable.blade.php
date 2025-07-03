@extends('layout.index')
@section('content')

<div class="container">
    <h2>Listado de Productos</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#CreateProduct">Crear Nuevo Producto</button>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo de Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->products_id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->productType->name ?? 'N/A' }}</td> {{-- Muestra el nombre del tipo de producto --}}
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('admin.products.show', $product->products_id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.products.edit', $product->products_id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.products.destroy', $product->products_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }} {{-- Para la paginación --}}

</div>

<!-- Modal CREATE -->
<div class="modal fade" id="CreateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_type_id" class="form-label">Tipo de Producto:</label>
                        <select class="form-control" id="product_type_id" name="product_type_id" required>
                            <option value="">Selecciona un tipo</option>
                            @foreach ($productTypes as $type)
                                <option value="{{ $type->product_type_id }} {{ old('product_type_id') == $type->product_type_id ? 'selected' : '' }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_type_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Precio:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" required>
                        @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="img_name" class="form-label">Imagen del producto:</label>
                        <input type="file" class="form-control" id="img_name" name="img_name" value="{{ old('img_name') }}">
                        @error('img_name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        
        </div>
    </div>
</div>
@endsection