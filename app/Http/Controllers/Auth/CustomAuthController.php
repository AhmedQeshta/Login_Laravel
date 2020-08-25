<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomAuthController extends Controller
{
    public function Adult(){
        return view('customAuth.index');
    }
}
