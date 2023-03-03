<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereGolplay1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereGolplay2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo wherePlayer1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo wherePlayer2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereUrlVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Jogo whereVencedor($value)
 * @mixin \Eloquent
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
