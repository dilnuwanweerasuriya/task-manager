<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'task_title',
        'allocated_time',
        'category',
        'description',
        'task_status',
        'priority',
        'assigned_to',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

    public function taskStatus(){
        return $this->hasOne(TaskStatus::class, 'id', 'task_status');
    }


    public function assignedTo(){
        return $this->hasOne(User::class, 'id', 'assigned_to');
    }


    public function createdBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy(){
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
