<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Rachao.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $premio
 * @property string $hora
 * @property string $arrecadacao_total
 * @property string $data
 * @property int $plataforma_id
 * @property int $qtd_players
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plataforma $plataforma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereArrecadacaoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao wherePlataformaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereQtdPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rachao whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rachao extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'premio',
		'hora',
		'data',
		'arrecadacao_total',
		'plataforma_id',
		'qtd_players',
		'status',
	];

    public function plataforma()
    {
        return $this->belongsTo(Plataforma::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
