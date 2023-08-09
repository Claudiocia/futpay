<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Conta $conta
 * @method static Builder|Movimento newModelQuery()
 * @method static Builder|Movimento newQuery()
 * @method static Builder|Movimento query()
 * @method static Builder|Movimento whereContaId($value)
 * @method static Builder|Movimento whereCreatedAt($value)
 * @method static Builder|Movimento whereData($value)
 * @method static Builder|Movimento whereDescription($value)
 * @method static Builder|Movimento whereId($value)
 * @method static Builder|Movimento whereTipo($value)
 * @method static Builder|Movimento whereUpdatedAt($value)
 * @method static Builder|Movimento whereValor($value)
 * @property string $operation_key
 * @property string $status
 * @property string|null $motiv_status
 * @method static Builder|Movimento whereMotivStatus($value)
 * @method static Builder|Movimento whereOperationKey($value)
 * @method static Builder|Movimento whereStatus($value)
 * @property string $data_unix
 * @property string $meio_pag
 * @method static Builder|Movimento whereDataUnix($value)
 * @method static Builder|Movimento whereMeioPag($value)
 * @mixin Eloquent
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
		'description', 'tipo', 'valor', 'data', 'data_unix',
        'conta_id', 'operation_key', 'status', 'motiv_status', 'meio_pag',
	];

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }
}
