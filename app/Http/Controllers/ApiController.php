<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ApiController extends Controller
{
    public function getUsers(Request $request){
        $users = User::where('admin', 0)->skip(2 * ($request->page - 1))->take(2)->get();
        return $users;
    }

    public function getPages(){
        return User::where('admin', 0)->count();
    }
}
