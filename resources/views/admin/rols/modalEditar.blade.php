<?php
 //use Illuminate\Support\Facades\Crypt;
 //  $sectores = DB::table('sectors')->select('nombre')->where('id','=', "{$aula->id}")->get();
  // $sectors = array_diff($sectors, $sectores);   
    //$sector = Arr::prepend($sector, "{$aula->nombre}");

    $permiso = ["Full","User"];
    $permiso = array_diff($permiso, array("{$role->permiso}"));   
    $permiso = Arr::prepend($permiso, "{$role->permiso}");
?>
<div class="modal fade" id="modalEditar-{{$role->id}}">
    <div class="modal-dialog">
        <div class="modal-content bg-default">
            <div class="modal-header">
                <h4 class="modal-title w-100 text-center">Editar cuenta</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('admin.rols.update', $role->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group" style="text-align: left;">
                        <label for="rol">Nombre </label>
                        <input type="text" name="rol" class="form-control" id="rol" value="{{$role->rol}}" required minlength="4" maxlength="15" 
                        onkeypress="return blockSpecialChar(event)">
                    </div>
                    
                    <div class="form-group" style="text-align: left;">
                        <label for="permiso" >Permiso</label>
                        <select name="permiso" id="permiso" class="form-control" required>
                           
                            @foreach($permiso as $es)
            
                             <option value="{{$es}}">{{$es}}</option>
            
                            @endforeach
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