<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Nav
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Nav newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nav newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Nav query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $route
 * @property int $show
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereUpdatedAt($value)
 * @property string|null $icon
 * @method static \Illuminate\Database\Eloquent\Builder|Nav whereIcon($value)
 */
class Nav extends Model
{
    use HasFactory;
    protected $table = "nav";

    public function clientNav()
    {
        return $this::where("show",0)->get();
    }

    public function adminNav()
    {
        return $this::where("show", 1)->get();
    }
}
