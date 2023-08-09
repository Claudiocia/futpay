<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Conta.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $numero
 * @property string $saldo
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Movimento> $movimentos
 * @property-read int|null $movimentos_count
 * @property-read User $user
 * @method static Builder|Conta newModelQuery()
 * @method static Builder|Conta newQuery()
 * @method static Builder|Conta query()
 * @method static Builder|Conta whereCreatedAt($value)
 * @method static Builder|Conta whereId($value)
 * @method static Builder|Conta whereNumero($value)
 * @method static Builder|Conta whereSaldo($value)
 * @method static Builder|Conta whereUpdatedAt($value)
 * @method static Builder|Conta whereUserId($value)
 * @property string $active
 * @method static Builder|Conta whereActive($value)
 * @property Carbon|null $deleted_at
 * @method static Builder|Conta onlyTrashed()
 * @method static Builder|Conta whereDeletedAt($value)
 * @method static Builder|Conta withTrashed()
 * @method static Builder|Conta withoutTrashed()
 * @property string $bloqueado
 * @property string $disponivel
 * @method static Builder|Conta whereBloqueado($value)
 * @method static Builder|Conta whereDisponivel($value)
 * @mixin Eloquent
 */
class Conta extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'numero', 'saldo', 'bloqueado', 'disponivel', 'active', 'user_id',
	];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movimentos()
    {
        return $this->hasMany(Movimento::class);
    }
}
