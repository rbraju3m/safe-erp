<?php

namespace App\Modules\Bank\Models;

use Illuminate\Database\Eloquent\Model;
use App;
use Auth;
class ProfitDistributeMember extends Model {

    protected $table = 'profit_distribute_member';
    protected $fillable = [
        'profit_id', 'member_id', 'deposit_amount', 'profit_amount'
    ];



    /*// TODO :: boot
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
    }*/

}
