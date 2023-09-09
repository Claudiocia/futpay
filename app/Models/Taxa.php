<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Taxa.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $operation
 * @property string $tipo
 * @property float $valor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Taxa whereValor($value)
 * @mixin \Eloquent
 */
class Taxa extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'operation',
		'tipo',
		'valor',
	];

}
