<?php

namespace App\Modules\Bank\Controllers;

use App\Modules\Bank\Requests\BankRequest;
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


    public function create()
    {
        $pageTitle = "Add Bank profit / Expense Information";
        $ModuleTitle = "Bank profit / Expense Information";

        return view("Bank::bank.create", compact('pageTitle','ModuleTitle'));
    }

    public function store(BankRequest $request)
    {
        $input = $request->all();

        // Add date/time fields
        $now = now();
        $input['expense_date'] = $now->format('d-m-Y');
        $input['expense_day'] = $now->format('l');
        $input['expense_month'] = $now->format('F');
        $input['expense_year'] = $now->format('Y');
        $input['expense_time'] = $now->format('h:i:sa');

        // Handle image upload
        if ($request->hasFile('image_link')) {
            $avatar = $request->file('image_link');
            $image_name = $input['name'] . '-' . time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(600, 400)->save(public_path('uploads/bank/' . $image_name));
            $input['image_link'] = $image_name;
        }

        DB::beginTransaction();
        try {
            Bank::create($input); // already saves
            DB::commit();

            Session::flash('message', 'Bank profit/expense added successfully!');

            return $input['status'] === 'active'
                ? redirect()->route('admin.bank.index')
                : redirect()->route('admin.bank.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $pageTitle = "Update Bank Profit / Expense";
        $ModuleTitle = "Bank Profit / Expense Information";

        $data = Bank::findOrFail($id);

        return view("Bank::bank.edit", compact('pageTitle', 'ModuleTitle', 'data'));
    }


    public function update(BankRequest $request, $id)
    {
        // Find bank record or fail
        $bank_model = Bank::findOrFail($id);

        $input = $request->all();

        // Handle image upload
        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link');
            $sizeKb = $file->getSize() / 1024;

            if ($sizeKb > 5120) { // limit 5MB
                return redirect()->back()->with('error', 'This image size is bigger than 5MB');
            }

            $imageName = $input['name'] . '-' . time() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->resize(600, 400)->save(public_path('uploads/bank/' . $imageName));

            // Delete old image if exists
            if ($bank_model->image_link) {
                File::delete(public_path('uploads/bank/' . $bank_model->image_link));
            }

            $input['image_link'] = $imageName;
        } else {
            $input['image_link'] = $bank_model->image_link; // keep old image
        }

        DB::beginTransaction();
        try {
            $bank_model->update($input);
            DB::commit();

            Session::flash('message', 'Bank profit/expense updated successfully!');
            return redirect()->route($input['status'] === 'active' ? 'admin.bank.index' : 'admin.bank.inactive');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        // Find the bank record
        $bank = Bank::findOrFail($id);

        DB::beginTransaction();
        try {
            $bank->update([
                'status' => 'inactive',
                'updated_by' => Auth::id(),
            ]);

            DB::commit();
            Session::flash('danger', 'Bank profit / Expense moved to Inactive List!');
            return redirect()->route('admin.bank.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist()
    {
        $pageTitle = "List of Inactive Bank profit / Expense";
        $ModuleTitle = "Bank profit / Expense Information";
        $Cancel = 'Cancel';

        // Get inactive bank records ordered by updated_at descending
        $data = Bank::where('status', 'inactive')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view("Bank::bank.index", compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }


    public function rollback($id)
    {
        DB::beginTransaction();
        try {
            // Find the bank record
            $bank = Bank::findOrFail($id);

            // Update status to active
            $bank->status = 'active';
            $bank->updated_by = Auth::user()->id;
            $bank->save();

            DB::commit();

            Session::flash('message', 'Roll Back Successfully!');
            return redirect()->route('admin.bank.index');

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
            // Find the bank record or fail
            $bank = Bank::findOrFail($id);

            // Delete the image if exists
            if (!empty($bank->image_link) && File::exists(public_path('uploads/bank/' . $bank->image_link))) {
                File::delete(public_path('uploads/bank/' . $bank->image_link));
            }

            // Delete the bank record
            $bank->delete();

            DB::commit();

            Session::flash('danger', 'Deleted Successfully!');
            return redirect()->route('admin.bank.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

}
