<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRolePermissionMap extends Model
{
    use HasFactory;

    protected $table = 'user_role_permission_map';

    protected $fillable = [
        'permission',
        'user_role',
    ];

    public $timestamps = false;

    public function permission(){
        return $this->hasMany(Permissiom::class, 'id', 'permission');
    }
}
