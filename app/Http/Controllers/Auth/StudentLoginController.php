<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    // Sobrescribe el método username para usar 'username' en lugar de 'email'
    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('auth.student_login');
    }

    public function login(Request $request)
    {
        // Validar las credenciales de entrada
        $this->validate($request, [
            $this->username() => 'required|string', // Usa el campo definido por username()
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al estudiante usando el guard 'student'
        if (Auth::guard('student')->attempt(
            [$this->username() => $request->{$this->username()}, 'password' => $request->password],
            $request->remember
        )) {
            $request->session()->regenerate();
            return redirect()->intended(route('student.dashboard'));
        }

        // Si la autenticación falla, redirigir de vuelta con errores
        return back()->withErrors([
            $this->username() => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput($this->username());
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}