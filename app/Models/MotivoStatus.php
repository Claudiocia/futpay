<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * App\Models\MotivoStatus
 *
 * @property int $id
 * @property string $motivo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|MotivoStatus newModelQuery()
 * @method static Builder|MotivoStatus newQuery()
 * @method static Builder|MotivoStatus query()
 * @method static Builder|MotivoStatus whereCreatedAt($value)
 * @method static Builder|MotivoStatus whereId($value)
 * @method static Builder|MotivoStatus whereMotivo($value)
 * @method static Builder|MotivoStatus whereUpdatedAt($value)
 * @mixin Eloquent
 */
class MotivoStatus extends Model implements Transformable
{
    use HasFactory;
    use TransformableTrait;

    protected $fillable = [
        'id', 'motivo'
    ];
}
