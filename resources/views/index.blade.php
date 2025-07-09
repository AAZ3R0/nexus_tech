@extends("layout.PlantillaUser")
@section('content')

<div class="container-fluid  bg-primary justify-content-center align-items-center" style="min-height: 100vh;">

<h1 class="text-center text-white pt-5">Bienvenido a Nexus Tech</h1>

<div class="container pt-2">
  <div class="row">
    <div class="col-md-12 col-lg-15 mx-auto"
         style="height:33vh; overflow:hidden;">
      
      <div id="carouselExampleCaptions"
           class="carousel slide h-100"
           data-bs-ride="carousel">
        
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions"
                  data-bs-slide-to="0" class="active"
                  aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions"
                  data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions"
                  data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner h-100">
          <div class="carousel-item active h-100">
            <img src="https://cdn.pixabay.com/photo/2021/08/25/20/42/field-6574455_960_720.jpg"
                 class="d-block w-100 h-100 object-fit-cover" alt="...">
          </div>
          <div class="carousel-item h-100">
            <img src="https://cdn.pixabay.com/photo/2014/08/01/00/08/pier-407252_960_720.jpg"
                 class="d-block w-100 h-100 object-fit-cover" alt="...">
          </div>
          <div class="carousel-item h-100">
            <img src="https://cdn.pixabay.com/photo/2015/07/09/22/45/tree-838667_960_720.jpg"
                 class="d-block w-100 h-100 object-fit-cover" alt="...">
          </div>
        </div>

                    <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Lista aleatoria de productos --}}
        <div class="row">
        @foreach($randProducts as $product)
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
</div>


    
@endsection