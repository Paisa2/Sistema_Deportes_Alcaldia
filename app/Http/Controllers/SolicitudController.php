<?php

namespace App\Http\Controllers;
use Log;
use App\Models\Aula;
use App\Models\Sector;
use App\Models\Docmateria;
use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Http\Client\ResponseSequence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Disciplina;
use App\Models\Disentrenador;
use App\Models\Subcategoria;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $solicitudes = Solicitud::all();
        // return view('admin.reservas.index', compact('solicitudes'));
        abort_if(Gate::denies('solicitud_index'), 403);
        $solicitudes = DB::table('solicitudes')

            ->join('disentrenadores', 'solicitudes.disentrenadores_id', '=', 'disentrenadores.id')
            ->join('users', '-disentrenadores.docente', '=', 'users.id')

            ->join('disciplinas', 'solicitudes.disciplina', '=', 'disciplinas.id')
            // ->join('disciplinas', 'disciplinas.id', '=', 'solicitudes.id')

            ->where('solicitudes.estado', '=', 'pendiente')

            // ->join('grupos', 'grupos.id', '=', 'solicitudes.id')
            ->select('name', 'disciplina','solicitudes.*')
            ->get();
          //  dd($solicitudes->all());
        // $solicitudes = solicitud::all();

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('crear_reserva'), 403);

        $disciplinas = DB::table('disciplinas')
        ->where('estado','=','Habilitado')
        ->get();
        $subcategoria = Subcategoria::all();
        $disciplina = Disciplina::all();
        $grupos = Grupo::all();
        $disentrenador = Disentrenador::all();
        $disciplinaUnidas = DB::table('disentrenadores')

        ->join('disciplinas', 'disentrenadores.discip[lina', '=', 'disciplinas.id')
        ->join('grupos', 'disentrenadores.grupo', '=', 'grupos.id')
        ->where('disentrenadores.estado', '=', 'Habilitado')
        ->where('disentrenadores.docente', '=', Auth::id())
        ->select('disentrenadores.*', 'disciplinas.nombre', 'grupos.numero')
        ->get();

        $grupoUnidas = DB::table( 'grupos')
        ->join('disentrenadores', 'grupos.id', '=', 'disentrenadores.grupo')
        ->select('grupos.*')
        ->where('disentrenadores.docente', '=', Auth::id())
        ->get();
        //dd($materiaUnidas);
        return view('admin.solicitudes.create',compact('grupos', 'disciplinas', 'disciplinaUnidas', 'grupoUnidas','subcategoria'));

    }

    /**public function getGrupos(Request $request){
            if ($request->ajax()){
                $grupos = Grupo::where('materia_id', $request->materia_id)->get();
                foreach ($grupos as $grupo){
                    $gruposArray[$grupo->id] = $grupo->numero;

                }
                return response()->json($gruposArray);
            }
    }
*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       /* $validator = Validator::make($request->all(), [
            'title' => [
                'required',
                'max:255',
                function ($attribute, $value, $fail) {
                    if ($value === 'foo') {
                        $fail($attribute.' is invalid.');
                    }
                },
            ],
        ]);*/
        $disentrenador = Disentrenador::all();


        $solicitud = new Solicitud($request->all());


        $solicitud -> estado = "pendiente";
        $id = $request->aula;

        $cantidad = DB::table('aulas')
            ->where('id', $id)
            ->first();

        if(($request->cantidad)>($cantidad->capacidad)){
            return back()->withInput($request->all())->withErrors([
                'message' => 'La cantidad excede la capacidad del aula'
            ]);

        }else{
            if(strtotime($request->hora_ini)>=strtotime($request->hora_fin)){
            return back()->withInput()->withErrors([
                'message' => 'La hora final es igual o mayor al horario de inicio'
            ]);
        }else{

            $solicitud->save();
            //return redirect()->back();
            }
        }

     //   dd($request->all());

        return Redirect()->route('solicitudes.create');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
        /*abort_if(Gate::denies('solicitud_aceptar'), 403);
        abort_if(Gate::denies('solicitud_rechazar'), 403);
        abort_if(Gate::denies('solicitud_sugerir'), 403);*/
        $solicitud->fill($request->all());
        $solicitud->save();

        // alert()->success('Producto actualizado correctamente');

        return redirect()->route('admin.solicitudes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
    public function getCantidades(Request $request){

      //  $solicitudes = Solicitud::where('aula', $aulaId)->first();
        if($request->ajax()){
            $cantidades = Disentrenador::where('id', $request->disentrenador_id)->first();
            //$cantidades = '5';

            return response()->json($cantidades);
        }

    }

    public function getAulas (Request $request){

        if($request->ajax()){

            $aulas = DB::table('aulas')
            ->where('sector', $request->sector_id)
            ->where('estado','=','Habilitado')
            ->get();
            $datos = DB::table('aulas')
            ->where('sector', $request->sector_id)
            ->where('estado','=','Habilitado')
            ->count();
           //  Aula::where('sector', $request->sector_id)->where('estado','=','Habilitado')>get();
            if($datos == 0)  {
                $aulasArray =  [
                0=> "1",

                ];
            return response()->json($aulasArray);

            }else{
                foreach($aulas as $aula){
                    $aulasArray[$aula->id] = $aula->num_aula;
                }
                return response()->json($aulasArray);
            }
        }

    }
}
