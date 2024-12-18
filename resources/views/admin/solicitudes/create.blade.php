
@extends('layouts.dashboard.index', ['activePage' => 'nueva solicitud', 'titlePage' => 'Nueva solicitud'])
@section('main-content')
<?php
  $hora_ini   = ['1' => '6:45', '2' => '8:15'];
?>
<div class="container">
        <div class="my-6">
            <div class="card">
                <div class="card-header">
                  Nueva Solicitud
                </div>
                <div style="margin-top: 1%; display: flex; justify-content: center;">
     @if ($errors->any())
    <div class="alert alert-danger">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <strong>Por favor corrige los siguentes errores:</strong>
      <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
      </ul>
    </div>
  @endif
</div>

                <div class="card-body">
                    <form action="{{route('solicitudes.store')}}" method="POST">
                    @csrf
                        <div class="card-bady">
                            {{-- @if($errors->any())
                                <div class="alert alert-primary">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                             --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">
                                            Nombre Disciplina:
                                        </label>
                                        <div class="input-group">
                                                <span class="input-group">
                                                    <button class="btn btn-primary" type="button">D</button>
                                                    <select name="docmateria_id" id="docmateria_id" class="custom-select" value="{{old('docmateria_id')}}" required>
                                                        <option value="">Seleccione la Disciplina..</option>
                                                        @foreach ($materiaUnidas as $item)
                                                            <option value="{{ $item->id }}" @if(old('docmateria_id') == $item->id) selected @endif>{{ $item->nombre}}--Grupo {{$item->numero}}</option>

                                                        @endforeach
                                                    </select>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                               {{--
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">
                                            Grupo:
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group">
                                                <button class="btn btn-primary" type="button" >G</button>

                                                {{-- <input name="grupo_id" type="name" class="form-control" placeholder="Grupo">
                                                <select name="grupo" id="grupo" class="custom-select" >
                                                    <option selected>Seleccione N° grupo..</option>
                                                    @foreach ($grupoUnidas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->numero}}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                 --}}
                                 <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">
                                                Horario ini:
                                        </label>
                                            <div class="input-group">
                                                <span class="input-group">
                                                <button class="btn btn-primary" type="button">H</button>
                                                {{-- <input type="date" id="birthday" name="hora_ini" class="form-control"> --}}

                                                <select name="hora_ini" id="hora_ini" class="form-control" type="date" value="{{old('hora_ini')}} " required >
                                                </span>
                                                    <option value="" >-- Selecciona la hora para la solicitud--</option>

                                                    <option value="6:45:00" @if(old('hora_ini') == '6:45:00') selected @endif>6:45:00</option>
                                                    <option value="8:15:00" @if(old('hora_ini') == '8:15:00') selected @endif>8:15:00</option>
                                                    <option value="9:45:00" @if(old('hora_ini') == '9:45:00') selected @endif>9:45:00</option>
                                                    <option value="11:15:00" @if(old('hora_ini') == '11:15:00') selected @endif>11:15:00</option>
                                                    <option value="12:45:00" @if(old('hora_ini') == '12:45:00') selected @endif>12:45:00</option>
                                                    <option value="14:15:00" @if(old('hora_ini') == '14:15:00') selected @endif>14:15:00</option>
                                                    <option value="15:45:00" @if(old('hora_ini') == '15:45:00') selected @endif>15:45:00</option>
                                                    <option value="17:15:00" @if(old('hora_ini') == '17:15:00') selected @endif>17:15:00</option>
                                                    <option value="18:45:00" @if(old('hora_ini') == '18:45:00') selected @endif>18:45:00</option>
                                                    <option value="20:15:00" @if(old('hora_ini') == '20:15:00') selected @endif>20:15:00</option>
                                                    <option value="21:45:00" @if(old('hora_ini') == '21:45:00') selected @endif>21:45:00</option>

                                                </select>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="col-6">
                                        <div class="form-group">
                                             <label for="name" class="form-control-label">
                                                    Sector Categria:
                                             </label>
                                                <div class="input-group">
                                             <span class="input-group">
                                                <button class="btn btn-primary" type="button">C</button>
                                                {{-- <input name="aula" type="name" class="form-control" placeholder="Aula"> --}}
                                                <select name="sector" id="sector" class="custom-select" value="{{old('sector')}}" required >
                                                </span>
                                                    <option value="">Seleccione Sub Categoria..</option>
                                                    @foreach ($sectores as $item)
                                                        <option value="{{ $item->id }}" @if(old('sector') == $item->id) selected @endif>{{ $item->nombre}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                         </div>
                                     </div>



                                <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">
                                                Horario Fin:
                                        </label>
                                            <div class="input-group">
                                                <span class="input-group">
                                                <button class="btn btn-primary" type="button">H</button>
                                                {{-- <input type="date" id="birthday" name="hora_ini" type="date" class="form-control"> --}}

                                                <select name="hora_fin" id="hora_fin" class="form-control" value="{{old('hora_fin')}}" required>
                                                </span>
                                                    <option value="" >-- Selecciona la hora para la solicitud--</option>

                                                    <option value="6:45:00" @if(old('hora_fin') == '6:45:00') selected @endif>6:45:00</option>
                                                    <option value="8:15:00" @if(old('hora_fin') == '8:15:00') selected @endif>8:15:00</option>
                                                    <option value="9:45:00" @if(old('hora_fin') == '9:45:00') selected @endif>9:45:00</option>
                                                    <option value="11:15:00" @if(old('hora_fin') == '11:15:00') selected @endif>11:15:00</option>
                                                    <option value="12:45:00" @if(old('hora_fin') == '12:45:00') selected @endif>12:45:00</option>
                                                    <option value="14:15:00" @if(old('hora_fin') == '14:15:00') selected @endif>14:15:00</option>
                                                    <option value="15:45:00" @if(old('hora_fin') == '15:45:00') selected @endif>15:45:00</option>
                                                    <option value="17:15:00" @if(old('hora_fin') == '17:15:00') selected @endif>17:15:00</option>
                                                    <option value="18:45:00" @if(old('hora_fin') == '18:45:00') selected @endif>18:45:00</option>
                                                    <option value="20:15:00" @if(old('hora_fin') == '20:15:00') selected @endif>20:15:00</option>
                                                    <option value="21:45:00" @if(old('hora_fin') == '21:45:00') selected @endif>21:45:00</option>
                                                </select>
                                            </div>
                                        </div>
                                  </div>

                                  <div class="col-6">
                                        <div class="form-group">
                                             <label for="name" class="form-control-label">
                                                    Nombre Deporte:
                                             </label>
                                                <div class="input-group">
                                             <span class="input-group">
                                                <button class="btn btn-primary" type="button">D</button>
                                                {{-- <input name="aula" type="name" class="form-control" placeholder="Aula"> --}}
                                                <select name="aula" id="aula" class="custom-select" value="{{old('aula')}}" required >
                                                     <option value="{{old('aula')}}" selected  >Seleccione el Deporte... {{old('aula')}}</option>
                                                  {{--  @foreach ($aulas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->num_aula}}</option>
                                                    @endforeach--}}
                                                </select>
                                              </span>
                                            </div>
                                         </div>
                                     </div>




                                   <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">
                                                Año de Inscripcion:
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group">
                                                <button class="btn btn-primary" type="button">D</button>
                                                <input name="dia" type="date" id="fechaReserva" class="form-control" placeholder="Dia Reserva" value="{{old('dia')}}" required>
                                                </span>
                                                <br>
                                                @if($errors -> has('dia'))
                                                    <span class="error-danger" for="input-name">{{$errors->first('dia')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                   </div>






                                     <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-control-label">
                                                Descripcion:
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group">
                                                <button class="btn btn-primary" type="button">D</button>
                                                {{-- <input name="motivo" type="text" class="form-control" aria-label="With textarea"> --}}
                                                <textarea name="motivo" type="text" class="form-control" id=""  placeholder="Descripcion" required>{{old('motivo')}}</textarea>
                                                </span>
                                                <br>
                                                @if($errors -> has('motivo'))
                                                    <span class="error-danger" for="input-name">{{$errors->first('motivo')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                     </div>

                                     <div class="col-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">
                                            Cantidad de Inscriptos:
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group">
                                                <button class="btn btn-primary" type="button">C</button>
                                                <input name="cantidad" id="cantidad" type="name" class="form-control" placeholder="Cantidad-Estudiantes" value="{{old('cantidad')}}" required minlength="1" maxlength="3"
                                                onkeypress="return blockNoNumber(event)">
                                            </span>
                                            <br>
                                                @if($errors -> has('cantidad'))
                                                    <span class="error-danger" for="input-name">{{$errors->first('cantidad')}}</span>
                                                @endif
                                        </div>
                                    </div>
                                </div>



                                            <div class="col-md-offset-4 col-md-10 text-center mt-3">
                                                <button type="submit" class="btn btn-primary">enviar</button>
                                                <a href="{{ URL::previous() }}" class="btn btn-secondary">Cancelar</a>
                                            </div>
                               </div>
                           </div>
                      </form>
                 </div>
             </div>
        </div>
    </div>
<script>
            var fecha = new Date();
        var anio = fecha.getFullYear();
        var dia = fecha.getDate();
        var _mes = fecha.getMonth(); //viene con valores de 0 al 11
        _mes = _mes + 1; //ahora lo tienes de 1 al 12
        if (_mes < 10) //ahora le agregas un 0 para el formato date
        {
        var mes = "0" + _mes;
        } else {
        var mes = _mes.toString;
        }

        let fecha_minimo = anio + '-' + mes + '-' + dia; // Nueva variable

        document.getElementById("fechaReserva").setAttribute('min',fecha_minimo);
</script>
<script type="text/javascript">

    function blockNoNumber(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ( (k >= 48 && k <= 57));
        }

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('script')
<script >
    $(document).ready(function(){
        $('#docmateria_id').on('change', function(){
            var docmateria_id = $(this).val();
            if($.trim(docmateria_id) != ''){

                $.get('/cantidades', {docmateria_id: docmateria_id}, function(cantidades){


                    $('#cantidad').empty();




                        $('#cantidad').attr("value", cantidades.inscritos);
                        $('#cantidad').empty();

                });
            }
        })
    })

    $(document).ready(function(){
        $('#sector').on('change', function(){
            var sector_id = $(this).val();
            if($.trim(sector_id) != ''){

                $.get('/sectoresaulas', {sector_id: sector_id}, function(aulas){


                  //  alert(aulas);
                  if( aulas.length == 1){
                    $('#aula').empty();
                        $('#aula').append("<option value='' disabled >No hay aulas disponibles</option>");
                        console.log('hola2');
                        console.log(aulas);

                    }else{
                        $('#aula').empty();
                        $('#aula').append("<option value='{{old('aula')}}' >Selecciona un aula</option>");
                         $.each(aulas, function(index, value){
                        $('#aula').append("<option value='"+ index +"' >"+ value + "</option>")

                         })
                        console.log('hola1');
                    }
                });
            }
        })
    })
</script>



@endsection
