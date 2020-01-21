<?php

namespace App\Modules\BreakingNews\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\BreakingNews\Models\BreakingNews;

use App\Modules\BreakingNews\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
use App;
Use Auth;

class BreakingNewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "List of Breaking News Information";
        $ModuleTitle = "Breaking News Information";

        
        // Get BreakingNews data
        $data = BreakingNews::where('status','active')
                ->orderby('id','desc')
                ->get();


        // return view
        return view("BreakingNews::breakingnews.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add Breaking News";
        $ModuleTitle = "Breaking News Information";

        // return View
        return view("BreakingNews::breakingnews.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\BreakingNewsRequest $request)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        // INPUT ASE KI NA
        if(isset($input)){
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store BreakingNews data 
                    if($input = BreakingNews::create($input))
                    {
                        $input->created_by = Auth::user()->id;
                        $input->save();
                    }

                    DB::commit();
                    Session::flash('message', 'Breaking news is added Successfully!');
                    if($input['status'] == 'active'){
                    	return redirect('admin-breakingnews-index');
                    }else{
                    	return redirect('admin-breakingnews-cancel');
                    }
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }
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
        $ModuleTitle = "Breaking News Information";
        $pageTitle = "Update Breaking News";

        // Find BreakingNews
        $data = BreakingNews::where('id', $id)->first();
        
        // Return view
        return view("BreakingNews::breakingnews.edit", compact('data','pageTitle','ModuleTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\BreakingNewsRequest $request, $id)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();
        // INPUT ASE KI NA
        if(isset($input)){
        	
            $model = BreakingNews::where('id',$id)->first();

            if($model){
            // JODI INPUT ER SLUG DIYE DB TE DATA NA THEKE
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store breaking news data 
                     $result = $model->update($input);

                    if($result)
                    {
                        $model->updated_by =  Auth::user()->id;
                        $model->save();
                    }

                    DB::commit();
                    Session::flash('message', 'Breaking News is update Successfully!');
                    if($input['status'] == 'active'){
                    	return redirect('admin-breakingnews-index');
                    }else{
                    	return redirect('admin-breakingnews-cancel');
                    }
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

                $data = DB::table('breaking_news')->where('id',$id);
                $data->update([
                        'status' => 'cancel',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Breaking news added cancel list !');
                return redirect('admin-breakingnews-cancel');

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
        $pageTitle = "List of Cancel Breaking News";
        $ModuleTitle = "Breaking News Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = BreakingNews::whereIn('status', array('cancel','inactive'))
                ->orderby('id','desc')
                ->get();


        // return view
        return view("BreakingNews::breakingnews.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }


    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('breaking_news')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-breakingnews-index');

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

                $data = DB::table('breaking_news')->where('id',$id);
                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-breakingnews-cancel');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }
}
