<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.login.login');
    }

    /**
     * Admin Login.
     */
    public function login(Request $request)
    {
        $data = array();
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);
            $request->session()->regenerate();

            $data = json_encode([
                'response' => '1',
                'message' => "Login success.",
            ]);
        } else {
            $data = json_encode([
                'response' => '0',
                'message' => "Login failed, Please check your username and password."
            ]);
        }

        return $data;
    }

    /**
     * Admin logout.
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin_loginx');
    }
}
