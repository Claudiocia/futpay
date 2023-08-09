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
 * Class Jogo.
 *
 * @package namespace App\Models;
 * @property int $id
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
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Jogo newModelQuery()
 * @method static Builder|Jogo newQuery()
 * @method static Builder|Jogo query()
 * @method static Builder|Jogo whereCreatedAt($value)
 * @method static Builder|Jogo whereData($value)
 * @method static Builder|Jogo whereGolplay1($value)
 * @method static Builder|Jogo whereGolplay2($value)
 * @method static Builder|Jogo whereHora($value)
 * @method static Builder|Jogo whereId($value)
 * @method static Builder|Jogo wherePlayer1($value)
 * @method static Builder|Jogo wherePlayer2($value)
 * @method static Builder|Jogo whereUpdatedAt($value)
 * @method static Builder|Jogo whereUrlVideo($value)
 * @method static Builder|Jogo whereVencedor($value)
 * @mixin Eloquent
 */
class Jogo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id',
		'player1',
		'player2',
        'golplay1',
        'golplay2',
        'data',
        'hora',
		'vencedor',
		'url_video',
	];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
