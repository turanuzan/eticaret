<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SepetController extends Controller
{
    public function __construct()
    {
        // controller içerisinde bu şekilde middleware kullanılarak
        // bu controller a ulaşması için GİRİŞ YAPMASI zorlanmaktadır.
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('sepet');
    }
}
