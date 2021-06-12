<?php

namespace App\Modules\Expense\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Auth;
class Expense extends Model {

    protected $table = 'expense';
    protected $fillable = [
        'name',
        'amount',
        'ex_date',
        'note',
        'expense_day',
        'expense_month',
        'expense_year',
        'expense_time',
        'expense_date',
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
