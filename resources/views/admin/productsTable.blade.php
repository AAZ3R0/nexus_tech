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
                    <td>{{ $product->product_type->name ?? 'N/A' }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        {{-- Botón VER: Asegúrate que el ID del modal es correcto --}}
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#ShowProduct{{ $product->products_id }}">Ver</button>
                        
                        {{-- Botón EDITAR: Asegúrate que el ID del modal es correcto --}}
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#EditProduct{{ $product->products_id }}">Editar</button>

                        {{-- Botón ELIMINAR: Asegúrate que el ID del modal es correcto --}}
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#DeleteProduct{{ $product->products_id }}">Eliminar</button>
                    </td>
                </tr>

                {{-- Modal SHOW (dentro del bucle) --}}
                <div class="modal fade" id="ShowProduct{{ $product->products_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detalles del producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text"><strong>ID:</strong> {{ $product->products_id }}</p>
                                        <p class="card-text"><strong>Tipo de Producto:</strong> {{ $product->product_type->name ?? 'N/A' }}</p>
                                        <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                                        <p class="card-text"><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                                        <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                        <p class="card-text"><strong>Imagen:</strong></p>
                                        <img src="{{ asset('img/products/' . $product->img_name) }}" style="max-width: 150px; height: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit modal -->
                <div class="modal fade" id="EditProduct{{ $product->products_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form action="{{ route('admin.products.update', $product->products_id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nombre del Producto:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="product_type_id" class="form-label">Tipo de Producto:</label>
                                        <select class="form-control" id="product_type_id" name="product_type_id" required>
                                            <option value="">Selecciona un tipo</option>
                                            @foreach ($productTypes as $type)
                                                <option value="{{ $type->product_type_id }}" {{ ($product->product_type_id == $type->product_type_id) ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_type_id') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Descripción:</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ $product->description }}</textarea>
                                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Precio:</label>
                                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock:</label>
                                        <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                                        @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="img_name" class="form-label">Imagen del producto:</label>
                                        {{-- Muestra la imagen actual --}}
                                        <img src="{{ asset('img/products/' . $product->img_name) }}" style="max-width: 100px; height: auto; margin-bottom: 10px;">
                                        {{-- El input de tipo 'file' no necesita 'value' --}}
                                        <input type="file" class="form-control" id="img_name" name="img_name">
                                        <small class="form-text text-muted">Deja en blanco para mantener la imagen actual.</small>
                                        @error('img_name') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning">Actualizar Producto</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete modal -->
                <div class="modal fade" id="DeleteProduct{{ $product->products_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres eliminar este producto?//</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('admin.products.destroy', $product->products_id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text"><strong>ID:</strong> {{ $product->products_id }}</p>
                                            <p class="card-text"><strong>Tipo de Producto:</strong> {{ $product->product_type->name ?? 'N/A' }}</p>
                                            <p class="card-text"><strong>Descripción:</strong> {{ $product->description }}</p>
                                            <p class="card-text"><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
                                            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }}</p>
                                            <p class="card-text"><strong>Imagen:</strong></p>
                                            <img src="{{ asset('img/products/' . $product->img_name) }}" style="max-width: 150px; height: auto;">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
                                </div>
                            </form>
                                
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}

</div>

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
                                <option value="{{ $type->product_type_id }}" {{ old('product_type_id') == $type->product_type_id ? 'selected' : '' }}>
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