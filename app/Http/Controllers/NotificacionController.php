<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('notificacion_index'), 403);
        $notificaciones = DB::table('solicitudes')
            ->join('notificaciones', 'solicitudes.id', '=', 'notificaciones.solicitud')
            ->join('desentrenadores', 'solicitudes.desentrenador_id', '=', 'desentrenadores.id')
            // ->join('aulas', 'solicitudes.aula', '=', 'aulas.id')
            ->join('disciplinas', 'desentrenadores.disciplina', '=', 'disciplinas.id')
            ->where('desentrenadores.entrenador', Auth::id())
            ->get();
      // dd($notificaciones);
        return view('admin.notificaciones.index', compact('notificaciones'));
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
        $notificacion = new Notificacion();
        $notificacion->mensaje = $request->mensaje;

        $notificacion->email = Auth::user()->email;
        $notificacion->dia = date("Y-m-d");

        $notificacion->solicitud = $request->solicitud;

        $notificacion->save();
        Solicitud::find($request->solicitud)->update(['estado' => $request->tipo]);
        return redirect()->route("solicitudes");
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
    public function update(Request $request, Notificacion $notificacion)
    {
        $notificacion->fill($request->all());
        $notificacion->save();

        // alert()->success('Producto actualizado correctamente');

        return redirect()->route('admin.notificaciones.index');
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
