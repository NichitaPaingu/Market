<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeaderLinksController extends Controller
{
    public function bestPrices(){
        return view('pages.best-prices');
    }
    public function delivery(){
        return view('pages.delivery');
    }
    public function payment(){
        return view('pages.payment');
    }
    public function return(){
        return view('pages.return');
    }
    public function contact(){
        return view('pages.contact');
    }
}
