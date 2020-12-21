<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array(
            'module'        => 'dashboard',
            'title'         => 'Dashboard',
            'link-title'    => 'Dashboard',
            'link'          => '/',
            'parent'        => '',
            'parent-link'   => ''
        );

        return view('users.home')->with('data', $data);
    }
}
