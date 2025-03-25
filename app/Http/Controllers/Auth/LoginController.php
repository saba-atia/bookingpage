<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Determine where to redirect users after login.
     */
    public function redirectTo()
    {
        return Auth::user()->is_admin ? '/dashboard' : '/';
    }
}
