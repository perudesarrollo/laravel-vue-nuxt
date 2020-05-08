<?php

namespace App\Http\Controllers;

use App\Turno;
use Illuminate\Http\Request;
use App\Http\Resources\TurnoResource;

class TurnoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/turnos",
     *     summary="Mostrar turnos",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos los turnos."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TurnoResource::collection(Turno::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'turno' => 'required',
            'estado' => 'required',
        ]);
        $turno = new Turno();
        $turno->turno = $request->turno;
        $turno->estado = $request->estado;
        $turno->save();
        return new TurnoResource($turno);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
        return new TurnoResource($turno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $turno)
    {
        $this->validate($request, [
            'turno' => 'required',
            'estado' => 'required',
        ]);
        $turno->turno = $request->turno;
        $turno->estado = $request->estado;
        $turno->save();
        return new TurnoResource($turno);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Turno  $turno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $turno)
    {
        $turno->delete();
        return response()->json(['message' => 'turno deleted successfully']);
    }
}
