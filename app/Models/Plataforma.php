<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Plataforma.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereUpdatedAt($value)
 * @property string $sigla
 * @method static \Illuminate\Database\Eloquent\Builder|Plataforma whereSigla($value)
 * @mixin \Eloquent
 */
class Plataforma extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name', 'sigla'
	];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
