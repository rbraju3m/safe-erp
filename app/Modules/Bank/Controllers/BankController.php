<?php

namespace App\Modules\Bank\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Bank\Requests;
use Illuminate\Support\Facades\Input;


use App\Modules\Bank\Models\Bank;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;




class BankController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Bank profit / Expense";
        $ModuleTitle = "Bank profit / Expense Information";

        
        // Get bank  data
        $data = Bank::orderBy('id','desc')
                ->where('status','active')
                ->select('*')
                ->get();

        // return view
        return view("Bank::bank.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Bank profit / Expense Information";
        $ModuleTitle = "Bank profit / Expense Information";
        
        return view("Bank::bank.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BankRequest $request)
    {
        $input = $request->all();

        $input['expense_date'] = date("d-m-Y");
        $input['expense_day'] = date("l");
        $input['expense_month'] = date("F");
        $input['expense_year'] = date("Y");
        $input['expense_time'] = date(" h:i:sa");

         if ($request->file('image_link') != '') {
            $expense_img = $request->file('image_link');
            $avatar = $request->file('image_link');
            $expense_img_title = $input['name'].'-'.time().'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/bank/' . $expense_img_title) );
            $input['image_link'] = $expense_img_title;
        }

        // echo $input['image_link'];
        // exit();

        /* Transaction Start Here */
        DB::beginTransaction();
            try {
                // Store payment data 
                if($Bank_data = Bank::create($input))
                {  
                    $Bank_data->save();

                }

                DB::commit();
                Session::flash('message', 'Bank profit / ex is added Successfully!');
                $status = $input['status'];
                if ($status =='active') {
                    return redirect('admin-bank-index');
                }else{
                    return redirect('admin-bank-inactive');
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
        $pageTitle = "Update Bank profit / Expense";
        $ModuleTitle = "Bank profit / Expense Information";

        // Find Expense
        $data = Bank::where('id', $id)
                        ->select('*')
                        ->first();
        
        return view("Bank::bank.edit", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\BankRequest $request, $id)
    {
        // Find expense
        $bank_model = Bank::where('id', $id)
            ->select('*')
            ->first();

        $input = $request->all();

        if (isset($input['image_link']) && !empty($input['image_link'])) {
            $expense_img = $request->file('image_link');
            $image_info = getimagesize($expense_img);
            $size = $request->file('image_link')->getSize()/1024;

            if($size < 5120){
                // echo "5mb er soman ba soto";
                $avatar = $request->file('image_link');
                $expense_img_title = $input['name'].'-'.time().'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/bank/' . $expense_img_title) );
                $input['image_link'] = $expense_img_title;
                // File::Delete($member_model->image_link);
                File::delete(public_path().'/uploads/bank/'.$bank_model->image_link);
            }else{
                Session::flash('error', 'This Image size bigger than 5MB');    
                return redirect()->back();
            }
        }else{
            $input['image_link'] = $bank_model['image_link'];
            // echo $input['image_link'];
        }

        DB::beginTransaction();
        try {

            $result = $bank_model->update($input);
            $bank_model->save();

            DB::commit();

            Session::flash('message', 'Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-bank-index');
            }else{
                return redirect('admin-bank-inactive');
            }
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
        
        // return redirect()->back()->withInput();
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

                $data = DB::table('bankprofitexpense')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('danger', 'Bank profit / Expense Added Inactive List !');
                return redirect('admin-bank-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }  
    }

    public function inactivelist(){
        $pageTitle = "List of Inactive Bank profit / Expense";
        $ModuleTitle = "Bank profit / Expense Information";

        $Cancel = 'Cancel';

        
        // Get inactive Expense data
        $data = Bank::where('status','inactive')
                ->select('*')
                ->orderby('updated_at','desc')
                ->get();

        // return view
        return view("Bank::bank.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('bankprofitexpense')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-bank-index');

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
                $bank_model = Bank::where('id', $id)
                                ->select('*')
                                ->first();

                $bank_data = DB::table('bankprofitexpense')->where('id',$id);
                File::delete(public_path().'/uploads/bank/'.$bank_model->image_link);

                $bank_data->delete();

                DB::commit();
                Session::flash('danger', 'Delete Successfully !');
                return redirect('admin-bank-inactive');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }
}
