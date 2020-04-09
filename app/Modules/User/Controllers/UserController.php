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
        // echo "<pre>";
        // print_r($data);
        // exit();
        

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

                // echo $size;
                // echo "<pre>";
                // print_r($input);

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
                    $user_model->image_link = $member_img_title;
                    $user_model->password = password_hash($input['mobile'], PASSWORD_BCRYPT);
                    $user_model->save();

                }

                DB::commit();
                Session::flash('message', 'Member is added Successfilly!');
            return redirect()->back();

                // return redirect('admin-news-index');
                

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
