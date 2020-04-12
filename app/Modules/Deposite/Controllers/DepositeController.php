<?php

namespace App\Modules\Deposite\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Deposite\Requests;
use Illuminate\Support\Facades\Input;

use App\Modules\User\Models\Member;
use App\Modules\User\Models\User;
use App\Modules\Deposite\Models\Deposite;


use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;


class DepositeController extends Controller
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
        $pageTitle = "List of Deposite Information";
        $ModuleTitle = "Deposite Information";

        
        // Get payment  data
        $data = Deposite::join('member', 'member.id', '=', 'deposite.member_id')
                ->where('member.status','active')
                ->where('deposite.status','active')
                ->select('member.name','member.mobile','member.image_link','deposite.*')
                ->orderby('deposite.id','desc')
                ->get();

        // return view
        return view("Deposite::deposite.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Deposite Information";
        $ModuleTitle = "Deposite Information";

        $data = Member::orderBy('name','asc')
                    ->where('status','active') 
                    ->pluck('name','id')
                    ->all();
        
        return view("Deposite::deposite.create", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\DepositeRequest $request)
    {
        $input = $request->all();
        echo "<pre>";

        $current_date = date("d-m-Y");
        $current_day = date("l");
        $current_month = date("F");
        $current_year = date("Y");
        $current_time = date(" h:i:sa");

        $input['payment_date'] = $current_date;
        $input['payment_day'] = $current_day;
        $input['payment_month'] = $current_month;
        $input['payment_year'] = $current_year;
        $input['payment_time'] = $current_time;

        // echo "<pre>";
        // print_r($input);

        /* Transaction Start Here */
        DB::beginTransaction();
            try {
                // Store payment data 
                if($payment_data = Deposite::create($input))
                {  
                    $payment_data->save();

                }

                DB::commit();
                Session::flash('message', 'Payment is added Successfilly!');
                // $status = $input['status'];
                // if ($status =='active') {
                //     return redirect('admin-member-index');
                // }else{
                //     return redirect('admin-member-inactive');
                // }
                return redirect()->back();
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
