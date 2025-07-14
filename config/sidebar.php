<?php

return [
    [
        'title' => 'Dashboard',
        'icon' => 'fas fa-th',
        'type' => 'single',
        'childs' => [
            [
                'title' => 'Dashboard',
                'permission' => 'dashboard',
                'link' => '/',
            ],
        ],
    ],
    [
        'title' => 'Users',
        'icon' => 'fas fa-user-alt',
        'type' => 'multiple',
        'childs' => [
            [
                'title' => 'Create User',
                'permission' => 'user-create',
                'link' => '/user-create',
            ],
            [
                'title' => 'User List',
                'permission' => 'user-list',
                'link' => '/user-list',
            ],
        ],
    ],
    [
        'title' => 'Tasks',
        'icon' => 'fas fa-pen',
        'type' => 'multiple',
        'childs' => [
            [
                'title' => 'Create Task',
                'permission' => 'task-create',
                'link' => '/task-create',
            ],
            [
                'title' => 'My Tasks',
                'permission' => 'my-tasks',
                'link' => '/my-tasks',
            ],
        ],
    ],
];

?>
