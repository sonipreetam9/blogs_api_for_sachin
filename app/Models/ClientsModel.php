<?php

namespace App\Models;

use App\Models\WebsitePageModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class ClientsModel extends Authenticatable
{
    use Notifiable;
    protected $table = 'clients';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website_link',
        'api_link',
        'user_id',
        'password',
        'status',
        'api_key',
    ];
    public function website_page()
    {
        $this->hasOne(WebsitePageModel::class);
    }
}
