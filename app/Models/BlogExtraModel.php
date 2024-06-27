<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogExtraModel extends Model
{
    use HasFactory;
    protected $table = 'blog_extra';
    protected $fillable = [
        'blog_id',
        'heading',
        'bdata',
    ];
}
