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
 * Class Game.
 *
 * @package namespace App\Models;
 * @property int $id
 * @property string $name
 * @property string|null $sigla
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|Game newModelQuery()
 * @method static Builder|Game newQuery()
 * @method static Builder|Game query()
 * @method static Builder|Game whereCreatedAt($value)
 * @method static Builder|Game whereId($value)
 * @method static Builder|Game whereName($value)
 * @method static Builder|Game whereSigla($value)
 * @method static Builder|Game whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Game extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'sigla',
	];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
