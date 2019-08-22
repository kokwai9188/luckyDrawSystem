<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Winning as win;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $winners = win::limit(10)->orderby('created_at', 'desc')->get();

        $data['winners'] = $winners;

        return view('home', $data);
    }
}
