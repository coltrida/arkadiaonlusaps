<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(UserService $userService)
    {
        return view('pages.home');
    }
}
