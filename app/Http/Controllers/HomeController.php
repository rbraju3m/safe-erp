<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\User\Models\Member;
use App\Modules\Deposite\Models\Deposite;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_member = Member::orderBy('name','asc')
                    ->where('status','active') 
                    ->select('*')
                    ->get();

        $member_count = Member::orderBy('id','desc')
                    ->where('status','active') 
                    ->count();

        $deposite = Deposite::where('status', 'active')
                        ->select('*')
                        ->get();

        $current_total = 0;
        $current_month_deposite = Deposite::where('status', 'active')
                        ->where('month',date("F"))
                        ->where('year',date("Y"))
                        ->select('amount')
                        ->get();
        foreach ($current_month_deposite as $value) {
            $current_total = $current_total+$value['amount'];
        }
        // echo $current_total;
        // exit();

        return view("backend.admin.index", compact('all_member','member_count','deposite','current_total'));
    }
}
