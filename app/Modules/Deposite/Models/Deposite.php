<?php

namespace App\Modules\Deposite\Models;

use Illuminate\Database\Eloquent\Model;

use App;
use Auth;

class Deposite extends Model {

    protected $table = 'deposite';
    protected $fillable = [
        'member_id',
        'month',
        'year',
        'type',
        'note',
        'amount',
        'payment_day',
        'payment_month',
        'payment_year',
        'payment_time',
        'payment_date',
        'status',
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

}
