<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap@5.2.2/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome@6.2.2/all.min.css') }}">
  <style type="text/css">
    body{
      background-color: #f8f9fa;
    }

    .custom-invalid{
      /* background-image: none !important; */
      border-color: #dc3545;
    }

    hr{
      margin-top: .5rem;
      margin-bottom: .5rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Facturación</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-end">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('facturas') }}">Facturas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('servicios') }}">Servicios</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li> -->
      </ul>
      <!-- <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>
  <div class="container-xxl">
    @yield('content')
  </div>
  <script src="{{ asset('plugins/bootstrap@5.2.2/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('plugins/jQuery@3.6.0/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/fontawesome@6.2.2/all.min.js') }}"></script>
  @yield('script')
</body>
</html>