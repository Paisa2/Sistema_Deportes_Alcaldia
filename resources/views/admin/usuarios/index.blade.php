@extends('layouts.dashboard.index', ['activePage' => 'users', 'titlePage' => 'Usuarios'])
@section('main-content')

<div class="d-flex justify-content-between">
    <h2>
        INFORMACIÓN DE USUARIOS 
    </h2>
    @can('user_create')
    <a type="button" class="btn btn-dark" style="background-color: #1D3354; padding-top: 0.8%" href="{{ route('admin.usuarios.create')}}">
        Nuevo usuario
    </a>
    @endcan
</div>
<div class="card-body">
    @if (session('success'))
    <div class="alert alert-success" role="success">
      {{ session('success') }}
    </div>
    @endif
</div>

<div class="form-group" >
    @can('user_buscar')
    <span class="input-group" style="width: 60%; margin-right:auto; margin-left:auto"> 
        <img src="{{asset('images/search.svg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:30px; right:8px;">
        <input id="searchTerm" type="text" onkeyup="doSearch()" class="form-control pull-right"  placeholder="Escribe para buscar en la tabla..." />
    </span>
    @endcan
</div>
<div style="margin-top: 0%" class="table-responsive" >
<table class="table" id="usuarios" >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Carnet de identidad</th>
            <th scope="col">Email</th>
            <th scope="col">Estado</th>
            <th scope="col">Rol</th>

            <th scope="col">Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr scope="row">
            <td>{{ @$user->id}}</td>
            <td>{{ @$user->name }}</td>
            <td>{{ @$user->ci }}</td>
            <td>{{ @$user->email }}</td>
            <td>{{ @$user->estadoCuenta }}</td>
            <td>
                @forelse ($user->roles as $role)
                  <span class="badge badge-info">{{ $role->name }}</span>
                @empty
                  <span class="badge badge-danger">No roles</span>
                @endforelse
              </td>
        
            <td>
                @can('user_edit')
                <a type="button" class="btn btn-primary" href="{{ route('admin.usuarios.edit', $user->id) }}">
                    Editar
                </a>
                @endcan
                @can('user_destroy')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar-{{$user->id}}">
                    Eliminar
                </button> 
                @endcan
            </td>
            
        </tr>
        @include('admin.usuarios.modalEliminar')
    
        @endforeach
       
    </tbody>
    
</table>
</div>

    
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

 <div class="modal fade bs-example-modal-lg" id="modalCrearUsuario">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.usuarios.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre completo</label>
                        <input type="text" name="name" class="form-control" id="name" required minlength="5" maxlength="15"
                        onkeypress="return blockSpecialChar(event)">
                        <label for="name">Carnet de identidad</label>
                        <input type="text" name="ci" class="form-control" id="ci" required minlength="7" maxlength="10" 
                        onkeypress="return blockNoNumber(event)">
                        <label for="name">Correo electronico</label>
                        <input type="email" name="email" class="form-control" id="email" required minlength="10" maxlength="25">
                        <label for="name">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required minlength="5" maxlength="15">
                        <label for="name">Departamento</label>
                        <input type="text" name="Departamento" class="form-control" id="Departamento" required minlength="5" maxlength="15"
                        onkeypress="return blockSpecialChar(event)">
                        <label for="roles">Rol</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-- Selecciona el rol--</option>
                            
                           
                        </select>  

                        
                    </div>
                    <div class="row">
                        <label for="roles" class="col-sm-2 col-form-label">Roles</label>
                        <div class="col-sm-7">
                            <div class="form-group">
                                <div class="tab-content">
                                    <div class="tab-pane active">
                                        <table class="table">
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="refresh">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>   
</div>

<script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
        }
    function blockNoNumber(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ( (k >= 48 && k <= 57));
        }
    let refresh = document.getElementById('refresh');
    refresh.addEventListener('click', _ => {
            location.reload();
    })
</script>
<script>
        /*function doSearch(){
        const tableReg = document.getElementById('usuarios');
        const searchText = document.getElementById('searchTerm').value.toLowerCase();
        let total = 0;
    // Recorremos todas las filas con contenido de la tabla
        for (let i = 1; i < tableReg.rows.length; i++) {
    // Si el td tiene la clase "noSearch" no se busca en su cntenido
        if (tableReg.rows[i].classList.contains("noSearch")) {
            continue;
        }
        let found = false;
        const cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        // Recorremos todas las celdas
        for (let j = 0; j < cellsOfRow.length && !found; j++) {
            const compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            // Buscamos el texto en el contenido de la celda
            if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                found = true;
                total++;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            // si no ha encontrado ninguna coincidencia, esconde la
            // fila de la tabla
            tableReg.rows[i].style.display = 'none';
        }
    }
    // mostramos las coincidencias
    const lastTR=tableReg.rows[tableReg.rows.length-1];
    const td=lastTR.querySelector("td");
    lastTR.classList.remove("hide", "red");
    if (searchText == "") {
        lastTR.classList.add("hide");
    } else if (total) {
        td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");
    } else {
        lastTR.classList.add("red");
        td.innerHTML="No se han encontrado coincidencias";
    }
}*/
</script>
<script language="javascript">
            function doSearch() {
                var tableReg = document.getElementById('usuarios');
                var searchText = document.getElementById('searchTerm').value.toLowerCase();
                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';
                    }
                }
            }
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@endsection