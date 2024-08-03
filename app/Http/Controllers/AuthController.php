<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        // pages.main
        return view('pages.login');
    }

    /**
     * Authenticate login user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|max:255',
        ]);
        $email = trim(strtolower($request->email));
        if (! Auth::attempt([
            'email' => $email,
            'password' => $request->password,
        ])) {
            return back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])->withInput();
        }

        return redirect()->route('companies.index');
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('login');
    }
}
