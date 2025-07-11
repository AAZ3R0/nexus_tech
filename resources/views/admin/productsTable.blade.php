@extends('layout.PlantillaAdmin')
@section('content')

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container-fluid bg-primary  flex-column justify-content-center align-items-center"
    style="min-height: 100vh;">
    <br>
    <br>
    <div class="container card text-white p-5" style="background-color: #1E2A30;">
        <h2 class="text-white mb-4">Listado de Productos</h2>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="text-start mb-3">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                data-bs-target="#CreateProduct">
                <i class="bi bi-plus-lg"></i> Crear Nuevo Producto
            </button>
        </div>

        <div class="rounded overflow-hidden">
            <table class="table card-table  table-bordered border-primary mb-0  text-white"
                style="background-color: #27373F;">
                <thead>
                    <tr style="background-color: #1f2d3a;">
                        <th class="text-white" style="background-color:#1E2A30;">ID</th>
                        <th class="text-white" style="background-color:#1E2A30;">Nombre</th>
                        <th class="text-white" style="background-color:#1E2A30;">Tipo de Producto</th>
                        <th class="text-white" style="background-color:#1E2A30;">Precio</th>
                        <th class="text-white" style="background-color:#1E2A30;">Stock</th>
                        <th class="text-white" style="background-color:#1E2A30;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr style="background-color: #27373F;">
                        <td class="text-white" style="background-color: #27373F;">{{ $product->products_id }}</td>
                        <td class="text-white" style="background-color: #27373F;">{{ $product->name }}</td>
                        <td class="text-white" style="background-color: #27373F;">
                            {{ $product->product_type->name ?? 'N/A' }}</td>
                        <td class="text-white" style="background-color: #27373F;">
                            ${{ number_format($product->price, 2) }}</td>
                        <td class="text-white" style="background-color: #27373F;">{{ $product->stock }}</td>
                        <td style="background-color: #27373F;">
                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#ShowProduct{{ $product->products_id }}">
                                <i class="bi bi-card-list"></i> Ver
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#EditProduct{{ $product->products_id }}">
                                <i class="bi bi-pencil-square"></i> Editar
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#DeleteProduct{{ $product->products_id }}">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </button>
                        </td>
                    </tr>


                    {{-- Modal SHOW (dentro del bucle) --}}
                    <div class="modal fade" id="ShowProduct{{ $product->products_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Detalles del producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body border-0">
                                    <div class="card bg-dark border-0 p-3">
                                        <div class="card-body row container-fluid">

                                            <div class="col">
                                                <img class="img-fluid rounded border-0"
                                                    src="{{ asset('img/products/' . $product->img_name) }}"
                                                    style="height: auto;">
                                            </div>
                                            <div class="col-8">
                                                <div class="mb-3 text-white">
                                                    <label for="name text-white" class="form-label">No. de
                                                        producto:</label>
                                                    <input type="text" class="form-control border-0" id="name"
                                                        name="name" value="{{ $product->products_id }}" disabled
                                                        required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 text-white">
                                                    <label for="name" class="form-label">Nombre:</label>
                                                    <input type="text" class="form-control border-0" id="name"
                                                        name="name" value="{{ $product->name }}" disabled required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3 text-white">
                                                    <label for="name" class="form-label">Tipo:</label>
                                                    <input type="text" class="form-control border-0" id="name"
                                                        name="name" value="{{ $product->product_type->name ?? 'N/A' }}"
                                                        disabled required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 text-white text-white">
                                                    <label for="name" class="form-label">Descripción:</label>
                                                    <textarea class="form-control border-0"
                                                        id="exampleFormControlTextarea1" rows="3"
                                                        disabled>{{ $product->description }}</textarea>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 text-white">
                                                    <label for="name" class="form-label">Precio:</label>
                                                    <input type="text" class="form-control border-0" id="name"
                                                        name="name" value="$ {{ number_format($product->price, 2) }}"
                                                        disabled required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3 text-white">
                                                    <label for="name" class="form-label">Stock:</label>
                                                    <input type="text" class="form-control border-0" id="name"
                                                        name="name" value="{{ $product->stock }}" disabled required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-info"
                                        data-bs-dismiss="modal">Regresar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit modal -->
                    <div class="modal fade" id="EditProduct{{ $product->products_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <form action="{{ route('admin.products.update', $product->products_id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Columna izquierda: Imagen -->
                                            <div class="col-md-4 mb-3">
                                                <label for="img_name" class="form-label">Imagen del producto:</label>
                                                <img src="{{ asset('img/products/' . $product->img_name) }}"
                                                    class="img-fluid rounded mb-2" style="max-width: 100%;">
                                                <input type="file" class="form-control" id="img_name" name="img_name">
                                                <small class="form-text text-muted">Deja en blanco para mantener la
                                                    imagen actual.</small>
                                                @error('img_name') <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Columna derecha: Formulario -->
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nombre del Producto:</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $product->name }}" required>
                                                    @error('name') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="product_type_id" class="form-label">Tipo de
                                                        Producto:</label>
                                                    <select class="form-control" id="product_type_id"
                                                        name="product_type_id" required>
                                                        <option value="">Selecciona un tipo</option>
                                                        @foreach ($productTypes as $type)
                                                        <option value="{{ $type->product_type_id }}"
                                                            {{ ($product->product_type_id == $type->product_type_id) ? 'selected' : '' }}>
                                                            {{ $type->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('product_type_id') <div class="text-danger">{{ $message }}
                                                    </div> @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Descripción:</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                        rows="5" required>{{ $product->description }}</textarea>
                                                    @error('description') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="price" class="form-label">Precio:</label>
                                                    <input type="number" step="0.01" class="form-control" id="price"
                                                        name="price" value="{{ $product->price }}" required>
                                                    @error('price') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="stock" class="form-label">Stock:</label>
                                                    <input type="number" class="form-control" id="stock" name="stock"
                                                        value="{{ $product->stock }}" required>
                                                    @error('stock') <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-warning">
                                            <i class="bi bi-pencil-square"></i> Actualizar Producto
                                        </button>

                                        <button type="button" class="btn btn-outline-info"
                                            data-bs-dismiss="modal">Cancelar</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
        </div>

        <!-- Delete modal -->
        <div class="modal fade" id="DeleteProduct{{ $product->products_id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres eliminar este producto?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.products.destroy', $product->products_id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <div class="card bg-dark border-0">
                                <div class="card-body text-white">
                                    <div class="row">
                                        <!-- Columna izquierda: Imagen -->
                                        <div class="col-md-4 mb-3">
                                            <p class="card-text"><strong>Imagen:</strong></p>
                                            <img src="{{ asset('img/products/' . $product->img_name) }}"
                                                class="img-fluid rounded" style="max-width: 100%;">
                                        </div>

                                        <!-- Columna derecha: Detalles -->
                                        <div class="col-8">
                                            <div class="mb-3 text-white">
                                                <label for="name text-white" class="form-label">No. de producto:</label>
                                                <input type="text" class="form-control border-0" id="name" name="name"
                                                    value="{{ $product->products_id }}" disabled required>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="mb-3 text-white">
                                                <label for="name" class="form-label">Nombre:</label>
                                                <input type="text" class="form-control border-0" id="name" name="name"
                                                    value="{{ $product->name }}" disabled required>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="mb-3 text-white">
                                                <label for="name" class="form-label">Tipo:</label>
                                                <input type="text" class="form-control border-0" id="name" name="name"
                                                    value="{{ $product->product_type->name ?? 'N/A' }}" disabled
                                                    required>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="mb-3 text-white text-white">
                                                <label for="name" class="form-label">Descripción:</label>
                                                <textarea class="form-control border-0" id="exampleFormControlTextarea1"
                                                    rows="3" disabled>{{ $product->description }}</textarea>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="mb-3 text-white">
                                                <label for="name" class="form-label">Precio:</label>
                                                <input type="text" class="form-control border-0" id="name" name="name"
                                                    value="$ {{ number_format($product->price, 2) }}" disabled required>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="mb-3 text-white">
                                                <label for="name" class="form-label">Stock:</label>
                                                <input type="text" class="form-control border-0" id="name" name="name"
                                                    value="{{ $product->stock }}" disabled required>
                                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-danger" data-bs-dismiss="modal"><i
                                    class="bi bi-trash-fill"></i>Eliminar</button>
                            <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Regresar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        @endforeach
        </tbody>
        </table>
    </div>

    {{ $products->links('vendor.pagination.bootstrap-5') }}
</div>
</div>
</div>

@endsection

<div class="modal fade" id="CreateProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="exampleModalLabel">Crear nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="product_type_id" class="form-label">Tipo de Producto:</label>
                        <select class="form-control" id="product_type_id" name="product_type_id" required>
                            <option value="">Selecciona un tipo</option>
                            @foreach ($productTypes as $type)
                            <option value="{{ $type->product_type_id }}"
                                {{ old('product_type_id') == $type->product_type_id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('product_type_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="5"
                            required>{{ old('description') }}</textarea>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Precio:</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ old('price') }}" required>
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock:</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}"
                            required>
                        @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="img_name" class="form-label">Imagen del producto:</label>
                        <input type="file" class="form-control" id="img_name" name="img_name"
                            value="{{ old('img_name') }}">
                        @error('img_name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success"><i class="bi bi-plus-lg"></i>Guardar
                        Producto</button>
                    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Cancelar</button>

                </div>
            </form>
        </div>
    </div>
</div>