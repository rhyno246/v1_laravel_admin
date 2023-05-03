<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory,HasUuid;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public function getParent () {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function images () {
        return $this->hasMany(ProductsImage::class,'product_id'); // laravel eloquent-relationships
    }
    public function tags () {
        return $this->belongsToMany(ProductTags::class, 'product_tag' , 'product_id', 'tag_id')->withTimestamps();
    }
    public function categoriesInstance (){
        return $this->belongsTo(Category::class, 'categories_id'); 
    } 
}
