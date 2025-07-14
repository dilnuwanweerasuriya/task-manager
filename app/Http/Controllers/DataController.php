<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Imagw;
use App\Models\UserRole;
use App\Models\EmployeeAttendance;
use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\Client;
use App\Models\Project;
use App\Models\Permission;
use App\Models\UserRolePermissionMap;

class DataController extends Controller
{
    //Get User Roles Function
    public function getUserRoles(){
        $data = UserRole::all();
        return $data;
    }

    //Get Dashboard Counts Function
    public function getDashboardCounts(){
        $data = [
        'users'     => User::count(),
        // 'clients'   => Client::count(),
        // 'projects'  => Project::count(),
        'tasks'     => Task::where('assigned_to', Auth::user()->id)->where('task_status', 1)->count(),
        ];

        return $data;
    }

    //Get All Users Function
    public function getAllUsers(){
        $data = User::all();
        return $data;
    }

    //Get Users Function
    public function getUsers(){
        $data = User::where('user_role', '!=', '1')->get();
        return $data;
    }
    
    //Get User Data Function
    public function getUserData($id){
        $data = User::where('id', $id)->first();
        return $data;
    }


    // public function getAttendance(){
    //     $data = EmployeeAttendance::where('user_id',Auth::user()->id)->where('date',today())->first();
    //     return $data;
    // }


    // public function myTeamData(){
    //     $data = User::with('employeeAttendance')->get();
    //     return $data;
    // }

    //Get Task Status Function
    public function getTaskStatus(){
        $data = TaskStatus::all();
        return $data;
    }


    //Get Task Data Function
    public function getTaskData($id){
        $data = Task::where('id', $id)->first();

        [$data['hours'], $data['minutes']] = explode(':', $data->allocated_time);

        return $data;
    }

    
    // public function getClients(){
    //     $data = Client::all();
    //     return $data;
    // }

    // public function getProjects(){
    //     $data = Project::with('client')->get();
    //     return $data;
    // }

    // public function getProjectData($id){
    //     $data = Project::with('client')->where('id', $id)->first();
    //     return $data;
    // }

    // public function getEditUserRole($id){
    //     $data = UserRole::where('id',$id)->first();
    //     return $data;
    // }

    // protected function getPermission(){

    //     $permissions = Permission::all();

    //     $permission_types = array();

    //     foreach ($permissions as $key => $permission) {

    //         if(isset($permission_types[$permission->type])){
    //             array_push($permission_types[$permission->type], $permission);
    //         }else{
    //             $permission_types[$permission->type][0] = $permission;
    //         }
    //     }
    //     return $permission_types;
    // }


    // public function getUserRolePermission($id){
    //     $data = UserRolePermissionMap::where('user_role',$id)->pluck('permission')->toArray();
    //     return $data;
    // }

    // public function getUserimage(){
    //     $data = DB::table('users')
    //             ->join('user_image', 'user_image.id', '=', 'users.image')
    //             ->where('users.id', Auth::user()->id)
    //             ->select('user_image.name')
    //             ->first();

    //     return $data;
    // }
}
