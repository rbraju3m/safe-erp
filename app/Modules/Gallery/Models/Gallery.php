<?php

namespace App\Modules\Gallery\Models;

use Illuminate\Database\Eloquent\Model;

use App;
use Auth;

class Gallery extends Model {

    protected $table = 'gallery';
    protected $fillable = [
        'title',
        'discription',
        'image_link',
        'status',
        'image_day',
        'image_month',
        'image_year',
        'image_time',
        'image_date',
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
