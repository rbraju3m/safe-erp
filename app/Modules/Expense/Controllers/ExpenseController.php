<?php

namespace App\Modules\Expense\Controllers;

use App\Modules\Expense\Requests\ExpenseRequest;
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

    public function index()
    {
        $pageTitle = "List of Expense Information";
        $moduleTitle = "Expense Information";

        // ✅ Use Eloquent, select only needed fields (better performance)
        $data = Expense::where('status', 'active')
            ->latest('id')
            ->get();

        // ✅ Return view with compact variables
        return view('Expense::expense.index', compact('pageTitle', 'moduleTitle', 'data'));
    }


    public function create()
    {
        $pageTitle = "Add Expense Information";
        $ModuleTitle = "Expense Information";

        return view("Expense::expense.create", compact('pageTitle','ModuleTitle'));
    }

    public function store(ExpenseRequest $request)
    {
        $input = $request->all();

        // ✅ Use consistent naming with your form fields
        $input['expense_date']  = now()->format('d-m-Y');
        $input['expense_day']   = now()->format('l');
        $input['expense_month'] = now()->format('F');
        $input['expense_year']  = now()->format('Y');
        $input['expense_time']  = now()->format('h:i:sa');

        // ✅ Handle file upload safely
        if ($request->hasFile('image_link')) {
            $avatar = $request->file('image_link');
            $fileName = str_replace(' ', '_', $input['name']) . '-' . time() . '.' . $avatar->getClientOriginalExtension();

            // Make directory if not exists
            $destinationPath = public_path('/uploads/expense/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Save resized image using Intervention Image
            Image::make($avatar)
                ->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($destinationPath . $fileName);

            $input['image_link'] = $fileName;
        }

        DB::beginTransaction();
        try {
            $expense = Expense::create($input);

            DB::commit();
            Session::flash('message', 'Expense added successfully!');

            return redirect()->route(
                $input['status'] === 'active' ? 'admin.expense.index' : 'admin.expense.inactive'
            );

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error instead of printing directly in production
            \Log::error('Expense store error: ' . $e->getMessage());

            Session::flash('danger', 'Error: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $pageTitle   = "Update Expense Information";
        $ModuleTitle = "Expense Information";

        // Retrieve expense or fail gracefully
        $data = Expense::findOrFail($id);

        return view('Expense::expense.edit', compact('pageTitle', 'ModuleTitle', 'data'));
    }

    public function update(ExpenseRequest $request, $id)
    {
        // Find the expense record or throw 404
        $expense = Expense::findOrFail($id);

        $input = $request->all();

        // Handle image upload
        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link');
            $sizeKB = $file->getSize() / 1024; // convert bytes to KB

            if ($sizeKB > 5120) { // limit 5MB
                Session::flash('error', 'Image size must be less than 5MB');
                return redirect()->back()->withInput();
            }

            // Generate new image name
            $fileName = $input['name'] . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Resize and save new image
            Image::make($file)
                ->resize(600, 400)
                ->save(public_path('/uploads/expense/' . $fileName));

            // Delete old image if exists
            if (!empty($expense->image_link) && File::exists(public_path('/uploads/expense/' . $expense->image_link))) {
                File::delete(public_path('/uploads/expense/' . $expense->image_link));
            }

            // Update image link
            $input['image_link'] = $fileName;
        } else {
            // Keep old image if no new file uploaded
            $input['image_link'] = $expense->image_link;
        }

        DB::beginTransaction();

        try {
            // Update the expense record
            $expense->update($input);

            DB::commit();

            Session::flash('message', 'Expense updated successfully!');

            // Redirect based on status
            return $input['status'] === 'active'
                ? redirect()->route('admin.expense.index')
                : redirect()->route('admin.expense.inactive');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('danger', 'Update failed: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $expense = Expense::findOrFail($id);

            $expense->update([
                'status' => 'inactive',
                'updated_by' => Auth::id(),
            ]);

            DB::commit();

            Session::flash('danger', 'Expense moved to inactive list!');
            return redirect()->route('admin.expense.inactive');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist()
    {
        $pageTitle = "List of Inactive Expenses";
        $ModuleTitle = "Expense Information";
        $Cancel = 'Cancel';

        // Fetch all inactive expenses (newest first)
        $data = Expense::where('status', 'inactive')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('Expense::expense.index', compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }


    public function rollback($id)
    {
        DB::beginTransaction();
        try {
            $expense = Expense::findOrFail($id);

            $expense->status = 'active';
            $expense->updated_by = Auth::id();
            $expense->save();

            DB::commit();

            Session::flash('message', 'Expense rolled back successfully!');
            return redirect()->route('admin.expense.index');
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
            // Find the expense or fail
            $expense = Expense::findOrFail($id);

            // Delete image if exists
            if (!empty($expense->image_link) && File::exists(public_path('uploads/expense/'.$expense->image_link))) {
                File::delete(public_path('uploads/expense/'.$expense->image_link));
            }

            // Delete the record
            $expense->delete();

            DB::commit();

            Session::flash('danger', 'Deleted successfully!');
            return redirect()->route('admin.expense.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

}
