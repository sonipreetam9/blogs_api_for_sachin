<?php



namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $fillable = ['username', 'password'];



}
