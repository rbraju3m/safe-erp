<?php

namespace App\Modules\Deposit\Controllers;

use App\Modules\Deposit\Models\Deposit;
use App\Modules\Deposit\Requests\DepositRequest;
use App\Http\Controllers\Controller;

use App\Modules\User\Models\Member;

use DB;
use Session;
use Image;
use File;
use Storage;
Use Auth;
use Symfony\Component\Console\Input\Input;


class DepositController extends Controller
{
    /**
     * @return bool
     */
    protected function isGetRequest(){
        return Input::server("REQUEST_METHOD") == "GET";
    }


    /**
     * @return bool
     */
    protected function isPostRequest(){
        return Input::server("REQUEST_METHOD") == "POST";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Deposit Information";
        $ModuleTitle = "Deposit Information";


        // Get payment  data
        $data = Deposit::join('member', 'member.id', '=', 'deposite.member_id')
                ->leftjoin('users', 'deposite.created_by', '=', 'users.id')
                ->where('member.status','active')
                ->where('deposite.status','active')
                ->select('member.name','member.mobile','member.image_link','deposite.*','users.name as created_name','users.image_link as created_image_link')
                ->orderby('deposite.id','desc')
                ->get();

        // return view
        return view("Deposit::deposit.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Deposit Information";
        $ModuleTitle = "Deposit Information";

        $member = Member::orderBy('name','asc')
                    ->where('status','active')
                    ->pluck('name','id')
                    ->all();

        return view("Deposit::deposit.create", compact('pageTitle','ModuleTitle','member'));
    }

    public function store(DepositRequest $request)
    {
        $input = $request->all();

        // Add payment timestamps
        $input['payment_date'] = now()->format('d-m-Y');       // current date
        $input['payment_day'] = now()->format('l');            // day of the week
        $input['payment_month'] = now()->format('F');          // month name
        $input['payment_year'] = now()->format('Y');           // year
        $input['payment_time'] = now()->format('h:i:sa');      // current time

        DB::beginTransaction();

        try {
            // Store deposit data
            $payment_data = Deposit::create($input);


            DB::commit();

            Session::flash('message', 'Payment has been added successfully!');

            // Redirect based on status
            return $payment_data->status === 'active'
                ? redirect()->route('admin.deposit.index')
                : redirect()->route('admin.deposit.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            // Log the exception for debugging
            \Log::error('Deposit Store Error: '.$e->getMessage());

            Session::flash('danger', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function edit($id)
    {
        $pageTitle = "Update Deposit Information";
        $ModuleTitle = "Deposit Information";

        // Find deposit by ID, fail if not found
        $data = Deposit::findOrFail($id);

        // Get all active members sorted by name
        $member = Member::where('status', 'active')
            ->orderBy('name', 'asc')
            ->pluck('name', 'id')
            ->toArray();

        return view("Deposit::deposit.edit", compact('pageTitle', 'ModuleTitle', 'data', 'member'));
    }


    public function update(DepositRequest $request, $id)
    {
        // Find deposit or fail
        $deposit = Deposit::findOrFail($id);

        // Prepare input data
        $input = $request->all();
        $input['payment_date'] = date("d-m-Y");
        $input['payment_day'] = date("l");
        $input['payment_month'] = date("F");
        $input['payment_year'] = date("Y");
        $input['payment_time'] = date("h:i:sa");

        DB::beginTransaction();

        try {
            // Update deposit
            $deposit->update($input);

            DB::commit();

            Session::flash('message', 'Deposit successfully updated!');
            $status = $input['status'];
            return $status === 'active'
                ? redirect()->route('admin.deposit.index')
                : redirect()->route('admin.deposit.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $deposit = Deposit::findOrFail($id);

            $deposit->update([
                'status' => 'inactive',
                'updated_by' => Auth::id(),
            ]);

            DB::commit();

            Session::flash('danger', 'Deposit moved to inactive list.');
            return redirect()->route('admin.deposit.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist(){
        $pageTitle = "List of Inactive Deposit";
        $ModuleTitle = "Deposit Information";

        $Cancel = 'Cancel';


        // Get inactive deposit data
        $data = Deposit::join('member', 'member.id', '=', 'deposite.member_id')
            ->leftjoin('users', 'deposite.created_by', '=', 'users.id')
            ->where('member.status','active')
                ->where('deposite.status','inactive')
                ->select('member.name','member.mobile','member.image_link','deposite.*','users.name as created_name','users.image_link as created_image_link')
                ->orderby('member.name','asc')
                ->get();

        // return view
        return view("Deposit::deposit.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id)
    {
        DB::beginTransaction();

        try {
            $deposit = Deposit::findOrFail($id);

            $deposit->update([
                'status' => 'active',
                'updated_by' => Auth::id(),
            ]);

            DB::commit();

            Session::flash('message', 'Rollback successfully!');
            return redirect()->route('admin.deposit.index');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }



    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $deposit = Deposit::findOrFail($id);

            $deposit->delete();

            DB::commit();

            Session::flash('danger', 'Deleted successfully!');
            return redirect()->route('admin.deposit.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    public function intotal($year)
    {
        $pageTitle = "In-total Deposit For ".$year;
        $ModuleTitle = "Deposit Information ".$year;

        $all_member = Member::where('status','active')
            ->with(['deposits' => function($q) use ($year){
                $q->where('status','active')->where('year',$year);
            }])
            ->orderBy('name','asc')
            ->get();

        $Total = Deposit::where('status', 'active')->where('year', $year)->sum('amount');

        return view("Deposit::intotal.index", compact('pageTitle','ModuleTitle','year','all_member','Total'));
    }

}
