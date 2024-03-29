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
 * Class Plataforma.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Plataforma newModelQuery()
 * @method static Builder|Plataforma newQuery()
 * @method static Builder|Plataforma query()
 * @method static Builder|Plataforma whereCreatedAt($value)
 * @method static Builder|Plataforma whereId($value)
 * @method static Builder|Plataforma whereName($value)
 * @method static Builder|Plataforma whereUpdatedAt($value)
 * @property string $sigla
 * @method static Builder|Plataforma whereSigla($value)
 * @mixin Eloquent
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
