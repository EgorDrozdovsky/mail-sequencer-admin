<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;

class ApiController extends Controller
{
    public function getUsers(Request $request){
        if ($request->sort === 1){
            $users = User::where('admin', 0)->where('email', 'LIKE', "%{$request->search}%")->orderBy('id')->skip(25 * ($request->page - 1))->take(25)->get();
        } else if ($request->sort === 2){
            $users = User::where('admin', 0)->where('email', 'LIKE', "%{$request->search}%")->orderBy('email')->skip(25 * ($request->page - 1))->take(25)->get();
        } else if ($request->sort === 3){
            $users = User::where('admin', 0)->where('email', 'LIKE', "%{$request->search}%")->orderBy('type')->skip(25 * ($request->page - 1))->take(25)->get();
        } else if ($request->sort === 4){
            $users = User::where('admin', 0)->where('email', 'LIKE', "%{$request->search}%")->orderBy('created_at')->skip(25 * ($request->page - 1))->take(25)->get();
        }
        return $users;
    }

    public function getAdmins(){
        return User::where('admin', 1)->get();
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

    public function editUser(Request $request){
        $user = User::find($request->user['id']);
        $user->name = $request->user['name'];
        $user->email = $request->user['email'];
        $user->type = $request->user['type'];
        if (isset($request->user['password'])){
            $user->password = Hash::make($request->user['password']);
        }
        return $user->save();
    }

    public function delUser(Request $request){
        return User::find($request->id)->delete();
    }
}
