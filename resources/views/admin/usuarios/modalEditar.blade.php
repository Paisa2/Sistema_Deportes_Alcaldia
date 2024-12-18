<?php
 //use Illuminate\Support\Facades\Crypt;
 //  $sectores = DB::table('sectors')->select('nombre')->where('id','=', "{$aula->id}")->get();
  // $sectors = array_diff($sectors, $sectores);   
    //$sector = Arr::prepend($sector, "{$aula->nombre}");

    $estado = ["Habilitado","Deshabilitado"];
    $estado = array_diff($estado, array("{$user->estadoCuenta}"));   
    $estado = Arr::prepend($estado, "{$user->estadoCuenta}");
?>
<div class="modal fade" id="modalEditar-{{$user->id}}">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Editar cuenta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.usuarios.update', $user->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="num_aula">Nombre completo</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" required minlength="4" maxlength="20" 
                        onkeypress="return blockSpecialChar(event)">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" value="" placeholder="Ingrese nueva contraseña" required minlength="5" maxlength="15" >
                    </div>

                    <div class="form-group">
                        <label for="estadoCuenta">Estado de cuenta</label>
                        <select name="estadoCuenta" id="estadoCuenta" class="form-control" required>
                           
                            @foreach($estado as $es)
            
                             <option value="{{$es}}">{{$es}}</option>
            
                            @endforeach
                        </select>                    
                    </div>
                
                    <div class="form-group">
                        <label for="Departamento">Departamento</label>
                        <input type="text" name="Departamento" class="form-control" id="Departamento" value="{{$user->Departamento}}" required minlength="4" maxlength="15"
                        onkeypress="return blockSpecialChar(event)">
                    </div>

                    <div class="form-group">
                        <label for="role">Rol de la cuenta</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="">-- Selecciona el rol--</option>
                            
                         
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="refresh">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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