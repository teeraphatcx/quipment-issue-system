<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        return view('faq'); 
    }
}
