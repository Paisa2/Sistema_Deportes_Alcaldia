
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Laravel App</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-light d-flex justify-content-between">
        <div class="navbar-brand " style="padding-left:5%" href="/" >
          <a href="/">
          <img src="{{asset('images/colcapirhuaEscudo.jpg')}}" width="42" height="60"  alt="" >
          </a>
        </div>

        <div class="navbar-brand " style="padding-left:5%" href="/" >
          <a href="/">
          <!-- <img src="" width="50" height="60"  alt="" > -->
          </a>
        </div>

          <div class="navbar-nav" style="padding-right: 5%">
            @if(auth()->check())
            <li class="nav-item active">
              <p class="text-xl" >{{auth()->user()->name}}</p>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('login.destroy')}}">Logout</a>
            </li>


            @else

            <li class="nav-item active" >
              <a  class="btn btn-dark" style="font-family: 'Times New Roman'; background-color: #1D3354;" href="{{route('login.index')}}">INICIA SESIÓN</a>
            </li>
          <!--  <li class="nav-item">
              <a class="nav-link" href="{{route('register.index')}}">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.registerAdmin')}}">Register Admin</a>
            </li>-->
            @endif
          </div>

      </nav>

    @yield('content')
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
