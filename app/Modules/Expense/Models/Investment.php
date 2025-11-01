<?php

namespace App\Modules\Expense\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model {

    protected $table = 'investment';
    protected $fillable = [
        'name',
        'amount',
        'ex_date',
        'note',
        'investment_day',
        'investment_month',
        'investment_year',
        'investment_time',
        'investment_date',
        'status',
        'updated_by',
        'created_by',
        'image_link',
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
