<?php

namespace App\Http\Controllers;

use Redirect;
use Auth;
use Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\BusDispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\Html\ServiceProvider;

use App\Http\Controllers\Controller;
use App\User as user;

class UserController extends Controller
{
    public function list_user()
    {
        // $users = [
        //     [
        //         "name" => "John",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],
        //     [
        //         "name" => "Carol",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],
        //     [
        //         "name" => "Kenny",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],
        //     [
        //         "name" => "Jason",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],
        //     [
        //         "name" => "Sean",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],
        //     [
        //         "name" => "Lisa",
        //         "phone" => "85239196",
        //         "email" => "kwai8891@gmail.com",

        //     ],

        // ];
        

        // foreach ($users as $key => $value) {
        //     $user = new user;
        //     $user->name = $value['name'];
        //     $user->email = $value['email'];
        //     $user->phone = $value['phone'];
        //     $user->save();
        // }
        $users = user::all();
        return $users;
    }
}
