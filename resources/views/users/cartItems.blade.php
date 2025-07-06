@extends('layout.index')
@section('content')

    {{-- Añade un data-product-url aquí para pasar la URL de la página de productos a JS --}}
    <div class="container" id="cart-container" data-product-url="{{ route('user.product') }}">
        <h1>Lista del carrito</h1>

        <div class="bg-dark text-light p-5 m-5 rounded" id="cart-items-wrapper"> {{-- ID para el contenedor de los items --}}
            @php
                $subtotalGeneral = 0;
            @endphp

            @forelse($CartItems as $Item)
            <div class="align-middle bg-primary p-5 m-5 row rounded cart-item-row" data-item-id="{{ $Item->id_cart_items }}"> {{-- Añade una clase y el ID del item --}}
                <div class="col align-self-center">
                    <img class="img-fluid align-middle" src="{{ asset('img/products/default.png') }}" alt="">
                </div>
                <div class="col align-self-center">
                    <h4>{{$Item -> product-> name ?? 'producto no encontrado'}}</h4>
                    <h4>$ <span class="unit-price">{{number_format($Item -> unit_price, 2)}}</span></h4> {{-- Para fácil acceso --}}
                </div>
                <div class="col align-self-center">
                    <form class="delete-item-form" data-item-id="{{ $Item->id_cart_items }}" action="{{ route('delete.cart.item', $Item->id_cart_items)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-lg btn-outline-danger bg-dark w-50"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
                <div class="col align-self-center">
                    <div class="d-grid gap-2 d-md-block">
                        <form class="update-quantity-form" action="{{ route('cart.update-item-quantity', $Item->id_cart_items) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="operation" value="decrease">
                            <button type="submit" class="btn btn-outline-danger btn-lg bg-dark rounded-circle" title="Disminuir cantidad"><i class="bi bi-dash"></i></button>
                        </form>

                        <p class="btn btn-link link-underline link-underline-opacity-0 btn-lg text-white disabled item-count">{{$Item -> count}}</p>

                        <form class="update-quantity-form" action="{{ route('cart.update-item-quantity', $Item->id_cart_items) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="operation" value="increase">
                            <button type="submit" class="btn btn-outline-success btn-lg bg-dark rounded-circle" title="Aumentar cantidad"><i class="bi bi-plus"></i></button>
                        </form>
                    </div>
                </div>

                <div class="align-self-center text-end">
                    @php
                        $subtotalItem = $Item->count * $Item->unit_price;
                        $subtotalGeneral += $subtotalItem;
                    @endphp
                    <h5>Subtotal: $ <span class="item-subtotal">{{ number_format($subtotalItem, 2)}}</span></h5>
                </div>
            </div>

            @empty
                <div id="empty-cart-message" class="text-center p-4">
                    <p class="lead">Tu carrito está vacío. ¡Añade algunos productos!</p>
                    {{-- El href será actualizado por JavaScript al cargar la página o al vaciarse el carrito --}}
                    <a href="#" class="btn btn-primary" id="go-to-products-btn">Ver Productos</a>
                </div>
            @endforelse

            {{-- El display de este div se controla con JS --}}
            <div id="cart-summary" @if($CartItems->isEmpty()) style="display:none;" @endif>
                <h2>Resumen del Carrito</h2>
                <p>Total de productos: <span id="total-products-count">{{ $CartItems->sum('count') }}</span></p>
                <p>Subtotal del carrito: $ <span id="subtotal-general">{{ number_format($subtotalGeneral, 2) }}</span></p>
                <h3>Total a pagar: $ <span id="total-to-pay">{{ number_format($subtotalGeneral, 2) }}</span></h3>
            </div>

            {{-- El display de este formulario se controla con JS --}}
            <form id="clear-cart-form" action="{{ route('delete.cart.items') }}" method="POST" @if($CartItems->isEmpty()) style="display:none;" @endif>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-success btn-lg w-50 rounded">Realizar compra</button>
            </form>

        </div>
    </div>

    {{-- Contenedor para las notificaciones Toast --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto" id="toast-title">Notificación</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body">
                </div>
        </div>
    </div>

    {{-- Script de carrito --}}
    <script src="{{ asset('js/cart.js') }}"></script>

@endsection