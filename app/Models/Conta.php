<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @mixin \Eloquent
 */
class Conta extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'numero', 'saldo', 'user_id'
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
