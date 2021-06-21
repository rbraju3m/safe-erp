<?php

namespace App\Modules\Expense\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Expense\Requests;
use Illuminate\Support\Facades\Input;


use App\Modules\Expense\Models\Expense;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;




class ExpenseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Expense Information";
        $ModuleTitle = "Expense Information";

        
        // Get payment  data
        $data = Expense::orderBy('id','desc')
                ->where('status','active')
                ->select('*')
                ->get();

        // return view
        return view("Expense::expense.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Expense Information";
        $ModuleTitle = "Expense Information";
        
        return view("Expense::expense.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ExpenseRequest $request)
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
            Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/expense/' . $expense_img_title) );
            $input['image_link'] = $expense_img_title;
        }

        // echo $input['image_link'];
        // exit();

        /* Transaction Start Here */
        DB::beginTransaction();
            try {
                // Store payment data 
                if($expense_data = Expense::create($input))
                {  
                    $expense_data->save();

                }

                DB::commit();
                Session::flash('message', 'Expense is added Successfully!');
                $status = $input['status'];
                if ($status =='active') {
                    return redirect('admin-expense-index');
                }else{
                    return redirect('admin-expense-inactive');
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
        $pageTitle = "Update Expense Information";
        $ModuleTitle = "Expense Information";

        // Find Expense
        $data = Expense::where('id', $id)
                        ->select('*')
                        ->first();
        
        return view("Expense::expense.edit", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ExpenseRequest $request, $id)
    {
        // Find expense
        $expense_model = Expense::where('id', $id)
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
                Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/expense/' . $expense_img_title) );
                $input['image_link'] = $expense_img_title;
                // File::Delete($member_model->image_link);
                File::delete(public_path().'/uploads/expense/'.$expense_model->image_link);
            }else{
                Session::flash('error', 'This Image size bigger than 5MB');    
                return redirect()->back();
            }
        }else{
            $input['image_link'] = $expense_model['image_link'];
            // echo $input['image_link'];
        }


        $input['join_date'] = $member_model['join_date'];
        $input['join_day'] = $member_model['join_day'];
        $input['join_month'] = $member_model['join_month'];
        $input['join_year'] = $member_model['join_year'];
        $input['join_time'] = $member_model['join_time'];


        DB::beginTransaction();
        try {

            $result = $expense_model->update($input);
            $expense_model->save();

            DB::commit();

            Session::flash('message', 'Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-expense-index');
            }else{
                return redirect('admin-expense-inactive');
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

                $data = DB::table('expense')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('danger', 'Expense Added Inactive List !');
                return redirect('admin-expense-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }  
    }

    public function inactivelist(){
        $pageTitle = "List of Inactive Expense";
        $ModuleTitle = "Expense Information";

        $Cancel = 'Cancel';

        
        // Get inactive Expense data
        $data = Expense::where('status','inactive')
                ->select('*')
                ->orderby('updated_at','desc')
                ->get();

        // return view
        return view("Expense::expense.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('expense')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-expense-index');

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
                $expense_model = Expense::where('id', $id)
                                ->select('*')
                                ->first();
                $expense_data = DB::table('expense')->where('id',$id);
                File::delete(public_path().'/uploads/expense/'.$expense_model->image_link);

                $expense_data->delete();

                DB::commit();
                Session::flash('danger', 'Delete Successfully !');
                return redirect('admin-expense-inactive');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }
}
