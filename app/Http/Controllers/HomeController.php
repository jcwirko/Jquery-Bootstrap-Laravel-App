<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::count();
        $products = Product::count();

        return view('home.index', compact('users','products'));
    }
}
