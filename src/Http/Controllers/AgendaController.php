<?php

namespace Juarismi\Calendar\Http\Controllers;

use Illuminate\Http\Request;
use Juarismi\Calendar\Models\AgendaItem;
use Juarismi\Base\Http\Controllers\AppController;

class AgendaController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendaList = AgendaItem::paginate();
        return $agendaList;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Filtros
    	$fecha = $request->input('fecha', NULL);

    	$agenda = new AgendaItem;
    	if ($fecha != NULL){
    		$agenda->fecha = \Carbon\Carbon::createFromFormat(
	        	'd/m/Y', $fecha
	        )->toDateString();
    	}

        $agenda->cliente_id = $request->input('id_cliente', 0);
        $agenda->observacion = urldecode($request->input('observacion', '-'));
        $agenda->atendedor_id = $request->input('atendedor_id',NULL);
        $agenda->estado = $request->input('estado', 1);
        $agenda->hora = $request->input('hora', NULL);
        $agenda->save();

        return [
            "data" => $agenda,
            "message" => "Cita agregada correctamente"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = AgendaItem::find($id);
        if(!isset($agenda)){
            return response([
                'errors' => [
                    'AgendaItem/cita no encontrada' 
                ]
            ], 404);
        }

        return ["data" => $agenda ];
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agenda = AgendaItem::find($id);
        $fecha = $request->input('fecha', NULL);
        $hora = $request->input('hora', NULL);
        $horaHasta = $request->input('hora_hasta', NULL);

        if (!isset($agenda)){
            return response([
                'errors' => [
                    'AgendaItem/cita no encontrada' 
                ]
            ], 404);
        }

        if ($fecha == NULL || $hora == NULL || $horaHasta == NULL){ 
            return response([
                'errors' => [
                    'Inicializar todos los campos relacionados a la fecha' 
                ]
            ], 500);
    	}


        $agenda->fecha = \Carbon\Carbon::createFromFormat(
            'd/m/Y', urldecode($fecha)
        )->toDateString();

        $agenda->id_cliente = $request->input('id_cliente', 0);
        $agenda->observacion = urldecode($request->input('observacion', '-'));
        $agenda->id_responsable = $request->input('id_responsable',NULL);
        $agenda->estado = $request->input('estado', 'activo');
        $agenda->asistio = $request->input('asistio', 0);
        $agenda->hora_hasta = urldecode($horaHasta);
        $agenda->hora = urldecode($hora);
        $agenda->save();

        return [
            "data" => $agenda,
            "message" => "Cita editada correctamente"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = AgendaItem::find($id);
        if (!isset($agenda))
            return response([
                'errors' => [
                    'AgendaItem/cita no encontrada' 
                ]
            ], 404);


        $agenda->delete();

        return [
            "message" => "Cita eliminada correctamente"
        ];
    }
}
