<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Movimento.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $description
 * @property string $tipo
 * @property string $valor
 * @property string $data
 * @property int $conta_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Conta $conta
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereContaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movimento whereValor($value)
 * @mixin \Eloquent
 */
class Movimento extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'description', 'tipo', 'valor', 'data', 'conta_id'
	];

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
