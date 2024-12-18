@extends('layouts.dashboard.index')
@section('main-content')

<div class="d-flex justify-content-between">
    <h2>
        ROLES
    </h2>
    <button type="button" class="btn btn-dark" style="background-color: #1D3354" data-toggle="modal" data-target="#modalCrearRol">
        Crear Rol
    </button>
</div>
<div style="margin-top: 1%; display: flex; justify-content: center;">
    @error('message')
                   
    <p class="alert alert-danger ">{{$message}}</p>
    <button type="button" class="close" onclick="location.reload()" style="margin-bottom: 40px">
        <span aria-hidden="true" >&times;</span></button>  
    
    @enderror 
</div>
<div class="form-group" >
    <span class="input-group" style="width: 60%; margin-right:auto; margin-left:auto"> 
        <img src="{{asset('images/search.svg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:30px; right:8px;">
        <input id="searchTerm" type="text" onkeyup="doSearch()" class="form-control pull-right"  placeholder="Escribe para buscar en la tabla..." />
    </span>
</div>
<div style="margin: 0 auto; text-align: center; " class="table-responsive" >
<table class="table" id="roles"  >
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Permiso</th>

            <th scope="col">Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach ($rols as $role)
        <tr scope="row">
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ @$role->rol }}</td>
            <td>{{ @$role->permiso }}</td>

        
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar-{{$role->id}}">
                    Editar
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEliminar-{{$role->id}}">
                    Eliminar
                </button>
                
            </td>
            
        </tr>
        @include('admin.rols.modalEliminar')
        @include('admin.rols.modalEditar')
        @endforeach
       
    </tbody>

</table>
</div>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div class="modal fade bs-example-modal-lg" id="modalCrearRol">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Nuevo Rol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.rols.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rol">Nombre</label>
                        <input type="text" name="rol" class="form-control" id="rol" required minlength="4" maxlength="15"
                        onkeypress="return blockSpecialChar(event)">
                        <label for="permiso">Permiso</label>
                        <select name="permiso" id="permiso" class="form-control" required>
                            <option value="">-- Selecciona el tipo de permiso--</option>
                            
                            <option>Full</option>
                            <option>User</option>
            
            
                        </select>  
                        
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
    
    let refresh = document.getElementById('refresh');
    refresh.addEventListener('click', _ => {
            location.reload();
})
</script>
<script language="javascript">
            function doSearch() {
                var tableReg = document.getElementById('roles');
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