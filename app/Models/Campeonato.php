<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plataforma $plataforma
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereArrecadacaoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato wherePlataformaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato wherePremio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereQtdPlayers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereQuarto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereTerceiro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereValor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereVencedor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Campeonato whereVice($value)
 * @mixin \Eloquent
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
