<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

use App\Models\User;
use App\Models\EmployeeAttendance;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\Project;

class AjaxController extends Controller
{
    // public function saveAttendance(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'user_id'   => 'required|integer|exists:users,id',
    //         'date'      => 'required|date',
    //         'time'      => 'required|string',
    //         'action'    => 'required|in:check-in,check-out'
    //     ]);

    //     // Find or create an attendance record
    //     $attendance = EmployeeAttendance::firstOrNew([
    //         'user_id'   => $validated['user_id'],
    //         'date'      => $validated['date']
    //     ]);

    //     // Update the attendance record based on action
    //     if ($validated['action'] === 'check-in') {
    //         $attendance->checkin_time = $validated['time'];
    //         $attendance->status = 1;
    //     } else {
    //         $attendance->checkout_time = $validated['time'];
    //         $attendance->status = 0;
    //     }

    //     // Save the record to the database
    //     $attendance->save();

    //     return response()->json(['success' => true, 'message' => 'Attendance record saved successfully.']);
    // }


    // public function getUserStatus(){
    //     $status = EmployeeAttendance::get('status');
    //     return response()->json($status);
    // }


    public function myTasks($id) {
        $taskData = DB::table('tasks')
                    ->join('task_status', 'task_status.id', '=', 'tasks.task_status')
                    ->where('tasks.task_status',$id)
                    ->get();

        return response()->json($taskData);
    }


    // public function updateProject(Request $request){
    //     try {
    //         $project = Project::findOrFail($request->project_id);

    //         $project->name = $request->project_name;
    //         $project->is_active = $request->has('is_active') ? 1 : 0;
    //         $project->save();

    //         return response()->json([
    //             'success' => true,
    //             'project' => $project->load('Client')
    //         ]);

    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }


    public function checkCurrentPassword(Request $request){
        if (Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }


    //Complete Task Function
    public function completeTask(Task $task){
        $task->task_status = TaskStatus::where('task_status', 'Completed')->first()->id;
        $task->save();

        return response()->json(['message' => 'Task marked as completed']);
    }

    //Cancel Task Function
    public function cancelTask(Task $task){
        $task->task_status = TaskStatus::where('task_status', 'Cancelled')->first()->id;
        $task->save();

        return response()->json(['message' => 'Task marked as cancelled']);
    }

    //Delete User Function
    public function deleteUser(Request $request,$id){
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
