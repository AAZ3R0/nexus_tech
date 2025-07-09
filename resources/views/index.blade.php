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
</div>
</div>
</body>
@endsection