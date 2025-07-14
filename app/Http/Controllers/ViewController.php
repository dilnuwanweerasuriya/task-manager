<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ViewController extends DataController
{
    //Login Page Function
    public function login(){
        return View::make('login');
    }

    //Register Page Function
    public function register(){
        return View::make('register');
    }

    //Default Page Function
    public function default($data){

        $css =array(
            config('site-specific.fontawesome-free-css'),
            config('site-specific.adminlte-min-css'),
            config('site-specific.fonts-googleapis-css'),
            config('site-specific.sweetalert-form-wizard-css'),
        );
        $script =array(
            config('site-specific.bootstrap-bundle-min-js'),
            config('site-specific.adminlte-js'),
            config('site-specific.form-wizard-sweetalert-js'),
        );

        if(isset($data['css'])){
            $data['css'] = array_merge($css,$data['css']);
        }else{
            $data['css'] = $css;
        }
        if(isset($data['script'])){
            $data['script'] = array_merge($script,$data['script']);
        }else{
            $data['script'] = $script;
        }

        // $data['userImage'] = $this->getUserimage()->name;

        return View::make('home', $data);
    }

    //Dashboard Page Function
    public function dashboard(){
        $data = [
            'title'         => 'Dashboard',
            'view'          => 'dashboard',
            'css'           =>  array(config('site-specific.ionicons-min-css'),config('site-specific.tempusdominus-bootstrap-4-min-css'),
                                config('site-specific.icheck-bootstrap-min-css'),config('site-specific.jqvmap-min-css'),
                                config('site-specific.OverlayScrollbars-min-css'),config('site-specific.daterangepicker-css'),
                                config('site-specific.summernote-bs4-css')),
            'script'        =>  array(config('site-specific.jquery-ui-min-js'),config('site-specific.Chart-min-js'),
                                config('site-specific.sparkline-js'),config('site-specific.jquery-vmap-min-js'),
                                config('site-specific.jquery-vmap-usa-js'),config('site-specific.jquery-knob-min-js'),
                                config('site-specific.moment-min-js'),config('site-specific.daterangepicker-js'),
                                config('site-specific.tempusdominus-bootstrap-4-min-js'),config('site-specific.summernote-bs4-min-js'),
                                config('site-specific.jquery-overlayScrollbars-min-js')),
            'userCount'     => $this->getDashboardCounts()['users'],
            // 'clientCount'   => $this->getDashboardCounts()['clients'],
            // 'projectCount'  => $this->getDashboardCounts()['projects'],
            'taskCount'     => $this->getDashboardCounts()['tasks'],
            // 'attendance'    => $this->getAttendance(),
            // 'myTeam'        => $this->myTeamData(),
        ];

        return $this->default($data);
    }

    
    // public function userRole(){
    //     $data = [
    //         'title'     => 'User Role',
    //         'view'      => 'user_role',
    //         'css'       => array(config('site-specific.datatable-min-css')),
    //         'script'    => array(config('site-specific.datatable-min-js')),
    //         'userRoles' => $this->getUserRoles(),
    //     ];

    //     return $this->default($data);
    // }


    // public function userRoleEdit(Request $request){
    //     $id          = $request->route('id');
    //     $user_role   = $this->getEditUserRole($id);

    //     $data = [
    //         'title'                     => 'User Role Edit',
    //         'view'                      => 'user_role_edit',
    //         'user_role_permission'      => $this->getPermission(),
    //         'id'                        => $id,
    //         'user_role'                 => $user_role,
    //         'selected_permission'       => $this->getUserRolePermission($id)
    //     ];

    //     return $this->default($data);
    // }

    //User Create Page Function
    public function userCreate(){
        $data = [
            'title'     => 'User Create',
            'view'      => 'user_create',
            'css'       => array(config('site-specific.bootstrap-min-css')),
            'script'    => array(config('site-specific.bootstrap-min-js'), config('site-specific.jquery-validate-min-js')),
            'user_role' => $this->getUserRoles(),
        ];

        return $this->default($data);
    }

    //User Edit Page Function
    public function userEdit(Request $request){
        $id = $request->route('id');

        $data = [
            'title'     => 'Edit User',
            'view'      => 'user_edit',
            'css'       => array(config('site-specific.bootstrap-min-css')),
            'script'    => array(config('site-specific.bootstrap-min-js'), config('site-specific.jquery-validate-min-js')),
            'user'      => $this->getUserData($id),
            'user_role' => $this->getUserRoles(),
        ];

        return $this->default($data);
    }

    //User List Page Function
    public function userList(){
        $data = [
            'title'     => 'User List',
            'view'      => 'user_list',
            'css'           => array(config('site-specific.datatable-bootstrap4-min-css'), config('site-specific.responsive-bootstrap4-min-css'), config('site-specific.buttons-bootstrap4-min-css'), config('site-specific.all-min-css')),
            'script'        => array(config('site-specific.jquery-datatables-min-js'), config('site-specific.datatables-bootstrap-min-js'), config('site-specific.responsive-bootstrap-min-js'), config('site-specific.responsive-bootstrap4-min-js'), config('site-specific.datatables-buttons-min-js'), config('site-specific.buttons-bootstrap4-min-js'), config('site-specific.buttons-html5-min-js'), config('site-specific.buttons-print-min-js'), config('site-specific.buttons-colvis-min-js')),
            'users'     => $this->getAllUsers(),
        ];

        return $this->default($data);
    }

    //User Profile Page Function
    public function userProfile(){
        $data = [
            'title'     => 'User Profile',
            'view'      => 'user_profile',
        ];

        return $this->default($data);
    }

    //Create Task Page Function
    public function taskCreate(){
        $data = [
            'title'     => 'Create Task',
            'view'      => 'task_create',
            'script'    => array(config('site-specific.jquery-validate-min-js')),
            'user_list' => $this->getUsers(),
        ];

        return $this->default($data);
    }

    //Edit Task Page Function
    public function taskEdit($id){
        $data = [
            'title'     => 'Edit Task',
            'view'      => 'task_edit',
            'script'    => array(config('site-specific.jquery-validate-min-js')),
            'task_data' => $this->getTaskData($id),
            'user_list' => $this->getUsers(),
        ];

        return $this->default($data);
    }

    //My Tasks Page Function
    public function myTasks(){
        $data = [
            'title'         => 'My Tasks',
            'view'          => 'my_tasks',
            'css'           => array(config('site-specific.datatable-bootstrap4-min-css'), config('site-specific.responsive-bootstrap4-min-css'), config('site-specific.buttons-bootstrap4-min-css'), config('site-specific.all-min-css')),
            'script'        => array(config('site-specific.jquery-datatables-min-js'), config('site-specific.datatables-bootstrap-min-js'), config('site-specific.responsive-bootstrap-min-js'), config('site-specific.responsive-bootstrap4-min-js'), config('site-specific.datatables-buttons-min-js'), config('site-specific.buttons-bootstrap4-min-js'), config('site-specific.buttons-html5-min-js'), config('site-specific.buttons-print-min-js'), config('site-specific.buttons-colvis-min-js')),
            'task_status'   => $this->getTaskStatus(),
        ];

        return $this->default($data);
    }


    // public function clientCreate(){
    //     $data = [
    //         'title'         => 'Create Client',
    //         'view'          => 'client_create',
    //     ];

    //     return $this->default($data);
    // }


    // public function clientList(){
    //     $data = [
    //         'title'         => 'Client List',
    //         'view'          => 'client_list',
    //         'clients'       => $this->getClients(),
    //     ];

    //     return $this->default($data);
    // }


    // public function projectCreate(){
    //     $data = [
    //         'title'         => 'Create Project',
    //         'view'          => 'project_create',
    //         'clients'       => $this->getClients(),
    //     ];

    //     return $this->default($data);
    // }


    // public function projectList(){
    //     $data = [
    //         'title'         => 'Project List',
    //         'view'          => 'project_list',
    //         'css'           => array(config('site-specific.datatable-min-css')),
    //         'script'        => array(config('site-specific.datatable-min-js'), config('site-specific.bootstrap-min-js')),
    //         'projects'      => $this->getProjects(),
    //     ];

    //     return $this->default($data);
    // }

}
