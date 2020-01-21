<?php

namespace App\Modules\Web\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\BreakingNews\Models\BreakingNews;
use App\Modules\News\Models\News;
use App\Modules\News\Models\NewsTag;

use App\Modules\Menu\Models\Menu;
use App\Modules\Menu\Models\MenuItem;


use App\Modules\Category\Models\Category;
use App\Modules\Settings\Models\Video;




class WebController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {	
    	$headerMenu = MenuItem::join('menu','menu.id','=','menu_item.menu_id')
                ->join('category', 'category.id', '=', 'menu_item.category_id')
                ->where('menu.name','header_menu')
                ->select('menu.name as name','category.title as title','menu_item.*','category.id as category_id')
                ->orderby('menu_item.short_order','asc')
                ->get();


    	$BreakingNews = BreakingNews::where('status','active')
                ->orderby('id','desc')
                ->limit(3)
                ->get();

        // echo "<pre>";
        // print_r($BreakingNews);
        // exit();

        $FeatureNewsLeft = Category::join('news', 'news.category_id', '=', 'category.id')
                ->join('users', 'users.id', '=', 'news.created_by')
        		->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                ->where('news.status','active')
                ->where('newsplace.place','শীর্ষ সংবাদ')
                ->where('newsplace.order', '!=',0)
                ->select('category.title as category_title','news.*','users.name as username')
                ->orderby('newsplace.order','asc')
                ->limit(1)
                ->get();

        $FeatureNewsRight = Category::join('news', 'news.category_id', '=', 'category.id')
                ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                ->where('news.status','active')  
                ->where('newsplace.place','শীর্ষ সংবাদ')
                ->where('newsplace.order', '!=',0)
                ->select('category.title as category_title','news.*')
                ->orderby('newsplace.order','asc')
                ->skip(1)
                ->take(2)
                ->get();

        $RecentNews = News::where('news.status','active')
                ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                ->where('newsplace.place','শীর্ষ সংবাদ তালিকা')
                ->where('newsplace.order', '!=',0)
                ->select('news.*')
                ->orderby('newsplace.order','asc')
                ->take(6)
                ->get();

        $PopulerNews = Category::join('news', 'news.category_id', '=', 'category.id')
        		->join('users', 'users.id', '=', 'news.created_by')
                ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                ->where('newsplace.place','জনপ্রিয় সংবাদ')
                ->where('newsplace.order', '!=',0)
                ->where('news.status','active')
                ->select('category.title as category_title','news.*','users.name as username')
                ->orderby('newsplace.order','asc')
                // ->skip(9)
                ->take(4)
                ->get();

        $MostPopulerNews = News::where('news.status','active')
                ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                ->where('newsplace.place','সারাদেশ')
                ->where('newsplace.order', '!=',0)
                ->select('news.*')
                ->orderby('newsplace.order','asc')
                // ->skip(13)
                ->take(6)
                ->get();

        // $EditorsPick = News::where('news.status','active')
		      //           ->select('news.*')
		      //           ->inRandomOrder()
		      //           ->limit(9)
		      //           ->get();
        $EditorsPick = News::where('news.status','active')
                        ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                        ->where('newsplace.place','সম্পাদকের পছন্দ')
                        ->where('newsplace.order', '!=',0)
                        ->select('news.*')
                        ->orderby('newsplace.order','asc')
                        ->limit(9)
                        ->get();
        $RandomCategoryNews = News::where('status','active')
                        ->join('newsplace', 'newsplace.news_id', '=', 'news.id')
                        ->where('newsplace.place','অর্থনীতি')
                        ->where('newsplace.order', '!=',0)
                        ->select('news.*')
                        ->orderby('newsplace.order','asc')
                        ->limit(5)
                        ->get();

		// $RandomCategory = Category::where('status','active')
		// 				->select('category.id','category.title')
		//                 ->inRandomOrder()
		//                 ->limit(1)
		//                 ->get();

		// foreach ($RandomCategory as $value) {
		// 	$CategoryId = $value->id;
		// 	$CategoryName = $value->title;
		// }


		// $RandomCategoryNews = Category::join('news', 'news.category_id', '=', 'category.id')
  //               ->where('news.status','active')
  //               ->where('news.category_id',$CategoryId)
  //               ->select('news.*')
  //               ->inRandomOrder()
  //               ->limit(5)
  //               ->get();

        $VedioNews = Video::where('status','active')
        			->select('video.*')
	                ->inRandomOrder()
	                ->limit(3)
	                ->get();

	                

	    //echo "<pre>";
	    //print_r($VedioNews);
	    //exit();

