<?php

namespace App\Modules\User\Controllers;

use App\Modules\Bank\Models\ProfitDistributeMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests;
use Illuminate\Support\Facades\Input;

use App\Modules\User\Models\Member;
use App\Modules\Deposite\Models\Deposite;
use App\Modules\User\Models\User;


use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;

class UserController extends Controller
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
        $pageTitle   = "List of Member Information";
        $ModuleTitle = "Member Information";

        // Fetch active members (latest first)
        $data = Member::where('status', 'active')
            ->orderByDesc('id')
            ->get();

        // Return to blade
        return view('User::user.index', compact('pageTitle', 'ModuleTitle', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Member Information";
        $ModuleTitle = "Member Information";

        return view("User::user.create", compact('pageTitle','ModuleTitle'));
    }

    public function store(Requests\UserRequest $request)
    {
        $input = $request->all();
        $name = preg_replace('/\s+/', '', $input['name']);

        // Join information
        $input['join_date']  = date("d-m-Y");
        $input['join_day']   = date("l");
        $input['join_month'] = date("F");
        $input['join_year']  = date("Y");
        $input['join_time']  = date("h:i:sa");

        // Check duplicate mobile
        if (Member::where('mobile', $input['mobile'])->exists()) {
            Session::flash('info', 'This Mobile Already Exists!');
            return redirect()->back()->withInput();
        }

        // Handle image
        $member_img_title = null;
        if ($request->hasFile('image_link')) {
            $avatar = $request->file('image_link');
            $sizeKb = $avatar->getSize() / 1024;

            if ($sizeKb > 5120) {
                Session::flash('error', 'This Image size is bigger than 5MB');
                return redirect()->back()->withInput();
            }

            $member_img_title = $name . '-' . time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)
                ->resize(600, 400)
                ->save(public_path('/uploads/member/' . $member_img_title));

            $input['image_link'] = $member_img_title;
        }

        DB::beginTransaction();

        try {
            $member_data = Member::create($input);

            $user = new User();
            $user->user_id     = $member_data->id;
            $user->name        = $input['name'];
            $user->email       = $input['mobile'];
            $user->type        = $input['type'];
            $user->image_link  = $member_img_title;
            $user->password    = bcrypt($input['mobile']); // Laravel helper
            $user->save();

            DB::commit();

            Session::flash('message', 'Member added successfully!');
            return $input['status'] === 'active'
                ? redirect()->route('admin.member.index')
                : redirect()->route('admin.member.inactive');

        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = "Update Member Information";
        $ModuleTitle = "Member Information";

        // Find member
        $data = Member::find($id);

        if (!$data) {
            Session::flash('error', 'Member not found!');
            return redirect()->route('admin.member.index');
        }

        return view("User::user.edit", compact('pageTitle','ModuleTitle','data'));
    }


    public function update(Requests\UserUpdateRequest $request, $id)
    {
        $member = Member::findOrFail($id);
        $user = User::where('user_id', $id)->firstOrFail();

        $input = $request->all();
        $nameSlug = preg_replace('/\s+/', '', $input['name']);

        // Check if mobile exists for another member
        $mobileExists = Member::where('mobile', $input['mobile'])
            ->where('id', '!=', $id)
            ->exists();

        if ($mobileExists) {
            Session::flash('info', 'This Mobile Already Exists!');
            return redirect()->back()->withInput();
        }

        // Handle image upload
        if ($request->hasFile('image_link')) {
            $image = $request->file('image_link');
            $sizeKb = $image->getSize() / 1024;

            if ($sizeKb > 5120) {
                Session::flash('error', 'This Image size is bigger than 5MB');
                return redirect()->back();
            }

            $imageName = $nameSlug . '-' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 400)->save(public_path('/uploads/member/' . $imageName));

            // Delete old image
            if ($member->image_link) {
                File::delete(public_path('/uploads/member/' . $member->image_link));
            }

            $input['image_link'] = $imageName;
        } else {
            $input['image_link'] = $member->image_link;
        }

        // Preserve join details
        $input['join_date'] = $member->join_date;
        $input['join_day'] = $member->join_day;
        $input['join_month'] = $member->join_month;
        $input['join_year'] = $member->join_year;
        $input['join_time'] = $member->join_time;

        $userData = [
            'name' => $input['name'],
            'email' => $input['mobile'],
            'type' => $input['type'],
            'image_link' => $input['image_link']
        ];

        DB::beginTransaction();
        try {
            $member->update($input);
            $user->update($userData);

            DB::commit();

            Session::flash('message', 'Successfully updated!');
            return $input['status'] === 'active'
                ? redirect()->route('admin.member.index')
                : redirect()->route('admin.member.inactive');
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
            $member = Member::findOrFail($id);
            $member->status = 'inactive';
            $member->updated_by = Auth::user()->id;
            $member->save();

            DB::commit();

            Session::flash('message', 'Member added to Inactive List!');
            return redirect()->route('admin.member.inactive');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist()
    {
        $pageTitle = "List of Inactive Members";
        $ModuleTitle = "Member Information";

        $Cancel = 'Cancel';

        // Fetch all inactive members, latest updated first
        $data = Member::where('status', 'inactive')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view("User::user.index", compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }

    public function rollback($id)
    {
        DB::beginTransaction();
        try {
            // Update member status to active
            Member::where('id', $id)->update([
                'status' => 'active',
                'updated_by' => Auth::user()->id,
            ]);

            DB::commit();

            Session::flash('message', 'Member rolled back successfully!');
            return redirect()->route('admin.member.index'); // Using route helper

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $member = Member::findOrFail($id); // Throws 404 if not found
            $depositeCount = Deposite::where('member_id', $id)->count();

            if ($depositeCount == 0) {
                // Delete member image if exists
                if (File::exists(public_path('uploads/member/' . $member->image_link))) {
                    File::delete(public_path('uploads/member/' . $member->image_link));
                }

                // Delete member and user
                $member->delete();
                User::where('user_id', $id)->delete();

                DB::commit();

                Session::flash('message', 'Deleted Successfully!');
                return redirect()->route('admin.member.inactive');
            } else {
                $depositArray = [];
                $totalDeposit = 0;
                $profitArray = [];
                $totalProfit = 0;

                for ($year = 2019; $year <= date("Y"); $year++) {
                    $deposit = Deposite::where('member_id', $id)
                        ->where('status', 'active')
                        ->where('type', '!=', 'Registration')
                        ->where('year', $year)
                        ->sum('amount');

                    $depositArray[$year] = $deposit;
                    $totalDeposit += $deposit ?: 0;

                    $profit = ProfitDistributeMember::join('profit_distribute', 'profit_distribute.id', '=', 'profit_distribute_member.profit_id')
                        ->where('profit_distribute_member.member_id', $id)
                        ->where('profit_distribute.profit_year', $year)
                        ->select('profit_distribute_member.profit_amount')
                        ->first();

                    $profitAmount = $profit ? $profit->profit_amount : 0;
                    $profitArray[$year] = $profitAmount;
                    $totalProfit += $profitAmount;
                }

                $pageTitle = "Confirm Deletion"; // Add meaningful titles
                $ModuleTitle = "Member Information";

                return view("User::user.deleteconfirm", compact(
                    'pageTitle',
                    'ModuleTitle',
                    'depositArray',
                    'totalDeposit',
                    'profitArray',
                    'totalProfit',
                    'member'
                ));
            }

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function parmanentDelete($id)
    {
        DB::beginTransaction();

        try {
            // Find member
            $member = Member::findOrFail($id);

            // Delete all deposit records for this member
            Deposite::where('member_id', $id)->delete();

            // Delete member image if exists
            if (File::exists(public_path('uploads/member/' . $member->image_link))) {
                File::delete(public_path('uploads/member/' . $member->image_link));
            }

            // Delete member and associated user
            $member->delete();
            User::where('user_id', $id)->delete();

            DB::commit();

            Session::flash('message', 'Deleted Permanently!');
            return redirect()->route('admin.member.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
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
        $member = Member::where('member.id', $id)->first();

        if (!$member) {
            return [
                'result' => 'error',
                'content' => '',
                'header' => 'Member not found'
            ];
        }

        // Last 10 Deposits
        $deposite = Deposite::where('member_id', $id)
            ->where('status', 'active')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        // Calculate yearly totals (from 2019 to current year)
        $startYear = 2019;
        $currentYear = date('Y');
        $yearTotals = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $yearTotals[$year] = Deposite::where('member_id', $id)
                ->where('status', 'active')
                ->where('year', $year)
                ->sum('amount');
        }

        // Total sum of all deposits
        $grandTotal = array_sum($yearTotals);

        $view = \Illuminate\Support\Facades\View::make('User::user.show', compact(
            'member', 'deposite', 'yearTotals', 'grandTotal', 'startYear', 'currentYear'
        ));

        $contents = $view->render();

        return [
            'result' => 'success',
            'content' => $contents,
            'header' => $member->name . ' Profile',
        ];
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showDeposit(){
        $response = [];
        $member_id = $_GET['member_id'];

        $member = Member::where('member.id', $member_id)->first();

        if ($member) {
            $years = range(2019, 2027);
            $deposits = [];

            foreach ($years as $year) {
                $deposits[$year] = Deposite::where('member_id', $member_id)
                    ->where('status', 'active')
                    ->where('year', $year)
                    ->get();
            }

            // get profits
            $profits = [];
            foreach ($years as $year) {
                $profit = DB::table('profit_distribute')
                    ->join('profit_distribute_member','profit_distribute_member.profit_id','=','profit_distribute.id')
                    ->where('profit_distribute.profit_year', $year)
                    ->where('profit_distribute_member.member_id', $member->id)
                    ->first();

                $profits[$year] = $profit ? $profit->profit_amount : 0;
            }

            $view = \Illuminate\Support\Facades\View::make('User::user.showMemberDeposite', compact('member', 'deposits', 'years', 'profits'));
            $response['result'] = 'success';
            $response['content'] = $view->render();
            $response['header'] = $member->name . ' Total Deposite View';
        } else {
            $response['result'] = 'error';
            $response['message'] = 'Member not found.';
        }

        return $response;
    }


    public function depositeDetails($id){

        $name = Member::where('id', $id)
                            ->where('status', 'active')
                            ->select('name')
                            ->first();
        $pageTitle = $name['name']." Deposite List";

        // Get payment  data
        $data = Deposite::join('member', 'member.id', '=', 'deposite.member_id')
                ->where('deposite.member_id',$id)
                ->where('member.status','active')
                ->where('deposite.status','active')
                ->select('member.name','member.mobile','member.image_link','deposite.*')
                ->orderby('deposite.id','desc')
                ->get();
        $Total_amount = 0;
        foreach ($data as  $value) {
            $Total_amount = $Total_amount+$value->amount;
        }

        $ModuleTitle = $name['name']." Total Deposite ".$Total_amount.' TK.';

        $member = Member::orderBy('id','asc')
                    ->where('status','active')
                    ->pluck('name','id')
                    ->all();
        array_push($member,"Select Member");
        krsort($member);

        return view("User::user.memberDepositeDetails", compact('pageTitle','ModuleTitle','data','member'));
    }

    public function ChangeForm(){
        $pageTitle = Auth::user()->name." Information";
        $ModuleTitle = "Change Password";

        return view("User::password.create", compact('pageTitle','ModuleTitle'));
    }

    public function change(Requests\PasswordUpdate $request){
        $input = $request->all();
        $password = password_hash($input['password'], PASSWORD_BCRYPT);

        $login_id = Auth::user()->id;

        $user_model = User::where('id', $login_id)
            ->select('*')
            ->first();

        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $user_model->update([
                        'password' => $password,
                    ]);
                DB::commit();
                Session::flash('message', 'Password Change Successfully ! New Password '.$input['password']);
                return redirect('admin-password-ChangeForm');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }


    public function specificData(){
        $response = [];
        $member_id = $_GET['member_id'];

        // echo $member_id;
        // exit();
        $member = Member::where('member.id', $member_id)
                        ->where('status', 'active')
                        ->select('member.*')
                        ->first();


        if (count($member) > 0) {
            $deposite2019 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2019')
                            ->select('*')
                            ->get();
            $total_2019 = 0;
            foreach ($deposite2019 as $element) {
                $total_2019 = $total_2019+$element->amount;
            }


            $deposite2020 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2020')
                            ->select('*')
                            ->get();
            $total_2020 = 0;
            foreach ($deposite2020 as $element) {
                $total_2020 = $total_2020+$element->amount;
            }

            $deposite2021 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2021')
                            ->select('*')
                            ->get();
            $total_2021 = 0;
            foreach ($deposite2021 as $element) {
                $total_2021 = $total_2021+$element->amount;
            }

            $deposite2022 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2022')
                            ->select('*')
                            ->get();
            $total_2022 = 0;
            foreach ($deposite2022 as $element) {
                $total_2022 = $total_2022+$element->amount;
            }

            $deposite2023 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2023')
                            ->select('*')
                            ->get();
            $total_2023 = 0;
            foreach ($deposite2023 as $element) {
                $total_2023 = $total_2023+$element->amount;
            }

            $deposite2024 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2024')
                            ->select('*')
                            ->get();
            $total_2024 = 0;
            foreach ($deposite2024 as $element) {
                $total_2024 = $total_2024+$element->amount;
            }

            $deposite2025 = Deposite::where('member_id', $member_id)
                            ->where('status', 'active')
                            ->where('year', '2025')
                            ->select('*')
                            ->get();
            $total_2025 = 0;
            foreach ($deposite2025 as $element) {
                $total_2025 = $total_2025+$element->amount;
            }

            $total = 0;
            $total = $total_2025+$total_2024+$total_2023+$total_2022+$total_2021+$total_2020+$total_2019;
        }
        $view = \Illuminate\Support\Facades\View::make('User::user.showSpecificMember',compact('member','total_2019','total_2020','total_2021','total_2022','total_2023','total_2024','total_2025','total'));

        $contents = $view->render();
        $response['result'] = 'success';
        $response['content'] = $contents;

        $response['header'] = 'Hi '.Auth::user()->name;
        $response['headerSmall'] = 'I AM '.$member->name;


        return $response;
    }
}
