<?php

namespace App\Http\Controllers;


use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signin(Request $request){
        $theme = Theme::find(1);
        $data=[
            'background'=>$theme->image->path,
        ];
        return view('user.signin')->with('data',$data);
    }

    public function login(LoginRequest $request){
        if(Auth::attempt($request->validated())){
            return redirect()->route('index')->with('message','Вы авторизировались');
        }
        else{
            return redirect()->route('signin')->with('message','Неверный логин или пароль');
        }
    }
    public function create()
    {
        $theme = Theme::find(1);
        $data=[
            'background'=>$theme->image->path,
        ];
        return view('user.create')->with('data',$data);
    }

    public function store(StoreRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('signin')->with('message','Пользователь создан');
    }
}
