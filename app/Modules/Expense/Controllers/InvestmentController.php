<?php

namespace App\Modules\Expense\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Expense\Models\Investment;
use App\Modules\Expense\Models\Project;
use App\Modules\Expense\Requests\InvestmentRequest;
use Auth;
use DB;
use Exception;
use File;
use Image;
use Session;
use Storage;
use Throwable;


class InvestmentController extends Controller
{

    public function index()
    {
        $pageTitle = "List of Investment Information";
        $moduleTitle = "Investment Information";

        // ✅ Use Eloquent, select only needed fields (better performance)
        $data = Investment::where('status', 'active')->with('project')
            ->latest('id')
            ->get();

        // ✅ Return view with compact variables
        return view('Expense::investment.index', compact('pageTitle', 'moduleTitle', 'data'));
    }


    public function create()
    {
        $pageTitle = "Add Investment Information";
        $ModuleTitle = "Investment Information";
        $projects = Project::where('status', 1)->pluck('name', 'id')->toArray();
        return view("Expense::investment.create", compact('pageTitle', 'ModuleTitle', 'projects'));
    }

    public function store(InvestmentRequest $request)
    {
        $input = $request->all();

        // ✅ Handle file upload safely
        if ($request->hasFile('image')) {
            $avatar = $request->file('image');
            $fileName = str_replace(' ', '_', $input['name']) . '-' . time() . '.' . $avatar->getClientOriginalExtension();

            // Make directory if not exists
            $destinationPath = public_path('/uploads/investment/');
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

            $input['image'] = $fileName;
        }

        DB::beginTransaction();
        try {
            Investment::create($input);

            DB::commit();
            Session::flash('message', 'Investment added successfully!');

            return redirect()->route(
                $input['status'] === 'active' ? 'admin.investment.index' : 'admin.investment.inactive'
            );

        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $pageTitle = "Update Investment Information";
        $ModuleTitle = "Investment Information";
        $projects = Project::where('status', 1)->pluck('name', 'id')->toArray();

        // Retrieve expense or fail gracefully
        $data = Investment::findOrFail($id);

        return view('Expense::investment.edit', compact('pageTitle', 'ModuleTitle', 'data', 'projects'));
    }

    public function update(InvestmentRequest $request, $id)
    {
        // 1️⃣ Fetch the record safely
        $investment = Investment::findOrFail($id);

        // 2️⃣ Extract validated data
        $input = $request->validated();

        // 3️⃣ Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $sizeKB = $file->getSize() / 1024; // bytes → KB

            // Validate file size (max 5MB)
            if ($sizeKB > 5120) {
                return back()->withInput()->with('error', 'Image size must be less than 5MB');
            }

            // Generate safe file name
            $fileName = str_replace(' ', '_', $investment->name ?? 'investment')
                . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Resize and store
            Image::make($file)
                ->resize(600, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save(public_path('uploads/investment/' . $fileName), 85);

            // Delete old file if exists
            if (!empty($investment->image) && File::exists(public_path('uploads/investment/' . $investment->image))) {
                File::delete(public_path('uploads/investment/' . $investment->image));
            }

            // Update image field
            $input['image'] = $fileName;
        } else {
            // Keep the old image if none uploaded
            $input['image'] = $investment->image;
        }

        DB::beginTransaction();

        try {
            // 4️⃣ Update the model
            $investment->update($input);

            DB::commit();

            Session::flash('message', 'Investment updated successfully!');

            // 5️⃣ Redirect based on status
            return redirect()->route(
                $input['status'] === 'active'
                    ? 'admin.investment.index'
                    : 'admin.investment.inactive'
            );

        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
            return back()->withInput()->with('danger', 'Update failed: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $investment = Investment::findOrFail($id);

            $investment->update([
                'status' => 'inactive',
                'updated_by' => Auth::id(),
            ]);

            DB::commit();

            Session::flash('danger', 'Investment moved to inactive list!');
            return redirect()->route('admin.investment.inactive');

        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist()
    {
        $pageTitle = "List of Inactive Investments";
        $ModuleTitle = "Investment Information";
        $Cancel = 'Cancel';

        // Fetch all inactive expenses (newest first)
        $data = Investment::where('status', 'inactive')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('Expense::investment.index', compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }


    public function rollback($id)
    {
        DB::beginTransaction();
        try {
            $investment = Investment::findOrFail($id);

            $investment->status = 'active';
            $investment->updated_by = Auth::id();
            $investment->save();

            DB::commit();

            Session::flash('message', 'Investment rolled back successfully!');
            return redirect()->route('admin.investment.index');
        } catch (Exception $e) {
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
            $investment = Investment::findOrFail($id);

            // Delete image if exists
            if (!empty($investment->image) && File::exists(public_path('uploads/investment/' . $investment->image))) {
                File::delete(public_path('uploads/investment/' . $investment->image));
            }

            // Delete the record
            $investment->delete();

            DB::commit();

            Session::flash('danger', 'Deleted successfully!');
            return redirect()->route('admin.investment.inactive');

        } catch (Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }

}
