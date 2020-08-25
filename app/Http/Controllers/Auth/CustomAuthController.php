<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;

class CustomAuthController extends Controller
{
    public function Adult(){
        return view('customAuth.index');
    }

    public function sitePage(){
        return view('site');
    }
    public function adminPage(){
        return view('admin');
    }
    public function adminLogin(){
        return view('auth.adminLogin');
    }
    public function saveAdminLogin(Request $request){
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

                return redirect()->intended('/auth/admin');
            }
        } catch (ValidationException $e) {
            return back()->withInput($request->only('email'));
        }

    }
}
