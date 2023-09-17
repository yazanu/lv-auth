@php
    $role_permissions = \App\Models\Permission::where('role_id', auth()->user()->role)->pluck('permissions.route_name')->toArray();
@endphp
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
          @auth
          @if (in_array('user.index', $role_permissions) || in_array('user.create', $role_permissions))
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Users
              </a>
              <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                <li><a class="dropdown-item" href="/users">User Lists</a></li>
                @if (in_array("permission.index", $role_permissions) || in_array("permission.edit", $role_permissions))
                  <li><a class="dropdown-item" href="/permissions">Role & Permissions</a></li>
                @endif
                
              </ul>
            </li>
          @endif
          @if (in_array('product.index', $role_permissions) || in_array("product.create", $role_permissions))
          <li class="nav-item">
            <a class="nav-link" href="/products">Products</a>
          </li>   
          @endif
            
          @endauth
          <li>
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <select name="language" id="language-option" class="form-control">
                  <option value="en" @if (\Session::get('locale') == 'en')
                      selected
                  @endif>En</option>
                  <option value="mm" @if (\Session::get('locale') == 'mm')
                      selected
                  @endif>MM</option>
                </select>
              </li>
            </ul>
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