<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class Channel
 *
 * @pakege App\Models
 * @property int $id
 * @property string $username
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @author Otinov Ilya
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel query()
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Channel whereUsername($value)
 * @mixin \Eloquent
 */
class Channel extends GhostModel
{

}
