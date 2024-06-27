<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClientsModel;
class WebsitePageModel extends Model
{
    use HasFactory;
    protected $table = 'client_website_pages';
    protected $fillable=[
        'client_id',
        'website_page_name',
        'status'
    ];
    public function client(){
        return $this->belongsTo(ClientsModel::class,'client_id','id');
    }
}
