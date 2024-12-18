@extends('layouts.dashboard.index')
@section('main-content')
<h2>
   LISTA DE NOTIFICACIONES
</h2>
<div class="card-body">
    <div class="table-responsive">
        <div class="form-group">
            @can('notificacion_buscar')
            <span class="input-group" style="width: 60%; margin-right:auto; margin-left:auto">
                <img src="{{asset('images/search.svg')}}" alt="" style="border-radius: 10px; position: relative; width:100%; max-width:30px; right:8px;">
                <input id="searchTerm" type="text" onkeyup="doSearch()" class="form-control pull-right"  placeholder="Escribe para buscar en la tabla..." />
            </span>
            @endcan
        </div>
        <table class="table caption-top" id="notificaciones">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Materia</th>
                    <th>Aula</th>
                    <th>Dia</th>
                    <th>Horario inicio</th>
                    <th>Horario final</th>
        
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notificaciones as $notificacion)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>  
                    <td>{{ $notificacion->codigo }} - {{ $notificacion->nombre }}</td>
                    <td>{{ $notificacion->num_aula }}</td>
                    <td>{{ $notificacion->dia }}</td>
                    <td>{{ $notificacion->hora_ini }}</td>
                    <td>{{ $notificacion->hora_fin }}</td>
                  {{-- <td>{{ \Illuminate\Support\Str::limit($notificacion->mensaje, 50, $end='...') }}</td>--}}
   
                    <td>
                        @can('notificacion_ver')
                        <i class="btn btn-primary bi bi-eye-fill" data-bs-toggle="modal" data-bs-target="#modalVer{{$loop->index}}"></i>
                        @endcan
                    </td>

                    <div class="modal fade" id="modalVer{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Notificacion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating">
                                        <textarea class="form-control" readonly placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{$notificacion->mensaje}}</textarea>
                                        <label for="floatingTextarea2">Mensaje</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script language="javascript">
            function doSearch() {
                var tableReg = document.getElementById('notificaciones');
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

@endsection