<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Website
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Website whereUrl($value)
 * @mixin \Eloquent
 */
class Website extends Model
{
    protected $guarded = [];
}
