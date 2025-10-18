<?php

namespace App\Modules\Gallery\Controllers;

use App\Modules\Gallery\Requests\GalleryRequest;
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

    public function folderList()
    {
        // Get all unique folders and count of images
        $folders = Gallery::select('folder')
            ->whereNotNull('folder')
            ->selectRaw('COUNT(*) as image_count')
            ->groupBy('folder')
            ->orderBy('folder', 'asc')
            ->get();

        return view("Gallery::gallery.folders", compact('folders'));
    }


    public function index($folder)
    {
        $pageTitle = "List of Gallery Information";
        $ModuleTitle = "Gallery Information";


        // Get gallery  data
        $data = Gallery::where('status','active')
            ->where('folder',$folder)
                ->select('*')
                ->orderby('id','desc')
                ->get();

        return view("Gallery::gallery.index", compact('pageTitle','ModuleTitle','data'));
    }


    public function create()
    {
        $pageTitle = "Add Gallery Information";
        $ModuleTitle = "Gallery Information";
        $folders = Gallery::select('folder')->whereNotNull('folder')->distinct()->pluck('folder','folder');

        return view("Gallery::gallery.create", compact('pageTitle','ModuleTitle','folders'));
    }

    public function store(GalleryRequest $request)
    {
        $input = $request->all();
        $name = preg_replace('/\s+/', '', $input['title']);

        // Decide folder
        $folder = $request->folder === 'new_folder' ? trim($request->new_folder) : $request->folder;

        // Create folder if new
        $folder_path = public_path('uploads/gallery/');
        if(!file_exists($folder_path)){
            mkdir($folder_path, 0755, true);
        }

        $input['folder'] = $folder;
        $input['image_date'] = date("d-m-Y");
        $input['image_day'] = date("l");
        $input['image_month'] = date("F");
        $input['image_year'] = date("Y");
        $input['image_time'] = date("h:i:sa");

        if($request->hasFile('image_link')){
            $avatar = $request->file('image_link');
            $gallery_img_title = $name.'-'.time().rand(5).'.'.$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(600, 400)->save($folder_path . '/' . $gallery_img_title);
            $input['image_link'] = $gallery_img_title;
        }

        DB::beginTransaction();
        try {
            $gallery_data = Gallery::create($input);
            DB::commit();

            Session::flash('message', 'Gallery added successfully!');
            return redirect()->route('admin.gallery.index');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
    public function edit($id)
    {
        $pageTitle = "Update Gallery Information";
        $ModuleTitle = "Gallery Information";

        // Find news
        $data = Gallery::where('id', $id)
                        ->select('*')
                        ->first();
        $folders = Gallery::select('folder')->whereNotNull('folder')->distinct()->pluck('folder','folder');

        return view("Gallery::gallery.edit", compact('pageTitle','ModuleTitle','data','folders'));
    }


    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $input = $request->all();

        $folder = $request->folder === 'new_folder' ? trim($request->new_folder) : $request->folder;

        $folder_path = public_path('uploads/gallery/');
        if(!file_exists($folder_path)){
            mkdir($folder_path, 0755, true);
        }

        if($request->hasFile('image_link')){
            // Delete old image
            $old_image = $gallery->image_link;
            if(file_exists(public_path('uploads/gallery/'.$old_image))){
                unlink(public_path('uploads/gallery/'.$old_image));
            }

            $image = $request->file('image_link');
            $image_name = preg_replace('/\s+/', '', $input['title']).'-'.time().rand(5).'.'.$image->getClientOriginalExtension();
            $image->move($folder_path, $image_name);
            $input['image_link'] = $image_name;
        }

        $input['folder'] = $folder;

        $gallery->update($input);

        Session::flash('message', 'Gallery updated successfully!');
        return redirect()->route('admin.gallery.index');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $gallery = DB::table('gallery')->where('id', $id);

            if ($gallery->exists()) {
                $gallery->update([
                    'status' => 'inactive',
                    'updated_by' => Auth::user()->id,
                ]);

                DB::commit();
                Session::flash('warning', 'Gallery moved to Inactive List!');
            } else {
                DB::rollBack();
                Session::flash('danger', 'Gallery not found.');
            }

            return redirect()->route('admin.gallery.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', $e->getMessage());
            return redirect()->back();
        }
    }


    public function inactivelist()
    {
        $pageTitle = "List of Inactive Gallery";
        $ModuleTitle = "Gallery Information";
        $Cancel = 'Cancel';

        // Fetch all inactive galleries
        $data = Gallery::where('status', 'inactive')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Pass to view
        return view("Gallery::gallery.index", compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }


    public function rollback($id)
    {
        DB::beginTransaction();
        try {
            // Find the gallery
            $gallery = Gallery::findOrFail($id);

            // Update status to active
            $gallery->status = 'active';
            $gallery->updated_by = Auth::user()->id;
            $gallery->save();

            DB::commit();

            Session::flash('message', 'Gallery rolled back successfully!');
            return redirect()->route('admin.gallery.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            // Find the gallery
            $gallery = Gallery::findOrFail($id);

            // Delete the image file if it exists
            $imagePath = public_path('uploads/gallery/' . $gallery->image_link);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // Delete the record
            $gallery->delete();

            DB::commit();
            Session::flash('message', 'Gallery deleted successfully!');
            return redirect()->route('admin.gallery.inactive');

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('danger', 'Error: ' . $e->getMessage());
            return redirect()->back();
        }
    }

}
