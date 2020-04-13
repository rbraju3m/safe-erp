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

        $member = Member::orderBy('name','asc')
                    ->where('status','active') 
                    ->pluck('name','id')
                    ->all();
        
        return view("Deposite::deposite.create", compact('pageTitle','ModuleTitle','member'));
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

        $input['payment_date'] = date("d-m-Y");
        $input['payment_day'] = date("l");
        $input['payment_month'] = date("F");
        $input['payment_year'] = date("Y");
        $input['payment_time'] = date(" h:i:sa");

        /* Transaction Start Here */
        DB::beginTransaction();
            try {
                // Store payment data 
                if($payment_data = Deposite::create($input))
                {  
                    $payment_data->save();

                }

                DB::commit();
                Session::flash('message', 'Payment is added Successfully!');
                $status = $input['status'];
                if ($status =='active') {
                    return redirect('admin-deposite-index');
                }else{
                    return redirect('admin-deposite-inactive');
                }
                // return redirect()->back();
                
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
        $pageTitle = "Update Deposite Information";
        $ModuleTitle = "Deposite Information";

        // Find news
        $data = Deposite::where('id', $id)
                        ->select('*')
                        ->first();

        $member = Member::orderBy('name','asc')
                    ->where('status','active') 
                    ->pluck('name','id')
                    ->all();
        
        return view("Deposite::deposite.edit", compact('pageTitle','ModuleTitle','data','member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\DepositeRequest $request, $id)
    {
        // Find member
        $deposite_model = Deposite::where('id', $id)
            ->select('*')
            ->first();

        $input = $request->all();

        $input['payment_date'] = date("d-m-Y");
        $input['payment_day'] = date("l");
        $input['payment_month'] = date("F");
        $input['payment_year'] = date("Y");
        $input['payment_time'] = date(" h:i:sa");

        DB::beginTransaction();
        try {

            $result = $deposite_model->update($input);
            $deposite_model->save();

            DB::commit();

            Session::flash('message', 'Deposite Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-deposite-index');
            }else{
                return redirect('admin-deposite-inactive');
            }

        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('deposite')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('danger', 'Member Added Inactive List !');
                return redirect('admin-deposite-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }

    public function inactivelist(){
        $pageTitle = "List of Inactive Deposite";
        $ModuleTitle = "Deposite Information";

        $Cancel = 'Cancel';

        
        // Get inactive deposite data
        $data = Deposite::join('member', 'member.id', '=', 'deposite.member_id')
                ->where('member.status','active')
                ->where('deposite.status','inactive')
                ->select('member.name','member.mobile','member.image_link','deposite.*')
                ->orderby('member.name','asc')
                ->get();

        // return view
        return view("Deposite::deposite.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('deposite')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-deposite-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }


    public function delete($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {
                
                $deposite_data = DB::table('deposite')->where('id',$id);

                $deposite_data->delete();

                DB::commit();
                Session::flash('danger', 'Delete Successfully !');
                return redirect('admin-deposite-inactive');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }
}
