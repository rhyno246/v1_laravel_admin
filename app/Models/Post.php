<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,HasUuid;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public function categoriesInstance () {
        return $this->belongsTo(PostCategory::class, 'categories_id');
    }
    public function tags () {
        return $this->belongsToMany(PostTags::class , 'post_tag', 'post_id' , 'tag_id')->withTimestamps();
    }
}
