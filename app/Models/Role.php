<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function permissions (){
        return $this->belongsToMany(Permissions::class , 'permissions_role', 'role_id' , 'permission_id');
    }
}