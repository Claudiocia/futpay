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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Campeonato $campeonato
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Disputacamp newModelQuery()
 * @method static Builder|Disputacamp newQuery()
 * @method static Builder|Disputacamp query()
 * @method static Builder|Disputacamp whereCampeonatoId($value)
 * @method static Builder|Disputacamp whereCreatedAt($value)
 * @method static Builder|Disputacamp whereData($value)
 * @method static Builder|Disputacamp whereGolplay1($value)
 * @method static Builder|Disputacamp whereGolplay2($value)
 * @method static Builder|Disputacamp whereHora($value)
 * @method static Builder|Disputacamp whereId($value)
 * @method static Builder|Disputacamp wherePlayer1($value)
 * @method static Builder|Disputacamp wherePlayer2($value)
 * @method static Builder|Disputacamp whereUpdatedAt($value)
 * @method static Builder|Disputacamp whereUrlVideo($value)
 * @method static Builder|Disputacamp whereVencedor($value)
 * @mixin Eloquent
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
