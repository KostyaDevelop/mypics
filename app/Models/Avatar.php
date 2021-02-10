<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'avatar'
    ];
    protected function getAvatar(int $id) : object
    {
        $avatar = self::where('id_user', $id)
            ->get();
        return $avatar;
    }
}
