<?php

namespace App\Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

use App;
use Auth;

class Member extends Model {

    protected $table = 'member';
    protected $fillable = [
        'name',
        'mobile',
        'member_id',
        'national_id',
        'f_h_name',
        'nominee',
        'nominee_mobile',
        'nominee_n_id',
        'present_address',
        'parmanent_address',
        'type',
        'religion',
        'gender',
        'image_link',
        'status',
        'join_day',
        'join_month',
        'join_year',
        'join_time',
        'join_date',
        'updated_by',
        'created_by',
    ];



    // TODO :: boot
    // boot() function used to insert logged user_id at 'created_by' & 'updated_by'
    public static function boot(){
        parent::boot();
        static::creating(function($query){
            if(Auth::check()){
                $query->created_by = Auth::user()->id;
            }
        });
        static::updating(function($query){
            if(Auth::check()){
                $query->updated_by = Auth::user()->id;
            }
        });
    }

    public function deposits()
    {
        return $this->hasMany(\App\Modules\Deposit\Models\Deposit::class, 'member_id', 'id')
            ->where('status', 'active'); // optional, only active deposits
    }

}
