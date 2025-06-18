<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function HomePage()
    {
        return Inertia::render('HomePage');
    }

    public function test()
    {
        // return response()->json('hello');
        return Inertia::render('Home');
    }
}
