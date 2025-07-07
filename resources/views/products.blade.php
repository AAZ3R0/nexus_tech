@extends('layout.PlantillaUser')
@section('content')

<div class="container m-auto">
    <h1>Lista de productos</h1>

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
    // Asegúrate de que esta función showToast esté accesible.
    // Si la tienes en cart.js y ese archivo se carga en todas las páginas,
    // o si la tienes en layout.index, entonces está bien.
    // Si no, debes definirla aquí o en un archivo JS compartido (ej. app.js).

    // Función para mostrar el Toast (puedes copiarla de cart.js si no la tienes global)
    function showToast(message, type = 'info') { // type can be 'success', 'danger', 'warning', 'info'
        const toastElement = document.getElementById('liveToast');
        // Verifica si el toastElement existe antes de intentar usarlo
        if (!toastElement) {
            console.error('Toast element not found. Please ensure #liveToast exists in your HTML.');
            alert(message); // Fallback to alert if toast element is missing
            return;
        }
        const toast = new bootstrap.Toast(toastElement);
        const toastTitle = document.getElementById('toast-title');
        const toastBody = document.getElementById('toast-body');

        if (toastTitle) toastTitle.textContent = type.charAt(0).toUpperCase() + type.slice(1);
        if (toastBody) toastBody.textContent = message;

        // Cambiar el color de fondo del Toast según el tipo
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
        // Escuchar el evento 'submit' de todos los formularios con la clase 'add-to-cart-form'
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // ¡PREVENIR EL ENVÍO TRADICIONAL DEL FORMULARIO!

                const formData = new FormData(this); // Obtener todos los datos del formulario
                const submitButton = this.querySelector('button[type="submit"]');

                // Deshabilitar botón para evitar múltiples envíos
                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...';

                axios.post(this.action, formData) // Envía la solicitud POST por AJAX
                    .then(response => {
                        if (response.data.success) {
                            showToast(response.data.message, 'success'); // <-- CAMBIO AQUÍ
                            // Opcional: Actualizar el contador del carrito en el navbar si lo tienes
                            // let cartCountElement = document.getElementById('cart-count');
                            // if (cartCountElement) {
                            //      cartCountElement.textContent = response.data.newCartCount; // Asume que el backend devuelve newCartCount
                            // }
                        } else {
                            showToast('Error: ' + response.data.message, 'danger'); // <-- CAMBIO AQUÍ
                        }
                    })
                    .catch(error => {
                        console.error('Error al añadir al carrito:', error);
                        let errorMessage = 'Hubo un error al procesar tu solicitud.';
                        if (error.response && error.response.data && error.response.data.message) {
                            errorMessage = error.response.data.message;
                        }
                        showToast(errorMessage, 'danger'); // <-- CAMBIO AQUÍ
                    })
                    .finally(() => {
                        // Volver a habilitar el botón después de la respuesta
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="bi bi-plus"></i>'; // Restaurar icono
                    });
            });
        });

        // Si implementas el formulario en la modal, necesitarás un listener similar para '.add-to-cart-modal-form'
        /*
        document.querySelectorAll('.add-to-cart-modal-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');

                submitButton.disabled = true;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Añadiendo...';

                axios.post(this.action, formData)
                    .then(response => {
                        if (response.data.success) {
                            showToast(response.data.message, 'success');
                            // Cierra la modal después de añadir al carrito
                            const modalElement = submitButton.closest('.modal');
                            if (modalElement) {
                                const modal = bootstrap.Modal.getInstance(modalElement);
                                if (modal) modal.hide();
                            }
                        } else {
                            showToast('Error: ' + response.data.message, 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error al añadir al carrito desde modal:', error);
                        let errorMessage = 'Hubo un error al procesar tu solicitud.';
                        if (error.response && error.response.data && error.response.data.message) {
                            errorMessage = error.response.data.message;
                        }
                        showToast(errorMessage, 'danger');
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Añadir al Carrito';
                    });
            });
        });
        */
    });
</script>
@endpush

