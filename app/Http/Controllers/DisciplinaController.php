<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('disciplina_index'), 403);
        $disciplinas = Disciplina::orderBy('id', 'asc')->get();
        return view('admin.disciplinas.index', compact('disciplinas'))->with('tipo', 'all');
    }

    public function UpdateStatusNoti(Request $request) {
        abort_if(Gate::denies('disciplina_estado'), 403);
        $NotiUpdate = Disciplina::find($request->id);
        $NotiUpdate ->estado= $request ->estatus;

        $NotiUpdate->save();
        if($NotiUpdate) {
            $NotiUpdate=Disciplina::find($request->id);
            if($NotiUpdate->estado == 'Deshabilitado')  {
                $newStatus = '<span class="badge badge-danger">'.@$NotiUpdate->estado.'</span>';
            }else{
                $newStatus ='<span class="badge badge-success">'.@$NotiUpdate->estado.'</span>';
            }
            return response()->json(['var'=>''.$newStatus.'']);
        }
        return response()->json([],401);
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
        abort_if(Gate::denies('disciplima_create'), 403);
        $validator = Validator::make($request->all(), [
            'disciplina' => 'required|string|min:1|max:255',
            'edad_estudiante' => 'required',
            'sexo_estudiante' => 'required|string|min:1|max:255',
            'categoria' => 'required|string|min:1|max:255',
            'sub_estudiante' => 'required',
        ]);

        $newDisciplina = new Disciplina();

        $newDisciplina ->disciplina = $request->disciplina;
        $newDisciplina ->edad_estudiante = $request->edad_estudiante;
        $newDisciplina ->sexo_estudiante = $request->sexo_estudiante;
        $newDisciplina ->categoria = $request->categoria;
        $newDisciplina ->sub_estudiante = $request->sub_estudiante;

        $disciplinas = Disciplina::where('nombre', $request->nombre)->first();

        if(empty($disciplinas) && empty($disciplinas2)) {
            $newDisciplina->save();
            return redirect()->back();
        }else {
            return back()->withInput()->withErrors([
                'message' => 'Error, El nombre de la disciplina ya esta registrado en la lista'
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
    public function update(Request $request, $disciplinaId)
    {
        abort_if(Gate::denies('disciplina_edit'), 403);
        $disciplina = Disciplina::find($disciplinaId);

        $disciplina ->disciplina = $request->disciplina;
        $disciplina ->edad_estudiante = $request->edad_estudiante;
        $disciplina ->sexo_estudiante = $request->sexo_estudiante;
        $disciplina ->categoria = $request->categoria;
        $disciplina ->sub_estudiante = $request->sub_estudiante;

        $disciplina->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
