<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

use App;
use Auth;

class User extends Model {
	protected $table = 'users';
    protected $fillable = [
        'name',
        'user_id',
        'image_link',
        'email',
        'password',
        'updated_by',
        'created_by',
    ];

}
