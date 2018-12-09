<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $persona_id
 * @property int $areas_id
 * @property string $codigo
 * @property string $asunto
 * @property string $descipcion
 * @property string $imagen
 * @property Area $area
 * @property Persona $persona
 * @property Movimiento[] $movimientos
 */
class Documento extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'documento';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['persona_id', 'areas_id', 'codigo', 'asunto','estado','visto','prioridad', 'descipcion', 'imagen'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Areas', 'areas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movimientos()
    {
        return $this->hasMany('App\Movimiento');
    }

    public function detalle_areas($id)
  {
      return Detalle_Area::where('areas_id', $id)->first();
      //return DetalleVenta::where('venta_id', $venta_id)->where('producto_id', $producto_id)->first();
  }
}
