<?php

namespace App\Modules\Settings\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modules\Settings\Models\Video;

use App\Modules\Settings\Requests;
use Illuminate\Support\Facades\Input;

use DB;
use Session;
// use Image;
use File;
// use Storage;
use App;
Use Auth;
class VideoController extends Controller
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
        $pageTitle = "List of Video Information";
        $ModuleTitle = "Video Information";


        // Get vedio data
        $data = Video::where('status','active')
                ->orderby('sort_order','asc')
                ->get();


        // return view
        return view("Settings::video.index", compact('pageTitle','ModuleTitle','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Add New Video";
        $ModuleTitle = "Video Information";

        // return View
        return view("Settings::video.create", compact('pageTitle','ModuleTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\VideoRequest $request)
    {
        // ALL INPUT STORE INPUT VARIAVLE
        $input = $request->all();

        
        
        // INPUT ASE KI NA
        if(isset($input)){
            // INPUT SLUG DIYE DB TE DATA ASE KI NA
            $data = Video::where('title',$input['title'])->exists();


            $name = $_FILES['video_image']['name'];
			$tmp_name = $_FILES['video_image']['tmp_name'];

			$avatar = $request->file('video_image');
			$image_extension = $avatar->getClientOriginalExtension();
			
			if (isset($name)) {
				$path= 'uploads/video/';
				$video = 'video'.'-'.$input['title'].'-'.time().'.'.$image_extension;
				
				if (!empty($name)){
					if(($image_extension == "jpeg") || ($image_extension == "png") || ($image_extension == "bmp") || ($image_extension == "jpg")){
						$image_upload = "success";
						$input['video_image'] = $video;
					}else{
						$image_upload = "fail";
					}
				}
			}

            if(!$data){
            // JODI INPUT ER SLUG DIYE DB TE DATA NA THEKE
            	if($image_upload == 'success'){
	            		/* Transaction Start Here */
	                DB::beginTransaction();
	                try {
	                    // Store cateogory data 
	                    if($input = Video::create($input))
	                    {
							move_uploaded_file($tmp_name, $path.$video);

	                        $input->created_by = Auth::user()->id;
	                        $input->save();
	                    }

	                    DB::commit();
	                    Session::flash('message', 'Video is added Successfully!');
	                    if ($input['status'] == 'active') {
	                  		return redirect('admin-frontvedio-index');
	                  	}else{
	                  		return redirect('admin-frontvedio-cancellist');
	                  	}
	                }catch (\Exception $e) {
	                    //If there are any exceptions, rollback the transaction`
	                    DB::rollback();
	                    print($e->getMessage());
	                    exit();
	                    Session::flash('danger', $e->getMessage());
	                }
            	}else{
            		Session::flash('error', 'The file extension must be .jpg,.jpeg,.png, .bmp in order to be uploaded !');    
                	return redirect()->back()->withInput();
            	}
            }else{
                Session::flash('error', 'This Video Title Already Exists !');    
                return redirect()->back()->withInput();
            }
        }
    }



    public function edit($id)
    {
        $pageTitle = "Update Video Information";
        $ModuleTitle = "Video Information";

        // Find news
        $data = Video::where('id', $id)->first();
        
        // Return view
        return view("Settings::video.edit", compact('data','pageTitle','ModuleTitle'));
    }

    public function update(Requests\VideoEditRequest $request, $id){

    	$input = $request->all();

    	$title = $input['title'];
    	$video = $input['video_image'];

        $validation = true;

        $data = Video::where('title',$input['title'])->first();
        $model = Video::where('id', $id)->first();


        if ($data) {
	        $db_id = $data['id'];
	    	$db_video = $data['video_image'];

        	if ($db_id == $id) {
        		$validation = true;
        	}else{
        		$validation = false;
        	}
        }else{
        	$db_video = $model['video_image'];
        	$validation = true;
        }


        if (!empty($video)) {

        	$input['video_image'] = $input['video_image'];
        	$name = $_FILES['video_image']['name'];
			$tmp_name = $_FILES['video_image']['tmp_name'];

			$avatar = $request->file('video_image');
			$image_extension = $avatar->getClientOriginalExtension();

			if(File::exists(public_path().'/uploads/video/'.$db_video)){
              File::delete(public_path().'/uploads/video/'.$db_video);
            }
			
			if (isset($name)) {
				$path= 'uploads/video/';
				$video = 'video'.'-'.$input['title'].'-'.time().'.'.$image_extension;
				
				if (!empty($name)){
					if(($image_extension == "jpeg") || ($image_extension == "png") || ($image_extension == "bmp") || ($image_extension == "jpg")){
						$image_upload = "success";
						$input['video_image'] = $video;
					}else{
						$image_upload = "fail";
					}
				}
			}
        }else{
        	$input['video_image'] = $db_video;
			$image_upload = "success";
        }

        //echo "<pre>";
        //print_r($input['video_image']);
        if ($validation) {
        	if ($image_upload == "success") {
        	/* Transaction Start Here */
                DB::beginTransaction();
                try {
                    // Store cateogory data 
                     $result = $model->update($input);

                    if($result)
                    {
                    	move_uploaded_file($tmp_name, $path.$video);
                        $model->updated_by =  Auth::user()->id;
                        $model->save();
                    }

                    DB::commit();
                    Session::flash('message', 'Video is update Successfully!');
                    if ($input['status'] == 'active') {
                  		return redirect('admin-frontvedio-index');
                  	}else{
                  		return redirect('admin-frontvedio-cancellist');
                  	}
                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    print($e->getMessage());
                    Session::flash('danger', $e->getMessage());
                    return redirect()->back();
                }
        	}else{
            		Session::flash('error', 'The file extension must be .jpg,.jpeg,.png, .bmp in order to be uploaded !');    
                	return redirect()->back()->withInput();
            	}
        	
        }else{
        	Session::flash('error', 'Video title already exists ! ');    
                	return redirect()->back()->withInput();
        }

    }


    public function cancellist(){
    	$pageTitle = "List of Video Information";
        $ModuleTitle = "Video Information";

        $Cancel = 'Cancel';

        
        // Get Parent category data
        $data = Video::whereIn('status', array('cancel','inactive'))
                ->orderby('id','desc')
                ->get();


        // return view
        return view("Settings::video.index", compact('pageTitle','ModuleTitle','data','Cancel'));
    }


    public function destroy($id)
    {
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('video')->where('id',$id);
                $data->update([
                        'status' => 'cancel',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Video added cancel list !');
                return redirect('admin-frontvedio-cancellist');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }
    }


    public function rollback($id){
        /* Transaction Start Here */
            DB::beginTransaction();
            try {

                $data = DB::table('video')->where('id',$id);
                $data->update([
                        'status' => 'active',
                        'updated_by' => Auth::user()->id,
                    ]);
                DB::commit();
                Session::flash('message', 'Roll Back Successfully !');
                return redirect('admin-frontvedio-index');

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

                $data = Video::where('id', $id)->first();
                

                if(File::exists(public_path().'/uploads/video/'.$data['video_image'])){
	              	File::delete(public_path().'/uploads/video/'.$data['video_image']);
	            }

                $data->delete();
                DB::commit();
                Session::flash('message', 'Delete Successfully !');
                return redirect('admin-frontvedio-cancellist');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                print($e->getMessage());
                exit();
                Session::flash('danger', $e->getMessage());
            }

    }
    
}
