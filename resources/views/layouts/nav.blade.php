<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Laravel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Products</a>
          </li>
        </ul>
        
        @guest
        <div class="d-flex">
            <a href="/login" class="btn btn-outline-success" style="margin-right: 10px;">Login</a>
            <a href="/register" class="btn btn-outline-success">Register</a>
          </div>
        </div>
        @endguest

        @auth
        <div class="d-flex">
            <p class="text-white m-2">{{auth()->user()->name}}</p>
            <a href="/logout" class="btn btn-outline-success">Logout</a>
          </div>
        </div>
        @endauth
    </div>
  </nav>