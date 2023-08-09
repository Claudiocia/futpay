<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Plataforma $plataforma
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Rachao newModelQuery()
 * @method static Builder|Rachao newQuery()
 * @method static Builder|Rachao query()
 * @method static Builder|Rachao whereArrecadacaoTotal($value)
 * @method static Builder|Rachao whereCreatedAt($value)
 * @method static Builder|Rachao whereData($value)
 * @method static Builder|Rachao whereHora($value)
 * @method static Builder|Rachao whereId($value)
 * @method static Builder|Rachao wherePlataformaId($value)
 * @method static Builder|Rachao wherePremio($value)
 * @method static Builder|Rachao whereQtdPlayers($value)
 * @method static Builder|Rachao whereStatus($value)
 * @method static Builder|Rachao whereUpdatedAt($value)
 * @mixin Eloquent
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
