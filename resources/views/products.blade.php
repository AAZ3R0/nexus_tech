@extends('layout.PlantillaUser')
@section('content')

<div class="container m-auto">
    <h1>Lista de productos @if(request('query')) para "{{ request('query') }}" @endif</h1>

    ---

    {{-- Controles de Filtro --}}
    <form action="{{ route('user.product') }}" method="GET" class="mb-4" id="filterForm">
        {{-- Mantener el término de búsqueda si existe --}}
        <input type="hidden" name="query" value="{{ request('query') }}">

        <div class="row g-3 align-items-end">
            {{-- Filtro por Tipo de Producto --}}
            <div class="col-md-3">
                <label for="product_type" class="form-label">Filtrar por Tipo</label>
                <select class="form-select" id="product_type" name="product_type_id">
                    <option value="">Todos los Tipos</option>
                    @foreach($productTypes as $type)
                        <option value="{{ $type->product_type_id }}" {{ request('product_type_id') == $type->product_type_id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Ordenar por Nombre --}}
            <div class="col-md-3">
                <label for="sort_by_name" class="form-label">Ordenar por Nombre</label>
                <select class="form-select" id="sort_by_name" name="sort_by_name">
                    <option value="">Sin Orden</option>
                    <option value="asc" {{ request('sort_by_name') == 'asc' ? 'selected' : '' }}>A-Z (Ascendente)</option>
                    <option value="desc" {{ request('sort_by_name') == 'desc' ? 'selected' : '' }}>Z-A (Descendente)</option>
                </select>
            </div>

            {{-- Filtro por Rango de Precio (noUiSlider) --}}
            <div class="col-md-4">
                <label class="form-label">Rango de Precio: $<span id="minPriceDisplay">0</span> - $<span id="maxPriceDisplay">Máx</span></label>
                <div id="price-slider"></div> {{-- Contenedor del noUiSlider --}}
                
                {{-- Campos ocultos para enviar los valores del slider --}}
                <input type="hidden" name="min_price" id="hidden_min_price" value="{{ request('min_price', 0) }}">
                <input type="hidden" name="max_price" id="hidden_max_price" value="{{ request('max_price', $maxProductPrice) }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Aplicar</button>
            </div>
        </div>
    </form>

    ---

    @if($products->isEmpty() && request('query'))
        <div class="alert alert-warning" role="alert">
            No se encontraron productos para tu búsqueda "{{ request('query') }}".
        </div>
    @elseif($products->isEmpty())
        <div class="alert alert-info" role="alert">
            No hay productos disponibles en este momento que coincidan con tus filtros.
        </div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="card m-3 p-0" style="width: 18rem;">
            <img src="{{ asset('img/products/' . $product->img_name) }}" class="card-img-top">
            <div class="card-body">
                <form class="add-to-cart-form" action="{{ route('cart.add-item') }}" method="POST">
                    <input type="hidden" name="product_id" value="{{ $product->products_id }}">
                    <input type="hidden" name="count" value="1">
                    <h5 class="card-title">{{$product->name}}</h5>
                    <p class="card-text">$ {{ number_format($product->price, 2) }}</p>
                    <button type="button" class="btn btn-lg rounded-circle btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ShowProduct{{ $product->products_id }}"><i class="bi bi-card-list"></i></button>

                    @csrf
                    <button type="submit" class="btn btn-lg rounded-circle btn-outline-success"><i class="bi bi-plus"></i></button>
                </form>

            </div>
        </div>

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

        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showToast(message, type = 'info') {
        const toastElement = document.getElementById('liveToast');
        if (!toastElement) {
            console.error('Toast element not found. Please ensure #liveToast exists in your HTML.');
            alert(message);
            return;
        }
        const toast = new bootstrap.Toast(toastElement);
        const toastTitle = document.getElementById('toast-title');
        const toastBody = document.getElementById('toast-body');

        if (toastTitle) toastTitle.textContent = type.charAt(0).toUpperCase() + type.slice(1);
        if (toastBody) toastBody.textContent = message;

        toastElement.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
        switch (type) {
            case 'success':
                toastElement.classList.add('bg-success');
                break;
            case 'danger':
                toastElement.classList.add('bg-danger');
                break;
            case 'warning':
                toastElement.classList.add('bg-warning');
                break;
            case 'info':
            default:
                toastElement.classList.add('bg-info');
                break;
        }
        toast.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        // --- noUiSlider Initialization ---
        const priceSlider = document.getElementById('price-slider');
        const minPriceDisplay = document.getElementById('minPriceDisplay');
        const maxPriceDisplay = document.getElementById('maxPriceDisplay');
        const hiddenMinPrice = document.getElementById('hidden_min_price');
        const hiddenMaxPrice = document.getElementById('hidden_max_price');

        // Get initial min and max price from hidden inputs (which hold values from request or defaults)
        const initialMin = parseFloat(hiddenMinPrice.value);
        const initialMax = parseFloat(hiddenMaxPrice.value);
        const maxProductPrice = parseFloat('{{ $maxProductPrice }}'); // Get max price passed from controller

        if (priceSlider) {
            noUiSlider.create(priceSlider, {
                start: [initialMin, initialMax], // Initial values for min and max
                connect: true, // Connect the handles
                range: {
                    'min': 0, // Minimum possible price
                    'max': maxProductPrice // Maximum price from your products
                },
                step: 1, // Increment step (e.g., allow only whole numbers for price)
                tooltips: true, // Show tooltips on handles
                format: { // Format for displaying numbers
                    to: function (value) {
                        return value.toFixed(0); // Display as whole numbers
                    },
                    from: function (value) {
                        return Number(value);
                    }
                }
            });

            // Update display spans and hidden inputs when slider values change
            priceSlider.noUiSlider.on('update', function (values, handle) {
                // values[0] is min, values[1] is max
                minPriceDisplay.textContent = values[0];
                maxPriceDisplay.textContent = values[1];
                hiddenMinPrice.value = values[0];
                hiddenMaxPrice.value = values[1];
            });

            // Optional: Submit form when slider changes (e.g., after user releases handle)
            // priceSlider.noUiSlider.on('change', function () {
            //     document.getElementById('filterForm').submit();
            // });
        }
        // --- End noUiSlider Initialization ---

        // Lógica existente para el carrito (mantener sin cambios)
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');

                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...';

                axios.post(this.action, formData)
                    .then(response => {
                        if (response.data.success) {
                            showToast(response.data.message, 'success');
                        } else {
                            showToast('Error: ' + response.data.message, 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error al añadir al carrito:', error);
                        let errorMessage = 'Hubo un error al procesar tu solicitud.';
                        if (error.response && error.response.data && error.response.data.message) {
                            errorMessage = error.response.data.message;
                        }
                        showToast(errorMessage, 'danger');
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="bi bi-plus"></i>';
                    });
            });
        });
    });
</script>
@endpush