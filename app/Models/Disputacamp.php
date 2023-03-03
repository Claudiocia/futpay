<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Disputacamp.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property int $campeonato_id
 * @property int $player1
 * @property int $player2
 * @property int|null $golplay1
 * @property int|null $golplay2
 * @property string $data
 * @property string $hora
 * @property int|null $vencedor
 * @property string|null $url_video
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Campeonato $campeonato
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp query()
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereCampeonatoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereGolplay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereGolplay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereUrlVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disputacamp whereVencedor($value)
 * @mixin \Eloquent
 */
class Disputacamp extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'campeonato_id',
		'player1',
		'player2',
        'golplay1',
        'golplay2',
		'data',
		'hora',
		'vencedor',
		'url_video',
	];

    public function campeonato()
    {
        return $this->belongsTo(Campeonato::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
