<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'photo'
    ];

    protected function getPhotos(int $id) : object
    {
        $photos= self::where('id_user', $id)->get();
        return $photos;
    }
    protected function getPhotoId(string $photoPath)
    {
        $photoID = self::where('photo', $photoPath)->pluck('id_photo');
        return $photoID[0];
    }
}
