
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Laravel App</title>
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>


<body class="text-center" style="background-image: url(http://identidadgeek.com/wp-content/uploads/2008/08/87818-1.png);

background-size:cover;
background-position: center center;
background-attachment: fixed;
background-repeat: no-repeat;
display: flex;
justify-content: center;
align-items: center;">
    <div style=" width: 100%;
    max-width: 800px;
    margin: 0 auto;
    display: flex;
    position: absolute;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    top: 30%;">
    <form class="form-signin" method="POST" >
        @csrf
        <div>
            <h1 class="h3 mb-3 font-weight-normal" style="font-family: 'Times New Roman'; text-align: center; font-size: 40px;">Iniciar sesión</h1>
        </div>
        <div style="padding-top: 8%; width: 300px">
            <input style="font-family: 'Times New Roman';" type="email" id="email" name="email" class="form-control" placeholder="Correo electronico" required autofocus maxlength="255">

            <input style="font-family: 'Times New Roman';" type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required minlength="5" maxlength="15">


        </div>
        <div style="padding-top: 16%" >

            <input type="submit" value="Ingresar" class="btn btn-dark"
            style="font-family: 'Times New Roman'; background-color: #1D3354; width: 100%; font-size: 20px; "/>

        </div>


        <div style="padding-top: 8%">
            <a href="/" style=" text-decoration:none;font-family: 'Times New Roman'; text-align: center;">
                <p  style="color:black;">&copy; Gobierno Autonomo Municipal Colcapirhua</p>
            </a>
        </div>

        <div>
            @error('message')

                <p class="alert alert-danger ">{{$message}}</p>

            @enderror
            </div>
    </form>
    </div>
  </body>
