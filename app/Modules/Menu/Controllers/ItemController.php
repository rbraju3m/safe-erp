<?php

namespace App\Modules\Menu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuItem;
use App\Modules\Menu\Requests;
use Illuminate\Support\Facades\Input; 
use App\Modules\Category\Models\Category;
use App\Modules\Category\Models\CategorySelfRelation;

use DB;
use Session;
use App;
Use Auth;

class ItemController extends Controller
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
        $pageTitle = "List of Menu item Information";
        $ModuleTitle = "Menu item Information";

        
        // Get menu item data
        $data = MenuItem::join('menu','menu.id','=','menu_item.menu_id')
                ->join('category', 'category.id', '=', 'menu_item.category_id')
                ->select('menu.menu_key as name','category.title as title','menu_item.*')
                ->orderby('menu_item.id','desc')
                ->get();
        // return view
        return view("Menu::menuitem.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Menu Item";
        $ModuleTitle = "Menu Item Information";

        // find child & parent relations
        $parent_category_options = Category::getHierarchyCategory('');

        // Get menu data
        $menudata = Menu::where('status','active')
                ->orderby('name','asc')
                ->get();

        // return View
        return view("Menu::menuitem.create", compact('menudata','pageTitle','ModuleTitle','parent_category_options'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\ItemRequest $request)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        $menu_position = $input['menu_id'];
        $menu = $input['category_id'];

        //echo $menu_position.' '. $menu;
        //exit();

        $menu_position_count = MenuItem::where('menu_id',$menu_position)->get();
       	$menu_position_count = count($menu_position_count);
        //echo $menu_position_count;
        if( $menu_position_count < 12){
        	$data = MenuItem::where('category_id',$menu)->where('menu_id',$menu_position)->exists();
	        // INPUT ASE KI NA
	        if(!$data){
	                /* Transaction Start Here */
	                DB::beginTransaction();
	                try {
	                    // Store menu data 
	                    if($input = MenuItem::create($input))
	                    {
	                        $input->created_by = Auth::user()->id;
	                        $input->save();
	                    }

	                    DB::commit();
	                    Session::flash('message', 'Menu Item is added Successfully!');
	                        return redirect('admin-menuitem-index');   
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
        }else{
        	Session::flash('error', 'Header Menu Max Menu hold 12 !');    
	        return redirect()->back()->withInput();
        }
        

        
    }


    public function edit($id)
    {
        $ModuleTitle = "Menuitem Information";
        $pageTitle = "Update Menuitem";

        // Find news
        $data = MenuItem::where('id', $id)->first();

        // find child & parent relations
        $parent_category_options = Category::getHierarchyCategory('');

        // Get menu data
        $menudata = Menu::where('status','active')
                ->orderby('name','asc')
                ->get();
        
        // Return view
        return view("Menu::menuitem.edit", compact('menudata','parent_category_options','data','pageTitle','ModuleTitle'));
    }

    public function update(Requests\ItemRequest $request, $id)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        // INPUT ASE KI NA
        if(isset($input)){

            $model = MenuItem::where('menu_item.id',$id)->first();

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
                    Session::flash('message', 'Menuitem is update Successfully!');
                   
                        return redirect('admin-menuitem-index');   
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


    public function delete($id){
         /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('menu_item')->where('menu_item.id',$id);
                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-menuitem-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }

}
