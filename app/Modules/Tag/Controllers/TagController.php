<?php

namespace App\Modules\Tag\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Tag\Models\Tag;

use App\Modules\Tag\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
// use Image;
// use File;
// use Storage;
use App;
Use Auth;
class TagController extends Controller
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
     * CategoryController constructor.
     */
    public function __construct()
    {


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Tags Information";
        $ModuleTitle = "Tags Information";

        
        // Get tag data
        $data = Tag::where('status','active')
                ->orderby('id','desc')
                ->get();


        // return view
        return view("Tag::tag.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Tags";
        $ModuleTitle = "Tags Information";

        // return View
        return view("Tag::tag.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\TagRequest $request)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        // INPUT ASE KI NA
        if(isset($input)){
            // INPUT SLUG DIYE DB TE DATA ASE KI NA
            $data = Tag::where('slug',$input['slug'])->exists();
            if(!$data){
            // JODI INPUT ER SLUG DIYE DB TE DATA NA THEKE
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store cateogory data 
                    if($input = Tag::create($input))
                    {
                        $input->created_by = Auth::user()->id;
                        $input->save();
                    }

                    DB::commit();
                    Session::flash('message', 'Tag is added Successfully!');
                    return redirect('admin-tag-index');
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }
            }else{
                Session::flash('error', 'This Slug Already Exists !');    
                return redirect()->back()->withInput();
            }
        }else{
            Session::flash('error', 'Input Valid Data !');    
            return redirect()->back()->withInput();
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
        $ModuleTitle = "Tags Information";
        $pageTitle = "Update Tag";

        // Find news
        $data = Tag::where('id', $id)->first();
        
        // Return view
        return view("Tag::tag.edit", compact('data','pageTitle','ModuleTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\TagRequest $request, $id)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();
        // INPUT ASE KI NA
        if(isset($input)){
            // INPUT SLUG DIYE DB TE DATA ASE KI NA
            // $data = Tag::where('slug',$input['slug'])->exists();
            $model = Tag::where('Tag.id',$id)->first();

            if($model){
            // JODI INPUT ER SLUG DIYE DB TE DATA NA THEKE
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store cateogory data 
                     $result = $model->update($input);

                    if($result)
                    {
                        $model->updated_by =  Auth::user()->id;
                        $model->save();
                    }

                    DB::commit();
                    Session::flash('message', 'Tag is update Successfully!');
                    return redirect('admin-tag-index');
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    Session::flash('danger', $e->getMessage());
                    return redirect()->back();
                }
            }else{
                Session::flash('error', 'Data empty !');    
                return redirect()->back()->withInput();
            }
        }else{
            Session::flash('error', 'Input Valid Data !');    
            return redirect()->back()->withInput();
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

                $data = DB::table('tag')->where('tag.id',$id);
                $data->update([
                        'status' => 'cancel',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Tag added cancel list !');
                return redirect('admin-tag-cancel');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }


    public function cancellist()
    {
        $pageTitle = "List of Cancel Tag";
        $ModuleTitle = "Tag Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = Tag::whereIn('status', array('cancel','inactive'))
                ->orderby('id','desc')
                ->get();


        // return view
        return view("Tag::tag.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('tag')->where('tag.id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-tag-index');

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

                $data = DB::table('tag')->where('tag.id',$id);
                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-tag-cancel');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }
}
