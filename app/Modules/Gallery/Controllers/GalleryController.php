<?php

namespace App\Modules\Gallery\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Models\Gallery;
use App\Modules\Gallery\Requests\GalleryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    /**
     * Display a list of folders with image counts.
     */
    public function folderList()
    {
        $folders = Gallery::whereNotNull('folder')
            ->select('folder', DB::raw('COUNT(*) as image_count'))
            ->groupBy('folder')
            ->orderBy('folder')
            ->get();

        return view("Gallery::gallery.folders", compact('folders'));
    }

    /**
     * Show all active images within a folder.
     */
    public function index(string $folder)
    {
        $pageTitle   = "Gallery List";
        $ModuleTitle = "{$folder} Gallery";

        $data = Gallery::where([
            ['status', 'active'],
            ['folder', $folder],
        ])
            ->orderByDesc('id')
            ->get();

        return view("Gallery::gallery.index", compact('pageTitle', 'ModuleTitle', 'data'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        $pageTitle   = "Add Gallery Image";
        $ModuleTitle = "Gallery Management";

        $folders = Gallery::whereNotNull('folder')->distinct()->pluck('folder', 'folder');

        return view("Gallery::gallery.create", compact('pageTitle', 'ModuleTitle', 'folders'));
    }

    /**
     * Store new gallery image.
     */
    public function store(GalleryRequest $request)
    {
        $input = $request->validated();

        // Folder sanitization
        $folder = $request->folder === 'new_folder'
            ? trim(preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->new_folder))
            : $request->folder;

        $uploadDir = public_path('uploads/gallery/');
        if (!File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        $input['folder']      = $folder;
        $input['image_date']  = now()->format('d-m-Y');
        $input['image_day']   = now()->format('l');
        $input['image_month'] = now()->format('F');
        $input['image_year']  = now()->format('Y');
        $input['image_time']  = now()->format('h:i:sa');
        $input['status']  = 'active';
        $input['created_by']  = Auth::id();

        if ($request->hasFile('image_link')) {
            $file     = $request->file('image_link');
            $filename = preg_replace('/\s+/', '', $input['title']).'-'.time().'.'.$file->getClientOriginalExtension();

            Image::make($file)
                ->resize(600, 400)
                ->save($uploadDir.$filename);

            $input['image_link'] = $filename;
        }

        DB::beginTransaction();

        try {
            Gallery::create($input);
            DB::commit();

            Session::flash('message', 'Gallery added successfully!');
            return redirect()->route('admin.gallery.index', $folder);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Gallery Store Error: '.$e->getMessage());
            Session::flash('danger', 'Error saving gallery. Please try again.');
            return back()->withInput();
        }
    }

    /**
     * Edit existing gallery.
     */
    public function edit($id)
    {
        $pageTitle   = "Edit Gallery Image";
        $ModuleTitle = "Gallery Management";

        $data = Gallery::findOrFail($id);
        $folders = Gallery::whereNotNull('folder')->distinct()->pluck('folder', 'folder');

        return view("Gallery::gallery.edit", compact('pageTitle', 'ModuleTitle', 'data', 'folders'));
    }

    /**
     * Update gallery.
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $input   = $request->validated();

        $folder = $request->folder === 'new_folder'
            ? trim(preg_replace('/[^A-Za-z0-9_\-]/', '_', $request->new_folder))
            : $request->folder;

        $uploadDir = public_path('uploads/gallery/');
        if (!File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        if ($request->hasFile('image_link')) {
            if ($gallery->image_link && File::exists($uploadDir.$gallery->image_link)) {
                File::delete($uploadDir.$gallery->image_link);
            }

            $file     = $request->file('image_link');
            $filename = preg_replace('/\s+/', '', $input['title']).'-'.time().'.'.$file->getClientOriginalExtension();

            Image::make($file)
                ->resize(600, 400)
                ->save($uploadDir.$filename);

            $input['image_link'] = $filename;
        }

        $input['folder'] = $folder;
        $gallery->update($input);

        Session::flash('message', 'Gallery updated successfully!');
        return redirect()->route('admin.gallery.index', $folder);
    }

    /**
     * Move gallery to inactive.
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            Session::flash('danger', 'Gallery not found.');
            return back();
        }

        $gallery->update([
            'status'     => 'inactive',
            'updated_by' => Auth::id(),
        ]);

        Session::flash('warning', 'Gallery moved to inactive list!');
        return redirect()->route('admin.gallery.inactive');
    }

    /**
     * List inactive galleries.
     */
    public function inactivelist()
    {
        $pageTitle   = "Inactive Gallery";
        $ModuleTitle = "Gallery Management";
        $Cancel      = 'Cancel';

        $data = Gallery::where('status', 'inactive')
            ->orderByDesc('updated_at')
            ->get();

        return view("Gallery::gallery.index", compact('pageTitle', 'ModuleTitle', 'data', 'Cancel'));
    }

    /**
     * Rollback (reactivate) gallery.
     */
    public function rollback($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->update([
            'status'     => 'active',
            'updated_by' => Auth::id(),
        ]);

        Session::flash('message', 'Gallery restored successfully!');
        return redirect()->route('admin.gallery.inactive');
    }

    /**
     * Permanently delete gallery.
     */
    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);

        $path = public_path('uploads/gallery/'.$gallery->image_link);
        if (File::exists($path)) {
            File::delete($path);
        }

        $gallery->delete();

        Session::flash('message', 'Gallery permanently deleted.');
        return redirect()->route('admin.gallery.inactive');
    }
}
