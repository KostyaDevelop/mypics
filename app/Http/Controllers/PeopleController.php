<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photos;
use App\Models\Avatar;

class PeopleController extends Controller
{
    public  function index($id)
    {
        $name = User::where('id', $id)
            ->first()
            ->name;
        $email = User::where('id', $id)
            ->first()
            ->email;

        $array_from_table_photos = Photos::where('id_user', $id)->get();
        $photo_array = [];
        $i = 0;
        foreach ($array_from_table_photos as $photo_single)
        {
            if ($photo_single['photo']) {
                $i++;
                $photo_name = str_replace('http://mypics.localhost/storage/', '',  $photo_single['photo']);

                $photo_array[$i]['photo_name'] =  $photo_name;
                $photo_array[$i]['photo_path'] = $photo_single['photo'];
            } else {
                $photo_array[] = null;
            }
        }

        if (!file_exists('public/uploads/avatars'))
        {
        $array_from_table_avatars = Avatar::where('id_user', $id)->get();
            if (!empty( $array_from_table_avatars->first()->avatar ))
            {
                $array_from_table_avatars_avatar = $array_from_table_avatars->first()->avatar;
                $avatar =  $array_from_table_avatars_avatar;
            } else
                {
                $avatar = '';
            }
        }else{
            $avatar = '';
        }
        $login = User::where('id', $id)
            ->first()
            ->login;
//        echo '<pre>';
//        var_dump($photo_array);
//        echo '</pre>';
        return view('people', [
            'id' => $id,
            'login' => $login,
            'name' => $name,
            'email' => $email,
            'photo_array' => $photo_array,
            'avatar' => $avatar
        ]);
    }
    public function store_photo(Request $request, $id)
    {
        //Выбираем изображение из реквеста
        $image = $request->file('picture');

        //Забираем оригинальное имя
        $originalname = $image->getClientOriginalName();

        //Вставляем изображение с оригинальным именем в наш проект
        $request->file('picture')->storeAs('uploads/', $originalname);

        //Берем путь до нашего изображения
        $path_photo_full =  asset('/storage') . '/' .  $originalname;

        //Помещаем наше изображение в массив
        $request_array = ($request->all());
        $request_array['photo'] =  $path_photo_full;

        //Помещаем наш id в массив
        $request_array['id_user'] =  $id;

        //Загружаем массив в БД
        Photos::create($request_array);

        return(redirect()->route('people', $id));
    }
    public function store_avatar(Request $request, $id)
    {

        //Выбираем изображение из реквеста
        $image = $request->file('avatar');

        //Забираем оригинальное имя
        $originalname = $image->getClientOriginalName();

        //Вставляем изображение с оригинальным именем в наш проект
        $request->file('avatar')->storeAs('/uploads', $originalname);

        //Берем путь до нашего изображения
        $path_photo_full =  asset('/storage') . '/' .  $originalname;

        //Помещаем наше изображение в массив
        $request_array = ($request->all());
        $request_array['avatar'] =  $path_photo_full;

        //Помещаем наш id в массив
        $request_array['id_user'] =  $id;

        //Загружаем массив в БД
        Avatar::create($request_array);

        return(redirect()->route('people', $id));
    }
    public function delete_photo( $id, $photo_name)
    {
        $urlPhoto = "http://mypics.localhost/storage/" . $photo_name;
        Photos::where('photo','=', $urlPhoto)->delete();
//        Storage::disk('public')->delete($photo_single);
        return(redirect()->route('people', $id));
    }
}
