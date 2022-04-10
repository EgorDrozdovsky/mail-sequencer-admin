<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class ApiController extends Controller
{
    public function getUsers(Request $request){
        if ($request->sort === 1){
            $users = User::where('admin', 0)->where('email', 'LIKE', "%{$request->search}%")->orderBy('id')->skip(5 * ($request->page - 1))->take(5)->get();
        } else if ($request->sort === 2){
            $users = User::where('admin', 0)->orderBy('email')->skip(5 * ($request->page - 1))->take(5)->get();
        } else if ($request->sort === 3){
            $users = User::where('admin', 0)->orderBy('type')->skip(5 * ($request->page - 1))->take(5)->get();
        }
        return $users;
    }

    public function getPages(){
        return User::where('admin', 0)->count();
    }

    public function addUser(Request $request){
        $user = new User();
        if ($request->role === 'admin'){
            $user->admin = 1;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
        } else {
            $user->admin = 0;
            $user->name = 'Default';
            $user->type = $request->type;
        }
        $user->email = $request->email;
        return $user->save();
    }
}
