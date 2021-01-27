@extends('layouts.app')

@section('content')
    <div class="head_page">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                @if(!empty($avatar))
                    <div class="avatar-box">
    {{--                        <a href="{{route('add_avatar')}}">--}}
                            <img class="avatar" src="{{$avatar}}">
    {{--                        </a>--}}
                    </div>
                @else
                <form class="head_page_store-avatar"
                      action="{{route("add_avatar", $id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label class="head_page_store-avatar_item" for="">Загрузите аватар</label>
                    <input  class="head_page_store-avatar_item"  name="avatar" type="file"
                            value="" readonly>
                    <input class="btn-primary head_page_store-avatar_item" type="submit" value="Сохранить" >
                </form>
                @endif
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="row-1 info-user">
                    <span class="head_page_item head_page_item_login">{{$login}}</span>
                </div>
                <div class="row-2 info-user">
                    <span class="head_page_item head_page_ite   m-count">
                        <b  class="head_page_item_count-number">{{count($photo_array)}}</b>
                        публикаций
                    </span>
                    <span class="head_page_item head_page_item-count">
                        <b  class="head_page_item_count-number">-</b>
                        подпичсчиков
                    </span>
                    <span class="head_page_item head_page_item-count">
                        <b  class="head_page_item_count-number">-</b>
                        подпичсок
                    </span>
                </div>
                <div class="row-3 info-user">
                    <b class="head_page_item head_page_item-name">
                       {{$name}}
                    </b>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <form class="head_page_store-photo"
                      action="{{route("add_photo", $id)}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <label class="head_page_store-photo_item" for="">Загрузите изображение</label>
                    <input  class="head_page_store-photo_item"  name="picture" type="file"
                            value="" readonly>
                    <input class="btn-primary head_page_store-photo_item" type="submit" value="Сохранить" >
                </form>
            </div>
        </div>
    </div>

    <hr>
    <div class="content">
        <div class="row">
            @foreach($photo_array as $photo_single)
                @if(!empty($photo_single))
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="photo_on_page_block">
                            <div class="photo_on_page_block_del">
                                <form action="{{route('delete_photo',  ['id' => $id, 'photo_name' => $photo_single['photo_name']])}}" method="post">
                                    @csrf
                                    <button type="submit">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="32.034px" height="32.033px" viewBox="0 0 32.034 32.033" style="enable-background:new 0 0 32.034 32.033;"
                                         xml:space="preserve">
                                        <g>
                                            <g id="Close">
                                                <g>
                                                    <path d="M21.679,16.017l9.18-9.172c0.758-0.755,1.175-1.76,1.175-2.828s-0.417-2.073-1.175-2.829
                                                        c-0.754-0.755-1.762-1.171-2.83-1.171c-1.069,0-2.075,0.416-2.832,1.171l-9.182,9.172L6.834,1.188
                                                        C6.078,0.432,5.072,0.016,4.001,0.016c-1.068,0-2.074,0.416-2.83,1.172c-1.561,1.56-1.562,4.097,0,5.657l9.182,9.172
                                                        l-9.181,9.172c-1.562,1.562-1.562,4.099,0,5.658c0.756,0.755,1.762,1.171,2.831,1.171s2.075-0.416,2.831-1.172l9.181-9.172
                                                        l9.181,9.171c0.757,0.755,1.762,1.172,2.83,1.172c1.07,0,2.076-0.416,2.832-1.172c1.562-1.562,1.562-4.099,0-5.657L21.679,16.017
                                                        z M29.442,29.431c-0.756,0.755-2.074,0.756-2.832,0l-9.887-9.878c-0.392-0.393-1.025-0.393-1.416,0l-9.889,9.879
                                                        c-0.757,0.755-2.075,0.755-2.832,0c-0.78-0.78-0.78-2.049,0-2.829l9.889-9.879c0.188-0.188,0.293-0.44,0.293-0.707
                                                        c0-0.265-0.105-0.52-0.293-0.707l-9.89-9.879c-0.78-0.78-0.78-2.049,0-2.829c0.379-0.378,0.882-0.586,1.416-0.586
                                                        c0.536,0,1.038,0.208,1.417,0.586l9.889,9.879c0.391,0.391,1.024,0.391,1.416,0l9.889-9.878c0.757-0.756,2.074-0.756,2.832-0.001
                                                        c0.377,0.378,0.586,0.881,0.586,1.415s-0.209,1.036-0.586,1.414l-9.889,9.879c-0.392,0.391-0.392,1.022,0,1.414l9.889,9.878
                                                        C30.224,27.382,30.224,28.65,29.442,29.431z"/>
                                                </g>
                                            </g>
                                        </g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                    </svg>
                                    </button>
                                </form>
                            </div>
                            <img class="photo_on_page" src="{{$photo_single['photo_path'] ?? ''}} ">
                        </div>
                    </div>
                @else
                    <span>Фотографии отсутсвуют</span>
                @endif
            @endforeach
        </div>
    </div>
@endsection('content')

