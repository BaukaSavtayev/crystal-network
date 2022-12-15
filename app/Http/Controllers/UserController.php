<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class  UserController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        return response()->json(Auth::user());
    }
}
