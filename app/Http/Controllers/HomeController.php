<?php

namespace App\Http\Controllers;

use App\Modules\Expense\Models\Investment;
use Illuminate\Http\Request;
use App\Modules\User\Models\Member;
use App\Modules\Deposit\Models\Deposit;
use App\Modules\Expense\Models\Expense;
use App\Modules\Bank\Models\Bank;
use Illuminate\Support\Facades\Cache;


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
    /*public function index()
    {
        $allMember = Member::orderBy('id','desc')
                    ->where('status','active')
                    ->select('*')
                    ->get();

        $totalMember = Member::orderBy('id','desc')
                    ->where('status','active')
                    ->count();

        $totalDeposit = Deposit::where('status', 'active')
                        ->select('amount')
                        ->sum('amount');

        $totalExpense = Expense::orderBy('id','desc')
            ->where('status','active')
            ->select('amount')
            ->sum('amount');

        $totalBankProfit = Bank::orderBy('id','desc')
            ->where('status','active')
            ->where('type','profit')
            ->select('amount')
            ->sum('amount');


        $totalBankExpense = Bank::orderBy('id','desc')
                ->where('status','active')
                ->where('type','expense')
                ->select('amount')
                ->sum('amount');


        $totalInvestment = Investment::orderBy('id','desc')
                ->where('status','active')
                ->select('amount')
                ->sum('amount');

        return view("backend.admin.index", compact(
            'allMember',
            'totalMember',
            'totalDeposit',
            'totalExpense',
            'totalBankProfit',
            'totalInvestment',
            'totalBankExpense'
            )
        );
    }*/

    public function index()
    {
        $totals = Cache::remember('dashboard_totals', 300, function () {
            return [
                'totalMember'     => Member::where('status', 'active')->count(),
                'totalDeposit'    => Deposit::where('status', 'active')->sum('amount'),
                'totalExpense'    => Expense::where('status', 'active')->sum('amount'),
                'totalInvestment' => Investment::where('status', 'active')->sum('amount'),
                'totalBankProfit' => Bank::where(['status' => 'active', 'type' => 'profit'])->sum('amount'),
                'totalBankExpense'=> Bank::where(['status' => 'active', 'type' => 'expense'])->sum('amount'),
            ];
        });

        $allMember = Member::where('status', 'active')->latest()->get();

        return view('backend.admin.index', array_merge($totals, compact('allMember')));
    }
}
