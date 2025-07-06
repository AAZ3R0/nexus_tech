@extends('layout.index')
@section('content')

    <div class="container">
        <h1>Lista del carrito(?</h1>

        <div class="bg-dark text-light p-5 m-5 rounded">
            @php
                $subtotalGeneral = 0;
            @endphp

            @forelse($CartItems as $Item)
            <div class="align-middle bg-primary p-5 m-5 row rounded">
                <div class="col align-self-center">
                    <img class="img-fluid align-middle" src="{{ asset('img/products/default.png') }}" alt="">
                </div>
                <div class="col align-self-center">
                    <h4>{{$Item -> product-> name ?? 'producto no encontrado'}}</h4>
                    <h4>$ {{number_format($Item -> unit_price, 2)}}</h4>
                </div>
                <div class="col align-self-center">
                    <form action="{{ route('delete.cart.item', $Item->id_cart_items)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-lg btn-outline-danger bg-dark w-50"><i class="bi bi-trash-fill"></i></button>
                    </form>
                    
                </div>
                <div class="col align-self-center">
                <div class="d-grid gap-2 d-md-block">
                        <form action="{{ route('cart.update-item-quantity', $Item->id_cart_items) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH') <input type="hidden" name="action" value="decrease">
                            <button type="submit" class="btn btn-outline-danger btn-lg bg-dark rounded-circle" title="Disminuir cantidad"><i class="bi bi-dash"></i></button>
                        </form>

                        <p class="btn btn-link link-underline link-underline-opacity-0 btn-lg text-white disabled">{{$Item -> count}}</p>

                        <form action="{{ route('cart.update-item-quantity', $Item->id_cart_items) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="action" value="increase">
                            <button type="submit" class="btn btn-outline-success btn-lg bg-dark rounded-circle" title="Aumentar cantidad"><i class="bi bi-plus"></i></button>
                        </form>
                    </div>
                </div>

                <div class="align-self-center text-end">
                    @php
                        $subtotalItem = $Item->count * $Item->unit_price;
                        $subtotalGeneral += $subtotalItem;
                    @endphp
                    <h5>Subtotal: $ {{ number_format($subtotalItem, 2)}}</h5>
                </div>
                
            </div>
            
            @empty
                <div class="text-center p-4">
                    <p class="lead">Tu carrito está vacío. ¡Añade algunos productos!</p>
                    <a href="{{ route('user.product') }}" class="btn btn-primary">Ver Productos</a>
                </div>
            
            @endforelse

            <h2>Resumen del Carrito</h2>
            <p>Total de productos: {{ $CartItems->sum('count') }}</p>
            <p>Subtotal del carrito: $ {{ number_format($subtotalGeneral, 2) }}</p>
            <h3>Total a pagar: $ {{ number_format($subtotalGeneral, 2) }}</h3>
            <form action="{{ route('delete.cart.items') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-success btn-lg w-50 rounded">Realizar compra</button>
            </form>
            
        </div>
    </div>
    

@endsection

