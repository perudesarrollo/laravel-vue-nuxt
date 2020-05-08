<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeliculaResource;
use App\Pelicula;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/peliculas",
     *     summary="Mostrar Películas",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos los películas."
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
        // $r = new TurnoPelicula();
        // $r->turno_id = 1;
        // $r->pelicula_id = 1;
        // $r->save();

        return PeliculaResource::collection(Pelicula::with('turnos')->paginate(25));
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
            'nombre' => 'required',
            'imagen' => 'required',
            'estado' => 'required',
            'fpublicacion' => 'required',
        ]);
        $pelicula = new Pelicula();
        $pelicula->nombre = $request->nombre;
        $pelicula->imagen = $request->imagen;
        $pelicula->estado = $request->estado;
        $pelicula->fpublicacion = $request->fpublicacion;
        $pelicula->save();
        return new PeliculaResource($pelicula);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function show(Pelicula $pelicula)
    {
        return new PeliculaResource($pelicula);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'imagen' => 'required',
            'estado' => 'required',
            'fpublicacion' => 'required',
        ]);

        $pelicula->nombre = $request->nombre;
        $pelicula->imagen = $request->imagen;
        $pelicula->estado = $request->estado;
        $pelicula->fpublicacion = $request->fpublicacion;
        $pelicula->save();

        return new PeliculaResource($pelicula);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelicula  $pelicula
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelicula $pelicula)
    {
        $pelicula->delete();
        return response()->json(['message' => 'pelicula deleted successfully']);

    }
}
