<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
            $books = [
                'Harry Potter',
                'Laravel'
            ];
            return view('welcome')->with(['books' => $books]);
    }

    public function hello(){
        return view('hello');
    }

    public function contact(){
        return view('contact');
    }
}
