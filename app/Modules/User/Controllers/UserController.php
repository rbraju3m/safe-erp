<?php

namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\User\Requests;
use Illuminate\Support\Facades\Input;

use App\Modules\User\Models\Member;
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
        $pageTitle = "List of Member Information";
        $ModuleTitle = "Member Information";

        
        // Get Parent category data
        $data = Member::orderBy('id','desc')
                    ->where('status','active') 
                    ->get();
        // return view
        return view("User::user.index", compact('pageTitle','ModuleTitle','data'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRequest $request)
    {
        $input = $request->all();

        // Check already mobile present or not
        $data = member::where('mobile',$input['mobile'])->exists();

        if (!$data) {
            if (isset($input) && !empty($input)) {
            // Check image file exists or not
            if($request->hasfile('image_link')){
                $member_img = $request->file('image_link');
                $image_info = getimagesize($member_img);
                $size = $request->file('image_link')->getSize()/1024;

                if($size < 5120){
                    // echo "5mb er soman ba soto";
                    $avatar = $request->file('image_link');
                    $member_img_title = $input['name'].'-'.time().'.'.$avatar->getClientOriginalExtension();
                    Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/member/' . $member_img_title) );
                    $input['image_link'] = $member_img_title;
                    // echo $member_img_title;
                }else{
                    Session::flash('error', 'This Image size bigger than 5MB');    
                    return redirect()->back();
                }

            /* Transaction Start Here */
            DB::beginTransaction();
                try {
                    // Store cateogory data 
                    if($member_data = Member::create($input))
                    {  
                        $member_data->save();

                        $user_model = new User();
                        $user_model->user_id = $member_data->id;
                        $user_model->name=$input['name'];
                        $user_model->email=$input['mobile'];
                        $user_model->type=$input['type'];
                        $user_model->image_link = $member_img_title;
                        $user_model->password = password_hash($input['mobile'], PASSWORD_BCRYPT);
                        $user_model->save();

                    }

                    DB::commit();
                    Session::flash('message', 'Member is added Successfilly!');
                    $status = $input['status'];
                    if ($status =='active') {
                        return redirect('admin-member-index');
                    }else{
                        return redirect('admin-member-inactive');
                    }
                    
                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }
            }
        }else{
            Session::flash('error', 'Something went wrong !');    
            return redirect()->back();
        }
        }else{
            Session::flash('info', 'This Mobile Already Exists !');
        }
        return redirect()->back()->withInput();
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
        $pageTitle = "Add Member Information";
        $ModuleTitle = "Member Information";

        // Find news
        $data = Member::where('member.id', $id)
                        ->select('member.*')
                        ->first();
        
        return view("User::user.edit", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserUpdateRequest $request, $id)
    {
        // Find member
        $member_model = Member::where('member.id', $id)
            ->select('member.*')
            ->first();
        // Find user
        $user_model = User::where('user_id', $id)
            ->select('*')
            ->first();

        $input = $request->all();
        $member_image = $input['image_link'];

        $data = Member::where('member.mobile', $input['mobile'])
            ->select('member.*')
            ->get();
        $count = count($data);

        if ($count == 1) {

        if (isset($member_image) && !empty($member_image)) {
            $member_img = $request->file('image_link');
            $image_info = getimagesize($member_img);
            $size = $request->file('image_link')->getSize()/1024;

            if($size < 5120){
                // echo "5mb er soman ba soto";
                $avatar = $request->file('image_link');
                $member_img_title = $input['name'].'-'.time().'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/member/' . $member_img_title) );
                $input['image_link'] = $member_img_title;
                // File::Delete($member_model->image_link);
                File::delete(public_path().'/uploads/member/'.$member_model->image_link);
            }else{
                Session::flash('error', 'This Image size bigger than 5MB');    
                return redirect()->back();
            }
        }else{
            $input['image_link'] = $member_model['image_link'];
            // echo $input['image_link'];
        }

        $userdata['name'] = $input['name'];
        $userdata['type'] = $input['type'];
        $userdata['image_link'] = $input['image_link'];



        DB::beginTransaction();
        try {

            $result = $member_model->update($input);
            $user_model->update($userdata);

            $user_model->save();
            $member_model->save();

            DB::commit();

            Session::flash('message', 'Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-member-index');
            }else{
                return redirect('admin-member-inactive');
            }
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
        }else{
            Session::flash('info', 'This Mobile Already Exists !');
        }
        return redirect()->back()->withInput();
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

                $data = DB::table('member')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Member Added Inactive List !');
                return redirect('admin-member-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }

    public function inactivelist()
    {
        $pageTitle = "List of Inactive Member";
        $ModuleTitle = "Member Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = Member::orderBy('id','desc')
                    ->where('status','inactive') 
                    ->get();
        // return view
        return view("User::user.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('member')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-member-index');

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

                $data = DB::table('member')->where('id',$id)->first();
                
                if (File::exists(public_path().'/uploads/member/'.$data->image_link)) {
                    File::delete(public_path().'/uploads/member/'.$data->image_link);
                }
                $member_data = DB::table('member')->where('id',$id);
                $user_data = DB::table('users')->where('user_id',$id);
                $member_data->delete();
                $user_data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-member-inactive');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }
}
