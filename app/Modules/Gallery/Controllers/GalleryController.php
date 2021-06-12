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

                $status = $input['status'];
                if ($status =='active') {
                    return redirect('admin-gallery-index');
                }else{
                    return redirect('admin-gallery-inactive');
                }
                
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
        $pageTitle = "Update Gallery Information";
        $ModuleTitle = "Gallery Information";

        // Find news
        $data = Gallery::where('id', $id)
                        ->select('*')
                        ->first();

        return view("Gallery::gallery.edit", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateGalleryRequest $request, $id)
    {
        // Find gallery
        $gallery_model = Gallery::where('id', $id)
            ->select('*')
            ->first();
        

        $input = $request->all();
        $gallery_img = $input['image_link'];

        $name = preg_replace('/\s+/', '', $input['title']);

        if (isset($gallery_img) && !empty($gallery_img)) {
            $gallery = $request->file('image_link');
            $image_info = getimagesize($gallery);
            $size = $request->file('image_link')->getSize()/1024;

            if($size < 5120){
                // echo "5mb er soman ba soto";
                $avatar = $request->file('image_link');
                $gallery_title = $name.'-'.time().'.'.$avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(600, 400)->save( public_path('/uploads/gallery/' . $gallery_title) );
                $input['image_link'] = $gallery_title;
                // File::Delete($gallery_model->image_link);
                File::delete(public_path().'/uploads/gallery/'.$gallery_model->image_link);
            }else{
                Session::flash('error', 'This Image size bigger than 5MB');    
                return redirect()->back();
            }
        }else{
            $input['image_link'] = $gallery_model['image_link'];
        }

        $input['image_date'] = $gallery_model['image_date'];
        $input['image_day'] = $gallery_model['image_day'];
        $input['image_month'] = $gallery_model['image_month'];
        $input['image_year'] = $gallery_model['image_year'];
        $input['image_time'] = $gallery_model['image_time'];


        DB::beginTransaction();
        try {

            $result = $gallery_model->update($input);

            $gallery_model->save();

            DB::commit();

            Session::flash('message', 'Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-gallery-index');
            }else{
                return redirect('admin-gallery-inactive');
            }
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
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

                $data = DB::table('gallery')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('danger', 'Gallery Added Inactive List !');
                return redirect('admin-gallery-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }

    public function inactivelist(){
        $pageTitle = "List of Inactive Gallery";
        $ModuleTitle = "Gallery Information";

        $Cancel = 'Cancel';

        
        // Get file  data
        $data = Gallery::where('status','inactive')
                ->select('*')
                ->get();

        // return view
        return view("Gallery::gallery.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('gallery')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-gallery-index');

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

                $data = Gallery::where('id',$id)->first();

                
                if (File::exists(public_path().'/uploads/gallery/'.$data->image_link)) {
                    File::delete(public_path().'/uploads/gallery/'.$data->image_link);
                }
                $file = Gallery::where('id',$id);
                
                $file->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-gallery-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }
}
