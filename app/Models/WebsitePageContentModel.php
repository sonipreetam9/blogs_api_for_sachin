<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePageContentModel extends Model
{
    use HasFactory;

    protected $table = 'website_page_content';

    protected $fillable = [
        'website_page_id',
        'meta_title',
        'meta_discription',
        'meta_keywords',
    ];
}

