<?php

namespace App\Modules\Bank\Controllers;

use App\Modules\Bank\Models\ProfitDistribute;
use App\Modules\Bank\Models\ProfitDistributeMember;
use App\Modules\Deposit\Models\Deposit;
use App\Modules\Expense\Models\Expense;
use App\Modules\User\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Bank\Requests;


use App\Modules\Bank\Models\Bank;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;




class ProfitSharingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profitSharingIndex()
    {
        $pageTitle = "List of profit sharing";
        $ModuleTitle = "Bank Profit Sharing Information";

        $data = ProfitDistribute::orderBy('id','desc')
                ->select('*')
                ->get();
        return view("Bank::profit-sharing.index", compact('pageTitle','ModuleTitle','data'));
    }

    public function create()
    {
        $pageTitle = "Generate profit Sharing Information";
        $ModuleTitle = "Profit Sharing Information";

        $activeMember = Member::orderBy('id','desc')
            ->where('status','active')
            ->pluck('name','id')
            ->all();

        return view("Bank::profit-sharing.create", compact('pageTitle','ModuleTitle','activeMember'));
    }

    public function profitGenerate(Request $request){
        $pageTitle = "Generate profit Sharing Information";
        $ModuleTitle = "Profit Sharing Information";
        $input = $request->all();

        $yearWiseProfitExists = ProfitDistribute::where('profit_year',$input['year'])->exists();
        if($yearWiseProfitExists){
            return redirect()->back()->with('error','Profit Sharing Information already generated');
        }

        $profitMember = $activeMember = Member::orderBy('id','desc')
            ->where('status','active')
            ->pluck('name','id')
            ->all();
        foreach ($input['member_id'] as $skipID) {
            unset($profitMember[$skipID]);
        }
        $totalBankProfit = Bank::orderBy('id','desc')
            ->where('status','active')
            ->where('type','profit')
            ->where('ex_date', 'like', '%' . $input['year'] . '%')
            ->select('*')
            ->sum('amount');
//        dd($totalBankProfit);
        $totalBankExpense = Bank::orderBy('id','desc')
            ->where('status','active')
            ->where('type','Expense')
            ->where('ex_date', 'like', '%' . $input['year'] . '%')
            ->select('*')
            ->sum('amount');

        $otherExpense = Expense::orderBy('id','desc')
            ->where('status','active')
            ->where('ex_date', 'like', '%' . $input['year'] . '%')
            ->select('*')
            ->sum('amount');
        $Deposit = Deposit::where('status', 'active')->whereBetween('year', [2019, $input['year']])->sum('amount');
        $registrationFee = count($profitMember)*100;
        $netAmount = $Deposit-$registrationFee;

        return view("Bank::profit-sharing.create", compact('pageTitle','ModuleTitle','activeMember','input','profitMember','totalBankProfit','totalBankExpense','otherExpense','netAmount'));

    }



    public function getYearWiseProfitExpense(){
        $year = $_GET['year'];
        $response = [];
        $response['totalBankProfit'] = Bank::orderBy('id','desc')
                                        ->where('status','active')
                                        ->where('type','profit')
                                        ->where('expense_year',$year)
                                        ->select('*')
                                        ->sum('amount');
        $response['totalBankExpense'] = Bank::orderBy('id','desc')
                                ->where('status','active')
                                ->where('type','Expense')
                                ->where('expense_year',$year)
                                ->select('*')
                                ->sum('amount');

        $response['otherExpense'] = Expense::orderBy('id','desc')
                                    ->where('status','active')
                                    ->where('expense_year',$year)
                                    ->select('*')
                                    ->sum('amount');
        return $response;
    }

    public function profitGenerateStore(Request $request)
    {
        $input = $request->all();

        DB::beginTransaction();
            try {
                if($profitDistribute = ProfitDistribute::create($input)) {
                    $profitDistribute->save();
                    foreach ($input['member_id'] as $index => $value) {
                        $distributeMember['profit_id'] = $profitDistribute->id;
                        $distributeMember['member_id'] = $value;
                        $distributeMember['deposit_amount'] = $input['deposit_amount'][$index];
                        $distributeMember['profit_amount'] = $input['profit_amount'][$index];
                        ProfitDistributeMember::create($distributeMember);
                    }
                }

                DB::commit();
                return redirect()->route('admin_profit_sharing');

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

    public function profitSharingDetails(){
        $profitID = $_GET['profit_id'];
        $memberProfitDetails = ProfitDistributeMember::where('profit_id',$profitID)->get();
        $view = \Illuminate\Support\Facades\View::make('Bank::profit-sharing._profit_details',compact('memberProfitDetails'));

        $contents = $view->render();
        $response['result'] = 'success';
        $response['content'] = $contents;

        $response['header'] = 'Profit sharing details ';
//        $response['headerSmall'] = 'I AM ';


        return $response;    }
}
