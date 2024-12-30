<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $userType = auth()->user()->type;

            // Tentukan rute berdasarkan tipe pengguna
            if ($userType == 'admin') {
                return redirect()->route('admin.adminHome')
                    ->with('success', 'Berhasil login sebagai Admin.');
            } elseif ($userType == 'manager') {
                return redirect()->route('manager.home')
                    ->with('success', 'Berhasil login sebagai Manager.');
            } else {
                return redirect()->route('voter.home')
                    ->with('success', 'Berhasil login sebagai Pemilih.');
            }
        } else {
            // Gagal login
            return redirect()->route('login')
                ->with('error', 'Email atau Password salah. Silakan coba lagi.');
        }
    }
}
