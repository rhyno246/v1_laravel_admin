<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function permissionChild() {
        return $this->hasMany(Permissions::class , 'parent_id');
    }
}
