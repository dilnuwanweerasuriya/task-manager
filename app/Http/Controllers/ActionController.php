<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\UserRole;
use App\Models\User;
use App\Models\Image;
use App\Models\Task;
use App\Models\Client;
use App\Models\Project;
use App\Models\UserRolePermissionMap;

class ActionController extends Controller
{
    //Register Function
    public function doRegister(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'full_name'             => 'required',
                'mobile'                => 'required',
                'gender'                => 'required',
                'email'                 => 'required|email|unique:users,email',
                'password'              => 'required|string|min:6',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $user = User::create([
                'name'          => $request->full_name,
                'mobile'        => $request->mobile,
                'gender'        => $request->gender,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'user_role'     => 2,
            ]);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'User created successfully!');

        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
        }
    }

    //Update User Function
    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);

        try {
            $validated = $request->validate([
                'full_name'             => 'required',
                'mobile'                => 'required',
                'gender'                => 'required',
                'email'                 => 'required|email|unique:users,email,' . $user->id,
                'password'              => 'nullable|string|min:6',
                'user_role'             => 'required|exists:user_role,id',
            ]);

            DB::beginTransaction();

            $user->name         = $validated['full_name'];
            $user->mobile       = $validated['mobile'];
            $user->gender       = $validated['gender'];
            $user->email        = $validated['email'];
            $user->user_role    = $validated['user_role'];

            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            DB::commit();

            return redirect()->route('user-list')->with('success', 'User edited successfully!');

        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
        }
    }

    
    // public function createUserRole(Request $request){
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'user_role'             => 'required|unique:user_role,user_role',
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         DB::beginTransaction();

    //         $user = UserRole::create([
    //             'user_role'          => $request->user_role,
    //         ]);

    //         DB::commit();

    //         return redirect()->route('dashboard')->with('success', 'User Role created successfully!');

    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
    //     }
    // }


    //Create Task Function
    public function createTask(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'category'              => 'required',
                'priority'              => 'required',
                'task_title'            => 'required',
                'hours'                 => 'required',
                'minutes'               => 'required',
                'description'           => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            DB::beginTransaction();

            $taskData = array_merge($request->except(['hours', 'minutes']), [
                'allocated_time'=> sprintf('%02d:%02d', $request->hours, $request->minutes),
                'task_status'   => 1,
                'created_by'    => Auth::user()->id,
                'updated_by'    => Auth::user()->id,
            ]);

            if($request->has('assigned_to')){
                $taskData['assigned_to'] = $request->assigned_to;
            }else{
                $taskData['assigned_to'] = Auth::user()->id;
            }

            $task = Task::create($taskData);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Task created successfully!');

        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
        }
    }


    //Edit Task Function
    public function updateTask(Request $request, $id){
        $task = Task::findOrFail($id);

        $hours = str_pad($request->hours, 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($request->minutes, 2, '0', STR_PAD_LEFT);
        $task->allocated_time = "{$hours}:{$minutes}";

        $task->task_title = $request->task_title;
        $task->category = $request->category;
        $task->priority = $request->priority;
        $task->description = $request->description;

        if(Auth::user()->user_role == 1){
            $task->assigned_to = $request->assigned_to;
        }

        $task->save();

        return redirect()->route('my-tasks')->with('success', 'Task updated successfully');
    }


    // public function createClient(Request $request){
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'client_name'             => 'required',
    //             'address'                 => 'required',
    //             'mobile'                  => 'required|numeric'
    //         ]);

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         DB::beginTransaction();

    //         $user = Client::create([
    //             'name'                 => $request->client_name,
    //             'address'              => $request->address,
    //             'mobile'               => $request->mobile,
    //             'created_by'           => Auth::user()->id
    //         ]);

    //         DB::commit();

    //         return redirect()->route('client-list')->with('success', 'Client created successfully!');

    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
    //     }
    // }


    // public function createProject(Request $request){
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'project_name'             => 'required',
    //             'client'                   => 'required',
    //         ]);

    //         if ($request->has('is_active')) {
    //             $validator2 = Validator::make($request->all(), [
    //                 'is_active'     => 'required',
    //             ]);

    //             if($validator2->fails()){
    //                 return redirect()->route('project-create')->with('error', implode(" / ",$validator2->messages()->all()));
    //             }

    //         }

    //         if ($validator->fails()) {
    //             return redirect()->back()->withErrors($validator)->withInput();
    //         }

    //         DB::beginTransaction();

    //         if ($request->has('is_active')) {
    //             $is_active        = 1;
    //         }else{
    //             $is_active        = 0;
    //         }

    //         $user = Project::create([
    //             'name'                 => $request->project_name,
    //             'client'               => $request->client,
    //             'is_active'            => $is_active,
    //             'created_by'           => Auth::user()->id
    //         ]);

    //         DB::commit();

    //         return redirect()->route('project-list')->with('success', 'Project created successfully!');

    //     } catch (\Throwable $e) {
    //         DB::rollback();
    //         return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
    //     }
    // }


    //Edit User Role Permissions Function
    public function editUserRolePermissions(Request $request){
        try {
            DB::beginTransaction();

            UserRolePermissionMap::where('user_role',$request->id)->delete();

            if($request->permission){
                $this->permissionData($request->permission,$request->id);
            }

            DB::commit();

            return redirect()->route('user-role-edit', $request->id)->with('success', 'User Role updated successfully!');

        }
        catch (\Throwable $e){
            DB::rollback();
            return redirect()->back()->with('error', "Something went wrong. Please try again later!".$e->getMessage());
        }
    }


    //Permission Data Function
    private function permissionData($permission,$user_role){

        $permissionData=array();

        foreach($permission as $key=> $permission){
            $permissionData[$key] = array('permission'=>$permission,'user_role'=>$user_role);
        }

        UserRolePermissionMap::insert($permissionData);

        return;
    }


    public function changePassword(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'password'             => 'required',
                'new_password'         => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (!Hash::check($request->password, Auth::user()->password)) {
                return back()->withErrors(['password' => 'The provided password does not match your current password.']);
            }

            DB::beginTransaction();

                Auth::user()->update([
                    'password' => Hash::make($request->new_password),
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Password changed successfully!');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Something went wrong. Please try again later!")->withInput();
        }
    }

}
