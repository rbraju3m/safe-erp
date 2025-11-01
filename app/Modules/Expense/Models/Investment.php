<?php

namespace App\Modules\Expense\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model {

    protected $table = 'investments';
    protected $fillable = [
        'project_id',
        'name',
        'amount',
        'note',
        'investment_date',
        'status',
        'updated_by',
        'created_by',
        'image',
    ];

    protected $casts = [
        'investment_date' => 'datetime',
    ];


    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }



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
