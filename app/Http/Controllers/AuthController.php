<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |Public function / User login
    |--------------------------------------------------------------------------
    */
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors(['user name and password required', 'The Message']);
        }

        $userdata = array(
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        );

        if (Auth::attempt($userdata)) {
            if(User::where('id',Auth::id())->exists()){
                session([
                    'permissions' => $this->getUsersPermissions(),
                ]);
                return redirect()->route('dashboard');
            }
            Auth::logout();
            return redirect()->route('login')->withErrors(['Your no longer available..', 'The Message']);
        }

        return redirect()->route('login')->withErrors(['username or password does not exist.', 'The Message']);
    }


    /*
    |--------------------------------------------------------------------------
    |Public function / Logout
    |--------------------------------------------------------------------------
    */
    public function doLogout(){
        Auth::logout();
        return redirect()->route('login');
    }


    private function getUsersPermissions(){
        $permissions = DB::table('user_role_permission_map')
                ->join('permissions', 'permissions.id', '=', 'user_role_permission_map.permission')
                ->where('user_role_permission_map.user_role', Auth::user()->user_role)
                ->pluck('permissions.title');

        return $permissions->toArray();
    }
}
