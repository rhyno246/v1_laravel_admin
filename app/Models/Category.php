<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function getParent () {
        return $this->belongsTo(Category::class, 'parent_id'); 
    }
    public function getChild () {
        return $this->hasMany(Category::class , 'parent_id'); // mối quan hệ 1 nhiều ->frontend
    }

    public function getCategoryChild () {
        return $this->hasMany(Products::class , 'categories_id'); // mối quan hệ 1 nhiều ->frontend
    }
}
