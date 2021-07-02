<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Nppbkc;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $hasData = false;
        if(\Gate::allows('viewAllNppbkc')){
            $hasData =  Nppbkc::first()!==null;
        }else{
            $hasData =  Nppbkc::query()->where('created_by','=',Auth::user()->id)->first()!==null;
        }
        return view('home',['hasData'=>$hasData]);
    }
}