        return view("Web::home.index",compact(
        	'headerMenu',
        	'BreakingNews',
        	'FeatureNewsLeft',
        	'FeatureNewsRight',
        	'RecentNews',
        	'PopulerNews',
        	'MostPopulerNews',
        	'EditorsPick',
        	'RandomCategory',
        	'RandomCategoryNews',
        	'VedioNews'
        ));
    }

    // public function login(){
    //     return view("Admin::auth.login");
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singel_news($id)
    {
    	$BreakingNews = BreakingNews::where('status','active')
                ->orderby('id','desc')
                ->limit(3)
                ->get();

        $headerMenu = MenuItem::join('menu','menu.id','=','menu_item.menu_id')
                ->join('category', 'category.id', '=', 'menu_item.category_id')
                ->where('menu.name','header_menu')
                ->select('menu.name as name','category.title as title','menu_item.*')
                ->orderby('menu_item.short_order','asc')
                ->get();

        $news_data = News::join('category', 'category.id', '=', 'news.category_id')
        			->join('users', 'users.id', '=', 'news.created_by')
                    ->where('news.id', $id)
                    ->select('category.title as category_title','news.*','users.name as username')
                    ->first();
        
        $news_category_id = $news_data->category_id;
        //echo $news_category_id;
        $news_id = [$id,''];
        $CategoryNews = News::join('category', 'category.id', '=', 'news.category_id')
        			->join('users', 'users.id', '=', 'news.created_by')
                    ->where('news.category_id', $news_category_id)
                    ->select('category.title as category_title','news.*','users.name as username')
                	->orderby('news.id','desc')
                	->whereNotIn('news.id', array($news_id))
                	->limit(4)
                    ->get();
         // get tag
        $news_tags = NewsTag::join('tag', 'tag.id', '=', 'news_tag.tag_id')
                        ->where('news_id',$id)
                        ->select('tag.title')
                        ->get();

        $RecentNews = News::where('news.status','active')
                ->select('news.*')
                ->orderby('news.id','desc')
                ->skip(3)
                ->take(6)
                ->get();

        $MostPopulerNews = News::where('news.status','active')
                ->select('news.*')
                ->orderby('news.id','desc')
                ->skip(13)
                ->take(6)
                ->get();

        return view("Web::home.singelnews",compact('headerMenu','BreakingNews','news_data','news_tags','RecentNews','MostPopulerNews','CategoryNews'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function category_news($id)
    {
        $news_data = News::join('category', 'category.id', '=', 'news.category_id')
        			->join('users', 'users.id', '=', 'news.created_by')
                    ->where('category.id', $id)
                    ->select('category.title as category_title','news.*','users.name as username')
                	->orderby('news.id','desc')

                    ->limit(4)
                    ->get();
        $no_found = 0;
        if (count($news_data)>0) {
        	foreach ($news_data as $value) {
        		$categoryName = $value['category_title'];
        	}
        }else{
        	$categoryName = Category::select('title')
        						->where('id',$id)
        						->get();

        	foreach ($categoryName as $value) {
        		$categoryName = $value['title'];   
        		$no_found = $categoryName.' বিষয় শ্রেণীতে কোন খবর পাওয়া যায়নি !'; 	
        	}
        }
        
        $RecentNews = News::where('news.status','active')
                ->select('news.*')
                ->orderby('news.id','desc')
                ->skip(3)
                ->take(6)
                ->get();

        $BreakingNews = BreakingNews::where('status','active')
                ->orderby('id','desc')
                ->limit(3)
                ->get();

        $headerMenu = MenuItem::join('menu','menu.id','=','menu_item.menu_id')
                ->join('category', 'category.id', '=', 'menu_item.category_id')
                ->where('menu.name','header_menu')
                ->select('menu.name as name','category.title as title','menu_item.*')
                ->orderby('menu_item.short_order','asc')
                ->get();

        

        $PopulerNews = Category::join('news', 'news.category_id', '=', 'category.id')
        		->join('users', 'users.id', '=', 'news.created_by')
                ->where('news.status','active')
                ->select('category.title as category_title','news.*','users.name as username')
                #->inRandomOrder()
                ->orderby('news.id','desc')

                ->skip(9)
                ->take(4)
                ->get();

        $MostPopulerNews = News::where('news.status','active')
                ->select('news.*')
                ->orderby('news.id','desc')
                ->skip(13)
                ->take(6)
                ->get();

        $EditorsPick = News::where('news.status','active')
		                ->select('news.*')
		                ->inRandomOrder()
		                ->limit(9)
		                ->get();


		$RandomCategory = Category::where('status','active')
						->select('category.id','category.title')
		                ->inRandomOrder()
		                ->limit(1)
		                ->get();

		foreach ($RandomCategory as $value) {
			$CategoryId = $value->id;
			$CategoryName = $value->title;
		}


		$RandomCategoryNews = Category::join('news', 'news.category_id', '=', 'category.id')
                ->where('news.status','active')
                ->where('news.category_id',$CategoryId)
                ->select('news.*')
                ->inRandomOrder()
                ->limit(5)
                ->get();

        return view("Web::categorynews.index",compact(
        	'news_data',
        	'categoryName',
        	'RecentNews','BreakingNews',
        	'headerMenu',
        	'MostPopulerNews',
        	'PopulerNews',
        	'no_found',
        	'EditorsPick',
        	'RandomCategory',
        	'RandomCategoryNews'
        ));

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
