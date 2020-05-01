<?php

namespace App\Modules\File\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\File\Requests;
use Illuminate\Support\Facades\Input;


use App\Modules\File\Models\MemberFile;


use DB;
use Session;
use image;
use Storage;
use App;
use File;

Use Auth;

class FileController extends Controller
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
        $pageTitle = "List of File Information";
        $ModuleTitle = "File Information";

        
        // Get file  data
        $data = MemberFile::where('status','active')
                ->select('file.*')
                ->orderby('file.id','desc')
                ->get();
        
        // return view
        return view("File::file.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add File Information";
        $ModuleTitle = "File Information";
        
        return view("File::file.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\FileRequest $request)
    {
        $input = $request->all();

        $name = preg_replace('/\s+/', '', $input['title']);

        $input['file_date'] = date("d-m-Y");
        $input['file_day'] = date("l");
        $input['file_month'] = date("F");
        $input['file_year'] = date("Y");
        $input['file_time'] = date(" h:i:sa");

        if (isset($input) && !empty($input)) { 
            $avatar = $request->file('file_link');
            $file_title = $name.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['file_link'] = $file_title;

            $path = public_path("uploads/file/");
            $target_file =  $path.basename($file_title);
            
            $file_path = $_FILES['file_link']['tmp_name'];
            
            
            $result = move_uploaded_file($file_path,$target_file);

            if ($result) {
                /* Transaction Start Here */
            DB::beginTransaction();
            try {

                if($file_data = MemberFile::create($input)){  
                    $file_data->save();
                }

                DB::commit();
                Session::flash('message', 'File is added Successfully!');
                $status = $input['status'];
                if ($status =='active') {
                    return redirect('admin-file-index');
                }else{
                    return redirect('admin-file-inactive');
                }
                
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
            }
            else {
                Session::flash('message', 'File Not Uploaded!');
                return redirect()->back()->withInput();    
            } 
        }else{
            Session::flash('error', 'Something went wrong !');    
            return redirect()->back();
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
        
        $pageTitle = "Update File Information";
        $ModuleTitle = "File Information";

        // Find file
        $data = MemberFile::where('id', $id)
                        ->select('*')
                        ->first();
        
        return view("File::file.edit", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateFileRequest $request, $id)
    {
        // Find member
        $MemberFile = MemberFile::where('id', $id)
            ->select('*')
            ->first();

        $input = $request->all();

        $input['join_date'] = date("d-m-Y");
        $input['join_day'] = date("l");
        $input['join_month'] = date("F");
        $input['join_year'] = date("Y");
        $input['join_time'] = date(" h:i:sa");

        $file = $input['file_link'];

        $name = preg_replace('/\s+/', '', $input['title']);


        if (isset($file) && !empty($file)) {
            $avatar = $request->file('file_link');
            $file_title = $name.'-'.time().'.'.$avatar->getClientOriginalExtension();
            $input['file_link'] = $file_title;

             if (File::exists(public_path().'/uploads/file/'.$MemberFile->file_link)) {
                    File::delete(public_path().'/uploads/file/'.$MemberFile->file_link);
                }

            $path = public_path("uploads/file/");
            $target_file =  $path.basename($file_title);
            $file_path = $_FILES['file_link']['tmp_name'];
            $result = move_uploaded_file($file_path,$target_file);
            
        }else{
            $input['file_link'] = $MemberFile['file_link'];
        }

        DB::beginTransaction();
        try {

            $result = $MemberFile->update($input);
            $MemberFile->save();

            DB::commit();

            Session::flash('message', 'File Successfully updated!');
            $status = $input['status'];
            if ($status =='active') {
                return redirect('admin-file-index');
            }else{
                return redirect('admin-file-inactive');
            }

        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
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

                $data = DB::table('file')->where('id',$id);
                $data->update([
                        'status' => 'inactive',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('danger', 'File Added Inactive List !');
                return redirect('admin-file-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }

    public function inactivelist(){
        $pageTitle = "List of Inactive File";
        $ModuleTitle = "File Information";

        $Cancel = 'Cancel';

        
        // Get file  data
        $data = MemberFile::where('status','inactive')
                ->select('file.*')
                ->orderby('file.id','desc')
                ->get();

        // return view
        return view("File::file.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('file')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-file-index');

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

                $data = MemberFile::where('id',$id)->first();

                
                if (File::exists(public_path().'/uploads/file/'.$data->file_link)) {
                    File::delete(public_path().'/uploads/file/'.$data->file_link);
                }
                $file = MemberFile::where('id',$id);
                
                $file->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-file-inactive');
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }
}
