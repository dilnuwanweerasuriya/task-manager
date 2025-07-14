<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserRole;

class AuthRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$user = Auth::user()){
            return redirect('/login');
        }

        // $permission = Route::getCurrentRoute()->getName();
        // $user_role = $user->user_role;

        // if(!$this->havePermission($user_role,$permission)){
        //     return redirect()->route('Forbidden');
        // }

        return $next($request);
    }

    private function havePermission($user_role,$permission){
        $permission = DB::table('user_role_permission_map')
        ->join('permission', 'permission.id', '=', 'user_role_permission_map.permission')
        ->where('user_role_permission_map.user_role', $user_role)
        ->where('permission.title', $permission)
        ->get(['permission.*', 'user_role_permission_map.*']);

        if(count($permission)==1){
            return TRUE;
        }

        return FALSE;
    }
}
