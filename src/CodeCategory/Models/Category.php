<?php
namespace CodePress\CodeCategory\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "codepress_category";

    protected $fillable = [
        'name',
        'active',
        'parent_id'
    ];
}