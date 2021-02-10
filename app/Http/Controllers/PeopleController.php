<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photos;
use App\Models\Avatar;
use App\Models\Comment;

class PeopleController extends Controller
{
    public function index(int $id)
    {
        $name = User::getName($id);
        $email = User::getEmail($id);

        $array_from_table_photos = Photos::getPhotos($id);
        $photo_array = [];

        $i = 0;

        foreach ($array_from_table_photos as $photo_single) {
            if ($photo_single['photo']) {

                $i++;

                $photoID = Photos::getPhotoId($photo_single['photo']);
                $photoComment = Comment::getComment($photoID);
                $photoName = str_replace('http://mypics.localhost/storage/', '', $photo_single['photo']);

                $photo_array[$i]['photo_id'] = $photoID;
                $photo_array[$i]['photo_comment'] = $photoComment;
                $photo_array[$i]['photo_name'] = $photoName;
                $photo_array[$i]['photo_path'] = $photo_single['photo'];

            } else {
                $photo_array[] = null;
            }
        }
        $array_from_table_avatars = Avatar::getAvatar($id);

        if (!empty($array_from_table_avatars->first()->avatar)) {
            $array_from_table_avatars_avatar = $array_from_table_avatars->first()->avatar;
            $avatar = $array_from_table_avatars_avatar;
            $avatarCutPath = str_replace('http://mypics.localhost/storage/', '', $avatar);
        } else {
            $avatarCutPath = '';
            $avatar = '';
        }

        $login = User::getLogin($id);

        return view('people', [
            'id' => $id,
            'login' => $login,
            'name' => $name,
            'email' => $email,
            'photo_array' => $photo_array,
            'avatar' => $avatar,
            'avatarCutPath' => $avatarCutPath
        ]);
    }

    public function addPhoto(Request $request, int $id)
    {
        //Выбираем изображение из реквеста
        $image = $request->file('picture');

        //Забираем оригинальное имя
//        $originalname = $image->getClientOriginalName();

        //Вставляем изображение с оригинальным именем в наш проект
        $request->file('picture')->storeAs('uploads/', $image);

        //Берем путь до нашего изображения
        $path_photo_full = asset('/storage') . '/' . $image;

        //Помещаем наше изображение в массив
        $request_array = ($request->all());
        $request_array['photo'] = $path_photo_full;

        //Помещаем наш id в массив
        $request_array['id_user'] = $id;

        //Загружаем массив в БД
        Photos::create($request_array);

        return (redirect()->route('people', $id));
    }

    public function deletePhoto(int $id, string $photo_name)
    {
        $urlPhoto = "http://mypics.localhost/storage/" . $photo_name;

        Photos::where('photo', '=', $urlPhoto)->delete();

        return (redirect()->route('people', $id));
    }

    public function addAvatar(Request $request, int $id)
    {
        $image = $request->file('avatar');

        $originalname = $image->getClientOriginalName();

        $request->file('avatar')->storeAs('/uploads', $originalname);

        $path_photo_full = asset('/storage') . '/' . $originalname;

        $request_array = ($request->all());
        $request_array['avatar'] = $path_photo_full;
        $request_array['id_user'] = $id;

        Avatar::create($request_array);

        return (redirect()->route('people', $id));
    }

    public function deleteAvatar(int $id, string $avatar_name)
    {
        $urlPhoto = "http://mypics.localhost/storage/" . $avatar_name;

        Avatar::where('avatar', '=', $urlPhoto)->delete();

        return (redirect()->route('people', $id));
    }
    public function takeComment(Request $request, $id)
    {
        $idPhoto = $request->input('id-photo');
        $commentPhoto = $request->input('comment');

         Comment::create(array('id_photos' => $idPhoto,'text'  => $commentPhoto));

         return (redirect()->route('people', $id));
    }
}
