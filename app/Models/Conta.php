<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Movimento> $movimentos
 * @property-read int|null $movimentos_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Conta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereSaldo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereUserId($value)
 * @property string $active
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereActive($value)
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Conta onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Conta withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Conta withoutTrashed()
 * @mixin \Eloquent
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
		'numero', 'saldo', 'active', 'user_id',
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
