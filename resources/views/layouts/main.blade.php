<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Technical Test</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <style>
    .carousel-inner>.carousel-item>img {
      width: 640px;
      height: 360px;
    }

    .card-shadow {
      box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    }
  </style>


</head>

<body>
  @include('sweetalert::alert')
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Techincal Test</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
          </li>
          @auth
          @if (Auth::user()->role === 'admin')
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-expanded="false">
              Admin Page
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="{{route('users.index')}}">User List</a></li>
              <li><a class="dropdown-item" href="{{route('product.index')}}">Product</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="{{route('banners.index')}}">Banner</a></li>
            </ul>
          </li>
          @endif
          @endauth
        </ul>
        @guest
        <div class="my-2 my-lg-0">
          <a class="btn btn-outline-success" href="{{route('login.view')}}">Login</a>
        </div>
        @else

        <div class="form-inline my-2 my-lg-0">
          <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="btn btn-outline-success">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
        @endguest
      </div>
    </nav>
    @if (Route::is('home'))
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        @php
            $banners = \App\Models\Banner::all();
            
        @endphp
        @if (\App\Models\Banner::count() > 1)
        @foreach ($banners as $key => $item)
        <div class="carousel-item {{$loop->first ? 'active' : ''}}">
          <img
            src="{{asset('storage/images/banner/'.$item->image)}}"
            class="d-block w-100" alt="...">
        </div>
        @endforeach
        @else
        
        <div class="carousel-item active">
          <img
            src="https://previews.123rf.com/images/arrow/arrow1508/arrow150800011/43834601-%E3%82%AA%E3%83%B3%E3%83%A9%E3%82%A4%E3%83%B3-%E3%82%B7%E3%83%A7%E3%83%83%E3%83%94%E3%83%B3%E3%82%B0-e-%E3%82%B3%E3%83%9E%E3%83%BC%E3%82%B9-%E3%83%95%E3%83%A9%E3%83%83%E3%83%88%E3%81%AA%E3%83%87%E3%82%B6%E3%82%A4%E3%83%B3-%E3%82%B3%E3%83%B3%E3%82%BB%E3%83%97%E3%83%88%E3%81%AE%E3%83%90%E3%83%8A%E3%83%BC%E3%81%AE%E8%83%8C%E6%99%AF.jpg"
            class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img
            src="https://webizona.com/wp-content/uploads/2016/12/ecommerce-website-banner.jpg"
            class="d-block w-100" alt="...">
        </div>
        @endif
      </div>
      <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    @endif
  </header>


  <div class="container-fluid mb-5">
    @yield('content')
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
  </script>

  @yield('script')
</body>

</html>