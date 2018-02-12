<?php

namespace App\Http\Controllers;

use App\Construct;
use Illuminate\Http\Request;
use App\ConstructPercent;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $percent = ConstructPercent::first();
        $constructs = Construct::where('status_id',2)->orderBy('id','desc')->get();
        return view('dashboard',['percent'=>$percent,'constructs'=>$constructs]);
    }
}
