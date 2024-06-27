<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = [
        'title',
        'url_link',
        'short_about',
        'file',
        'date',
        'blog_seo_title',
        'blog_seo_description',
        'status',
        'client_id',
        'client_api_key',
    ];
}
