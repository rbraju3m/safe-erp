<?php

namespace App\Modules\Bank\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Auth;
class ProfitDistribute extends Model {

    protected $table = 'profit_distribute';
    protected $fillable = [
        'profit_year', 'net_amount', 'bank_profit', 'bank_expense', 'other_expense', 'net_profit', 'total_profit_member', 'created_by'
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
