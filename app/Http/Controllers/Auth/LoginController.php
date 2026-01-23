<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $login = $request->input($this->username());

        $field = 'username';

        // ค้นหา User
        $user = User::where('username', $login)->orWhere('std_id', $login)->first();

        if ($user) {
            // 2.ตรวจสอบ Status
            // ถ้าสถานะเป็น 'Inactive' ไม่ให้ผ่าน
            if ($user->status === 'Inactive') {
                throw ValidationException::withMessages([
                    $this->username() => ['บัญชีคุณถูกระงับโปรดติดต่อเจ้าหน้าที่'],
                ]);
            }

            // เช็คว่าเป็น std_id หรือไม่
            if ($user->std_id === $login) {
                $field = 'std_id';
            }
        }

        return [
            $field => $login,
            'password' => $request->input('password'),
        ];
    }
}
