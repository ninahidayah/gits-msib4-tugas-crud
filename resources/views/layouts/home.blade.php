<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME','CRUD') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @stack('css')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="{{ url('/') }}">CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Produk</a>
              <a class="nav-link" href="{{ route('cart.index') }}">Keranjang</a>
            </div>
          </div>
          <div class="ml-auto">
            <a href="{{ route('manage.index') }}" class="btn btn-warning btn-sm">Manage</a>
          </div>
        </div>
      </nav>

      @yield('content')

  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
  @stack('js')
</body>
</html>