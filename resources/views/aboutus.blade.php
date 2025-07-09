@extends("layout.PlantillaUser")
@section('content')

 <div class="container py-5">
    <!-- Un solo div que contiene todo lo solicitado -->
    <div class="row g-4 align-items-center bg-white shadow rounded p-4">

      <!-- Imagen (1/3) -->
      <div class="col-12 col-md-4">
        <img src="https://via.placeholder.com/400x450?text=Nexus+Tech"  <!-- pon aquí tu imagen -->
             class="img-fluid rounded w-100"
             alt="Nexus Tech">
      </div>

      <!-- Párrafo principal (2/3) -->
      <div class="col-12 col-md-8">
        <p class="fs-5 mb-0">
          <strong>Nexus Tech</strong> es una compañía dedicada a la venta de piezas de computadora que coloca al 
          consumidor en el centro de cada decisión. Nos apasiona ofrecer componentes de alto rendimiento,
          asesoría honesta y un servicio post-venta de primera. Nuestro compromiso es que cada cliente
          encuentre la solución perfecta para su configuración, sin complicaciones y al mejor precio.
        </p>
      </div>

      <!-- Segundo párrafo debajo de toda la franja anterior -->
      <div class="col-12">
        <p class="mt-3">
          Ya sea que busques actualizar tu tarjeta gráfica para obtener más FPS, ampliar tu almacenamiento
          con un SSD de última generación o armar un equipo desde cero, en Nexus Tech encontrarás un
          catálogo cuidadosamente curado, envíos rápidos y soporte técnico real — porque tu experiencia
          como usuario es nuestra prioridad absoluta.
        </p>
      </div>

    </div>
  </div>
@endsection