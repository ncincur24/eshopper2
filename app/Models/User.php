<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $full_name
 * @property string $email
 * @property string $password
 * @property int $active
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registerUser($name, $last_name, $email, $password)
    {
        $this::create([
           "name" => $name,
           "last_name" => $last_name,
           "full_name" => $name." ".$last_name,
           "email" => $email,
           "password" => $password
        ]);
    }

    public function listOfUsers()
    {
        return $this::where("id","<>", session()->get("user")->id)->get();
    }

    public function logInUser($email, $password)
    {
        return $this::where("email", $email)->first();
    }

    public function changeColumnStatus($id, $column, $value)
    {
        $query = $this::find($id);
        if($column == "active"){
            $query->active = $value;
        }
        else{
            $query->role_id = $value;
        }
        $query->save();
    }
}
