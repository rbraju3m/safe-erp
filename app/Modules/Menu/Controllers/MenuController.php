<?php

namespace App\Modules\Menu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
use App;
Use Auth;

class MenuController extends Controller
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
        $pageTitle = "List of Menus Information";
        $ModuleTitle = "Menus Information";

        
        // Get tag data
        $data = Menu::where('status','active')
                ->orderby('id','desc')
                ->get();


        // return view
        return view("Menu::menu.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Menu";
        $ModuleTitle = "Menu Information";

        // return View
        return view("Menu::menu.create", compact('pageTitle','ModuleTitle'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MenuRequest $request)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        $menu_name = $input['name'];
        //echo $menu_name;
        $menu_name_key = substr($menu_name, 0, strpos($menu_name, "---"));
		$menu_name_explode = $menu_name_key.'---';
		$menu_name_value = explode($menu_name_explode,$menu_name);
		$menu_name_value = $menu_name_value[1];
		//echo $menu_name_key.' <br>'.$menu_name_value;
        //exit();

        $data = Menu::where('name',$menu_name_value)->exists();

        // INPUT ASE KI NA
        if(! $data){
                /* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store menu data 
                		$menu_model = new Menu();
				        $menu_model->name = $menu_name_value;
				        $menu_model->menu_key = $menu_name_key;
				        $menu_model->status = $input['status'];
                        $menu_model->created_by = Auth::user()->id;
                        $menu_model->save();
                    

                    DB::commit();
                    Session::flash('message', 'Menu is added Successfully!');
                    $status = $input['status'];

                    if ($status == 'active') {
                        return redirect('admin-menu-index');   
                    }else{
                        return redirect('admin-menu-cancellist');
                    }
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    exit();
                    Session::flash('danger', $e->getMessage());
                }
        }else{
            Session::flash('error', 'Already Exists');    
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
        $ModuleTitle = "Menu Information";
        $pageTitle = "Update Menu";

        // Find news
        $data = Menu::where('id', $id)->first();
        
        // Return view
        return view("Menu::menu.edit", compact('data','pageTitle','ModuleTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MenuRequest $request, $id)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();
        // INPUT ASE KI NA
        if(isset($input)){

            $model = menu::where('menu.id',$id)->first();

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
                    Session::flash('message', 'Menu is update Successfully!');
                    $status = $input['status'];

                    if ($status == 'active') {
                        return redirect('admin-menu-index');   
                    }else{
                        return redirect('admin-menu-cancellist');
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
    public function cancel($id)
    {
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('menu')->where('menu.id',$id);
                $data->update([
                        'status' => 'cancel',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Menu added cancel list !');
                return redirect('admin-menu-cancellist');

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
        $pageTitle = "List of Cancel Menu";
        $ModuleTitle = "Menu Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = Menu::whereIn('status', array('cancel','inactive'))
                ->orderby('id','desc')
                ->get();


        // return view
        return view("Menu::menu.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('menu')->where('menu.id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-menu-index');

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

                $data = DB::table('menu')->where('menu.id',$id);
                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-menu-cancellist');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }
}
