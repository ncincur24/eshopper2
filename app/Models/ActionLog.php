<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\ActionLog
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $ip
 * @property string $path
 * @property string $method
 * @property string $action
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActionLog whereUpdatedAt($value)
 */
class ActionLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function markAction($ip, $path, $method, $action)
    {
        $this::create([
            "ip" => $ip,
            "path" => $path,
            "method" => $method,
            "action" => $action
        ]);
    }

    public function getActions(Request $request)
    {
        $query = $this;

        if($request->has("from") && $request->get("from") != null){
            $query = $query->where("created_at", ">", $request->get("from"));
        }
        if($request->has("to") && $request->get("to") != null){
            $query = $query->where("created_at", "<", $request->get("to"));
        }
        return $query->get();
    }
}
