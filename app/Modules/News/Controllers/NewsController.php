<?php

namespace App\Modules\News\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use App\Modules\Category\Models\Category;
use App\Modules\News\Models\News;
use App\Modules\Tag\Models\Tag;
use App\Modules\News\Models\NewsTag;
use App\Modules\News\Models\NewsPlace;
use App\Modules\Category\Models\CategorySelfRelation;

use App\Modules\News\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
use Image;
use File;
use Storage;
use App;
Use Auth;




class NewsController extends Controller
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
        $pageTitle = "List of News Information";
        $ModuleTitle = "News Information";

        
        // Get Parent category data
        $data = Category::join('news', 'news.category_id', '=', 'category.id')
                ->where('news.status','active')
                ->select('category.title as category_title','news.*')
                ->orderby('news.short_order','asc')
                ->orderby('news.id','desc')
                ->get();

        

        // return view
        return view("News::news.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New News";
        $ModuleTitle = "News Information";


        // find child & parent relations
        $parent_category_options = Category::getHierarchyCategory('');
        // Get tag Information
        $tags = Tag::orderBy('id','desc')
                            ->where('status','active') 
                            ->get();
        // return View
        return view("News::news.create", compact('tags','parent_category_options','pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\NewsRequest $request)
    {

        // Get all input data
        $input = $request->all();
        $user_data = Auth::user();
        
        $tags = $input['tag'];
        $places = $input['place'];

        // Check already slug presents or not
        $data = News::where('slug',$input['slug'])->exists();

        if(!$data )
        {
            // Check image file exists or not
                if($request->hasfile('image_link')){
                    // Image link 
                    $news_img = $request->file('image_link');
                    if(!empty($news_img)) {
                        $image_info = getimagesize($news_img);
                // check image dimension in width & height
                        if((isset($image_info['0']) && $image_info['0'] <= '1920') && isset($image_info['1']) && $image_info['1'] <= '1000'  ){
                            $size = $request->file('image_link')->getSize()/1024;
                            if($size < 1024)
                                {
                                    if($news_img) {
                                        $avatar = $request->file('image_link');
$news_img_title = $input['category_id'].'-'.time().'.'.$avatar->getClientOriginalExtension();
                                        Image::make($avatar)->resize(800, 400)->save( public_path('/uploads/news/' . $news_img_title) );

                                        }else{
                                            $news_img_title = '';
                                        }
                                    
                                }else{
                                    Session::flash('error', 'This Image size bigger than 1024KB');    
                                    return redirect()->back();
                                    }
                        $input['image_link'] = $news_img_title;
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
                if($news_data = News::create($input))
                {  
                    $news_data->save();

                    foreach ($tags  as $tag ) {
                        $model_tag = new NewsTag();
                        $model_tag->news_id = $news_data->id;
                        $model_tag->tag_id = $tag;
                        $model_tag->save();
                    }

                    foreach ($places  as $place ) {
                        $model_place = new NewsPlace();
                        $model_place->news_id = $news_data->id;
                        $model_place->place = $place;
                        $model_place->save();
                    }
                }

                DB::commit();
                Session::flash('message', 'News is added!');
                return redirect('admin-news-index');
                

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This News Slug Already Added!');
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
        $ModuleTitle = "News Information";
        $pageTitle = "News Details";

        // Find news 

        $data = News::join('category', 'category.id', '=', 'news.category_id')
                        ->where('news.id', $id)
                        ->select('news.*','category.title as cat_title')
                        ->first();

         // get tag
        $news_tags = NewsTag::join('tag', 'tag.id', '=', 'news_tag.tag_id')
                        ->where('news_id',$id)
                        ->select('tag.title')
                        ->get();

        
        // Return view
        return view("News::news.show", compact('news_tags','data','pageTitle','ModuleTitle'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ModuleTitle = "News Information";
        $pageTitle = "Update News";

        // Find news
        $data = News::where('news.id', $id)
                        ->select('news.*')
                        ->first();

        // get tag
        $product_tags = NewsTag::where('news_id',$id)
                        ->select('tag_id')
                        ->get();

        $news_place = NewsPlace::where('news_id',$id)
                        ->get();

        // Get tag Information
        $tags = Tag::orderBy('id','desc')
                            ->where('status','active') 
                            ->get();
        
        // If news not found                
        if(count($data) <= 0){
            Session::flash('danger', 'News not found.');
            return redirect()->route('admin.news.index');
        }else{
          // Find relations
            $category_self_relation = $data->relCategorySelfRelation;
            if(count($category_self_relation) > 0){
                $data->parent_category = $category_self_relation->parent_category_id;
            }

            // Get parent & child hierarchy
            $parent_category_options = Category::getHierarchyCategory($data->id, '');

            // Return view
            return view("News::news.edit", compact('product_tags','tags','data','parent_category_options','pageTitle','ModuleTitle','news_place'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\NewsRequest $request,$id)
    {
       $input = $request->all();
        
        // Find catgory
        $model = News::where('news.id', $id)
            ->select('news.*')
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
                    $news_img = $request->file('image_link');
                    if(!empty($news_img)) {
                        $image_info = getimagesize($news_img);
                // check image dimension in width & height
                        if((isset($image_info['0']) && $image_info['0'] <= '1920') && isset($image_info['1']) && $image_info['1'] <= '1000'  ){
                            $size = $request->file('image_link')->getSize()/1024;
                            if($size < 1024)
                                {
                                    if($news_img) {

                                        if (File::exists(public_path().'/uploads/news/'.$model->image_link)) {
                                            File::delete(public_path().'/uploads/news/'.$model->image_link);
                                        }

                                        $avatar = $request->file('image_link');
$news_img_title = $input['category_id'].'-'.time().'.'.$avatar->getClientOriginalExtension();

                                        Image::make($avatar)->resize(200, 200)->save( public_path('/uploads/news/' . $news_img_title) );

                                        }else{
                                            $news_img_title = '';
                                        }
                                    
                                }else{
                                    Session::flash('error', 'This Image size bigger than 1024KB');    
                                    return redirect()->back();
                                    }
                        $input['image_link'] = $news_img_title;
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
                // $model_tag = new NewsTag();

                $delete_model= DB::table('news_tag')
                        ->where('news_id',$id)
                        ->delete();
                

                $tags = $input['tag'];
                foreach ($tags  as $tag ) {
                        $model_tag = new NewsTag();
                        $model_tag->news_id = $id;
                        $model_tag->tag_id = $tag;
                        $model_tag->save();
                    }

                $delete_place = DB::table('newsplace')
                        ->where('news_id',$id)
                        ->delete();
                
                $places = $input['place'];
                foreach ($places  as $place ) {
                        $model_place = new NewsPlace();
                        $model_place->news_id = $id;
                        $model_place->place = $place;
                        $model_place->save();
                    }

                // Update parent category 
                if(isset($category_self_relation)){
                    $category_self_relation->child_category_id = $model->id;
                    $category_self_relation->save();
                }

                DB::commit();
            }

            Session::flash('message', 'Successfully updated!');
            return redirect('admin-news-index');
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
         /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('news')->where('news.id',$id);
                $data->update([
                        'status' => 'cancel',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'News added cancel list !');
                return redirect('admin-news-cancel-list');

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
        $pageTitle = "List of Cancel News";
        $ModuleTitle = "News Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = Category::join('news', 'news.category_id', '=', 'category.id')
                #->where('news.status','cancel')
                ->whereIn('news.status', array('cancel','inactive'))
                ->select('category.title as category_title','news.*')
                ->orderby('news.short_order','asc')
                ->get();


        // return view
        return view("News::news.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }

    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('news')->where('news.id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-news-index');

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

                $data = DB::table('news')->where('news.id',$id)->first();
                
                if (File::exists(public_path().'/uploads/news/'.$data->image_link)) {
                    File::delete(public_path().'/uploads/news/'.$data->image_link);
                }
                $data = DB::table('news')->where('news.id',$id);
                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-news-index');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }


    public function place($name){
        $pageTitle = $name." সংবাদ তালিকা";
        $ModuleTitle = $name." তথ্য";

        $data = NewsPlace::join('news', 'news.id', '=', 'newsplace.news_id')
                ->where('news.status','active')
                 ->where('newsplace.place',$name)
                ->select('news.*','newsplace.place','newsplace.id as place_id','newsplace.order')
                ->orderby('news.id','desc')
                ->get();
        return view("News::news.place", compact('pageTitle','ModuleTitle','data'));
        
    }

    public function add(Requests\PlaceRequest $request){
        $input = $request->all();

        $place['id'] = $input['id'];
        $place['order'] = $input['order'];
        $news_place_id = $place['id'];
        $all_update_order = $place['order'];
        // array to single row convert
        for ($index = 0 ; $index < count($news_place_id); $index ++) {
            $order_update = new NewsPlace();

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                $update_order =NewsPlace::where('id',$news_place_id[$index]);
                if (!empty($all_update_order[$index])) {
                    $update_order->update([
                        'order' => $all_update_order[$index],
                        'updated_by' => Auth::user()->id,
                    ]);
                }else{
                    $update_order->update([
                        'order' => '',
                        'updated_by' => Auth::user()->id,
                    ]);
                }
                
                DB::commit();
            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
        }
        Session::flash('message', 'Arrange update');
                return redirect()->back();
    }
}
