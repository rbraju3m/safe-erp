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
