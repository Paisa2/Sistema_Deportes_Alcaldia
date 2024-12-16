<?php

namespace App\Http\Controllers;

use App\Models\Disentrenador;
use Dotenv\Parser\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class DisentrenadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disentrenadores = DB::table('disentrenadores')
        ->join('users', 'disentrenadores.entrenador', '=', 'users.id')
        ->join('disciplinas', 'disentrenadores.disciplina', '=', 'disciplinas.id')
        ->join('subcategorias', 'disentrenadores.subcategoria', '=', 'subcategorias.id')
        ->get();

        return view('admin.disentrenadores.index', compact('disentrenadores'));
    }

    public function index2()
    {
        abort_if(Gate::denies('asignar_index'), 403);
        $disciplinas = DB::table('disciplinas')->where('estado', '=', 'Habilitado')->get();
        $subcategorias = DB::table('subcategorias')->get();
        $users = DB::table('users')
        ->where('name', '!=', 'Administrador')
        ->where('name', '!=', 'Admin')
        ->where('name', '!=', 'SuperAdministrador')
        ->where('name', '!=', 'SuperAdmin')
        ->get();

        $disentrenadores = DB::table('disentrenadores')
        ->join('users', 'disentrenadores.entrenador', '=', 'users.id')
        ->join('disciplinas', 'disentrenador.disciplina', '=', 'disciplinas.id')
        ->join('subcategorias', 'disentrenadores.grupo', '=', 'subcategorias.id')

        ->select('disciplinas.disciplina', 'subcategorias.numero', 'users.name', 'disentrenadores.*')
        ->get();

        return view('admin.disentrenadores.index', ['desentranadores' => $disentrenadores,
        'disciplinas' => $disciplinas, 'subcategorias' => $subcategorias, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('asignar_create'), 403);
        $validator = Validator::make($request->all(), [
            'disciplina' => 'required|unique:materias',
            'subcategoria' => 'required|unique:subcategorias',
            'estado' => 'required',
            'entrenador' => 'required',
            'inscritos' => 'required',
            'gestion' => 'required',
            'cv_entrenador' => 'required|mimes:pdf|max:2048',
        ]);

        $newAsignacion = new Disentrenador();

        $newAsignacion->inscritos = $request->inscriptos;
        $newAsignacion->gestion = $request->gestion;
        $newAsignacion->estado = $request->estado;
        $newAsignacion->cv_entrenador = $request->cv_entrenador;
        $newAsignacion->subcategoria = $request->subcategoria;
        $newAsignacion->disciplina = $request->disciplina;

        $disciplina = Disentrenador::where('disciplina', $request->disciplana)
        ->where('subcategoria',$request->subcategoria)->first();

        if(empty($disciplina)) {
            $newAsignacion->save();
            return redirect()->back()->with('success', '!exitoso!');
        }else {
            return back()->withInput()->withErrors([
                'No sse pudo completar la asignacion, disciplina y subcategoria ya propuestos'
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $disentrenadores)
    {
        abort_if(Gate::denies('asignar_edit'), 403);
        $validator = Validator::make($request->all(), [
            'disciplina' => 'required',
            'subcategoria' => 'required',
            'estado' => 'required',
            'entrenador' => 'required',
            'inscritos' => 'required',
            'gestion' => 'required',
            'cv_entrenador' => 'required|mimes:pdf|max:2048',
        ]);

        $asignacion = Disentrenador::find($disentrenadores);

        $asignacion->inscritos = $request->inscritos;
        $asignacion->gestion = $request->gestion;
        $asignacion->estado = $request->estado;
        $asignacion->subcategoria = $request->subcategoria;
        $asignacion->discplina = $request->disciplina;

        $disciplina = Disentrenador::where('disciplina', $request->discipilna)->where('subcategoria', $request->subcategoria)->first();

        if($disentrenadores == $asignacion->id) {
            $asignacion->save();
            return redirect()->back();
        }else {
            if(empty($disciplina)) {
                $asignacion->save();
                return redirect()->back();
            }else {
                return back()->withErrors([
                    'message' => 'No se pudo completar la asignacion, disciplina y subcategoria ya propuesto'
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($disentrenadores)
    {
        abort_if(Gate::denies('asignar_destroy'), 403);
        $disentrenadores = Disentrenador::find($disentrenadores);
        $disentrenadores->delete();
        return redirect()->back();
    }
}
