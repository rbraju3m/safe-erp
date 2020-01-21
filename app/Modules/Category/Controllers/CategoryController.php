<?php

namespace App\Modules\Category\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Category\Models\Category;
use App\Modules\Category\Models\CategorySelfRelation;

use App\Modules\Category\Requests;

use DB;
use Session;
use Illuminate\Support\Facades\Input;

use Image;
use File;
use Storage;
use App;
Use Auth;

class CategoryController extends Controller
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
        $pageTitle = "List of Category Information";
        $ModuleTitle = "Category Information";

        
        // Get Parent category data
        $data = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                ->where('category_self_relation.parent_category_id',NULL)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.short_order','asc')
                ->get();


        // return view
        return view("Category::category.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Category";
        $ModuleTitle = "Category Information";


        // find child & parent relations
        $parent_category_options = Category::getHierarchyCategory('');

        // return View
        return view("Category::category.create", compact('parent_category_options','pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CategoryRequest $request)
    {   
        // Get all input data
        $input = $request->all();
        $user_data = Auth::user();
         

        // Check already presents or not
        $data = Category::where('slug',$input['slug'])->exists();

        if(!$data )
        {
            // Set parent cateogry id 
            if(isset($_POST['parent_category'])){
                $category_self_relation = new CategorySelfRelation();
                if($_POST['parent_category'] != ''){
                    $category_self_relation->parent_category_id = $_POST['parent_category'];
                }
                else{
                    $category_self_relation->parent_category_id = NULL;
                }
            }

            // Check image file exists or not
if($request->hasfile('image_link')){
                    // Image link 
$category_image = $request->file('image_link');
    if(!empty($category_image)) {
    $image_info = getimagesize($category_image);
                // check image dimension in width & height
    if((isset($image_info['0']) && $image_info['0'] <= '1920') && isset($image_info['1']) && $image_info['1'] <= '1000'  ){
    $size = $request->file('image_link')->getSize()/1024;
    if($size < 1024) {
        if($category_image) {
            $avatar = $request->file('image_link');
    $category_image_title = str_replace(' ', '-', $input['slug'] . '.' . $avatar->getClientOriginalExtension());
    Image::make($avatar)->resize(200, 200)->save( public_path('/uploads/category/' . $category_image_title) );

        }else{
    $category_image_title = '';
    }
   }else{
    Session::flash('error', 'This Image size bigger than 1024KB');    
       return redirect()->back();
}
 $input['image_link'] = $category_image_title;
         }else{
            Session::flash('error', 'Image size must be width 1920px & height 300px');    
            return redirect()->back();
                        }
                     }

                 }
            

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                // Store cateogory data 
                if($category_data = Category::create($input))
                {
                    $category_data->save();

                    // Store parent category & child category relation
                    if(isset($category_self_relation)){
                        $category_self_relation->child_category_id = $category_data->id;
                        $category_self_relation->save();
                    }

                }

                DB::commit();
                Session::flash('message', 'Category is added!');
                return redirect('admin-category-index');
                

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This category already added!');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pageTitle = 'View Category Informations';
        $ModuleTitle = "Category Information";

        // Find category data
        $data = Category::where('category.id', $id)
                ->select('category.*')
                ->first();                    

        if(!empty($data))
        {
            // If found category
            return view("Category::category.show", compact('data','pageTitle','ModuleTitle'));

        }else{
            // If category not found
            return redirect()->back();

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
        $ModuleTitle = "Category Information";
        $pageTitle = "Update Category";

        // Find category
        $data = Category::where('category.id', $id)
                        ->select('category.*')
                        ->first();

        // If category not found                
        if(count($data) <= 0){
            Session::flash('danger', 'Category not found.');
            return redirect()->route('admin.category.index');
        }

        // Find relations
        $category_self_relation = $data->relCategorySelfRelation;
        if(count($category_self_relation) > 0){
            $data->parent_category = $category_self_relation->parent_category_id;
        }

        // Get parent & child hierarchy
        $parent_category_options = Category::getHierarchyCategory($data->id, '');

        // Return view
        return view("Category::category.edit", compact('data','parent_category_options','pageTitle','ModuleTitle'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CategoryRequest $request, $id)
    {
        
        $input = $request->all();


        // Find catgory
        $model = Category::where('category.id', $id)
            ->select('category.*')
            ->first();

        // child parent relation    
        if(isset($_POST['parent_category'])){
            $category_self_relation = $model->relCategorySelfRelation;
            if(count($category_self_relation) == 0){
                $category_self_relation = new CategorySelfRelation();
            }

            if($_POST['parent_category'] != ''){
                $category_self_relation->parent_category_id = $_POST['parent_category'];
            }
            else{
                $category_self_relation->parent_category_id = NULL;
            }
        }

        // Check image file exists or not
                if($request->hasfile('image_link')){
                    // Image link 
                    $category_image = $request->file('image_link');
                    if(!empty($category_image)) {
                        $image_info = getimagesize($category_image);
                // check image dimension in width & height
                        if((isset($image_info['0']) && $image_info['0'] <= '1920') && isset($image_info['1']) && $image_info['1'] <= '1000'  ){
                            $size = $request->file('image_link')->getSize()/1024;
                            if($size < 1024)
                                {
                                    if($category_image) {

                                        if(File::exists(public_path().'/uploads/category/'.$model->image_link)){
                                              File::delete(public_path().'/uploads/category/'.$model->image_link);
                                            }

                                        $avatar = $request->file('image_link');
                                        $category_image_title = str_replace(' ', '-', $input['slug'] . '.' . $avatar->getClientOriginalExtension());
                                        Image::make($avatar)->resize(200, 200)->save( public_path('/uploads/category/' . $category_image_title) );

                                        }else{
                                            $category_image_title = '';
                                        }
                                    
                                }else{
                                    Session::flash('error', 'This Image size bigger than 1024KB');    
                                    return redirect()->back();
                                    }
                        $input['image_link'] = $category_image_title;
                        }else{
                            Session::flash('error', 'Image size must be width 1920px & height 300px');    
                            return redirect()->back();
                        }
                     }

                 }

        DB::beginTransaction();
        try {
            // Update category
            $result = $model->update($input);

            if($result){

                if($request->file('image_link') != null){
                    File::Delete($model->image_link);
                }
                $model->save();

                // Update parent category 
                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $model->id;
                    $category_self_relation->save();
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect('admin-category-index');
        }
        catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find category 

        $model = Category::where('category.id', $id)
            ->select('category.*')
            ->first();

        DB::beginTransaction();
        try {
            // Category update
            if($model->status =='active'){
                $model->status = 'cancel';
            }else{
                $model->status = 'active';
            }

           $model->save();
          
            DB::commit();
            Session::flash('message', "Successfully Deleted.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }
        
        // redirect to current page
        return redirect()->back();
    }

    public function sub_category($id)
    {
        $ModuleTitle = "Sub Category Information";

        $pageTitle = "List of Category Information";

        // Get Parent category data
        $data = Category::join('category_self_relation', 'category_self_relation.child_category_id', '=', 'category.id')
                ->where('category_self_relation.parent_category_id',$id)
                ->whereNotIn('category.status',['cancel'])
                ->select('category.*')
                ->orderby('category.short_order','asc')
                ->get();


        // return view
        return view("Category::category.index", compact('data','pageTitle','ModuleTitle'));
    }
}
