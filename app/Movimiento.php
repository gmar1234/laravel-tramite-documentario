<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $documento_id
 * @property int $areas_id
 * @property string $fecha
 * @property string $hora
 * @property string $area_salida
 * @property string $area_entrada
 * @property Area $area
 * @property Documento $documento
 */
class Movimiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'movimiento';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['documento_id', 'areas_id', 'fecha', 'hora', 'area_salida', 'area_entrada'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Area', 'areas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function documento()
    {
        return $this->belongsTo('App\Documento');
    }
}
