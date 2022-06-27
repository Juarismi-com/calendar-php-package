<?php

namespace Juarismi\Calendar\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AgendaItem extends Model
{
    protected $table = 'caled_agenda_item';
	protected $fillable = [
		'creador_id',
		'cliente_id',
		'atendedor_id',
		'fecha',
		'hora',
		'asistio',
		'agenda_tipo_id',
		'observacion',
		'estado',
	];

	public function cliente(){
		return $this->hasOne(
			'Juariami\Base\Models\Negocio\Cliente',
			'id',
			'cliente_id'
		);	
	}

	/**
	 * Persona asignada, o encargada de atender la cita/agenda
	 */
	public function atendedor(){
		return $this->hasOne(
			'Juariami\Base\Models\Negocio\Empleado',
			'id',
			'atendedor_id'
		);	
	}



	public function setFechaAttribute($value){
	    $this->attributes['fecha'] =  Carbon::parse($value);
	}

}
