<?php

namespace App\Modules\Gallery\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Gallery\Requests;
use Illuminate\Support\Facades\Input;
use App\Modules\Gallery\Models\Gallery;


use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;


class GalleryController extends Controller
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
        $pageTitle = "List of Gallery Information";
        $ModuleTitle = "Gallery Information";

        
        // Get gallery  data
        $data = Gallery::where('status','active')
                ->select('*')
                ->orderby('id','desc')
                ->get();
        
        // return view
        return view("Gallery::gallery.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Gallery Information";
        $ModuleTitle = "Gallery Information";
        
        return view("Gallery::gallery.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\GalleryRequest $request)
    {
        $input = $request->all();
        $name = preg_replace('/\s+/', '', $input['title']);

        $input['image_date'] = date("d-m-Y");
        $input['image_day'] = date("l");
        $input['image_month'] = date("F");
        $input['image_year'] = date("Y");
        $input['image_time'] = date(" h:i:sa");

        
        // Check image file exists or not
        if($request->hasfile('image_link')){
            $gallery_img = $request->file('image_link');
            $image_info = getimagesize($gallery_img);
            $size = $request->file('image_link')->getSize()/1024;

            if($size < 5120){
                // echo "5mb er soman ba soto";
                $avatar = $request->file('image_link');
                $gallery_img_title = $name.'-'.time().'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/gallery/' . $gallery_img_title) );
                $input['image_link'] = $gallery_img_title;
                // echo $gallery_img_title;
            }else{
                Session::flash('error', 'This Image size bigger than 5MB');    
                return redirect()->back();
            }

        /* Transaction Start Here */
        DB::beginTransaction();
            try {
                // Store cateogory data 
                if($gallery_data = Gallery::create($input))
                {  
                    $gallery_data->save();

                }

                DB::commit();
                Session::flash('message', 'Gallery is added Successfully!');
                return redirect()->back();

                // $status = $input['status'];
                // if ($status =='active') {
                //     return redirect('admin-gallery-index');
                // }else{
                //     return redirect('admin-gallery-inactive');
                // }
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
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
