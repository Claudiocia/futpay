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
 * Class Campeonato.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $hora
 * @property string $data
 * @property string $valor
 * @property string $premio
 * @property int $qtd_players
 * @property string $status
 * @property string|null $arrecadacao_total
 * @property int|null $vencedor
 * @property int|null $vice
 * @property int|null $terceiro
 * @property int|null $quarto
 * @property int $plataforma_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Plataforma $plataforma
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Campeonato newModelQuery()
 * @method static Builder|Campeonato newQuery()
 * @method static Builder|Campeonato query()
 * @method static Builder|Campeonato whereArrecadacaoTotal($value)
 * @method static Builder|Campeonato whereCreatedAt($value)
 * @method static Builder|Campeonato whereData($value)
 * @method static Builder|Campeonato whereHora($value)
 * @method static Builder|Campeonato whereId($value)
 * @method static Builder|Campeonato wherePlataformaId($value)
 * @method static Builder|Campeonato wherePremio($value)
 * @method static Builder|Campeonato whereQtdPlayers($value)
 * @method static Builder|Campeonato whereQuarto($value)
 * @method static Builder|Campeonato whereStatus($value)
 * @method static Builder|Campeonato whereTerceiro($value)
 * @method static Builder|Campeonato whereUpdatedAt($value)
 * @method static Builder|Campeonato whereValor($value)
 * @method static Builder|Campeonato whereVencedor($value)
 * @method static Builder|Campeonato whereVice($value)
 * @mixin Eloquent
 */
class Campeonato extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'hora',
		'data',
		'valor',
		'premio',
		'qtd_players',
		'status',
		'arrecadacao_total',
		'vencedor',
		'vice',
		'terceiro',
		'quarto',
		'plataforma_id',
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
