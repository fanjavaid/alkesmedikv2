<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Validator;
use Session;
use Input;
use File;

use App\Media;
use App\Category;

class MediaController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-photo',
        'page_title' => 'Media',
        'page_desc'  => 'Library'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $medias = Media::all();
        return view('media.index', $this->data)->withMedias($medias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $categories = Category::lists('category_name', 'id');
        return view('media.create', $this->data)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'mediafile'  => 'required|mimes:png,jpg,jpeg,bmp',
            'categories' => 'required'
        ];

        $categories     = $request->input('categories');

        $images         = $request->file('mediafile');
        $uploadCount    = 0;
        $fileCount      = count($images);
        foreach ($images as $image) {
            $validator = Validator::make(array('mediafile'=>$image, 'categories' => $categories), $rules);
            if ($validator->passes()) {
                $imageName      = $image->getClientOriginalName();
                $fileName       = str_slug(pathinfo($imageName, PATHINFO_FILENAME)); // file
                $extension      = pathinfo($imageName, PATHINFO_EXTENSION); // jpg
                $newImageName   = $fileName . '.' . $extension;

                $input = array(
                    'title'         => $newImageName, 
                    'path'          => $newImageName,
                    'url'           => '/images/media/' . $newImageName,
                    'description'   => ''
                );
                $mediaId = Media::create($input)->id;

                // Upload Media Image
                $image->move(base_path() . '/public/images/media/', $newImageName);

                // Save to Join Table
                Media::find($mediaId)->categories()->sync($categories);

                $uploadCount++;
            }
        }

        if ($uploadCount == $fileCount) {
            Session::flash('flash_message', 'Media successfully added!');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
        $media = Media::find($id);
        $categories = $media->categories;

        return view('media.show', $this->data)
                    ->withMedia($media)
                    ->withCategories($categories);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $media  = Media::findOrFail($id);
        $categories = Category::lists('category_name', 'id');

        return view('media.edit', $this->data)
                    ->withMedia($media)
                    ->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $media = Media::findOrFail($id);

        $rules = [
            'title'         => 'required',
            'categories'    => 'required'
        ];

        $categories = $request->input('categories');

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $media->fill($request->all())->save();

            // Sync
            Media::find($id)->categories()->sync($categories);

            Session::flash('flash_message', 'Media successfully updated!');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $media = Media::findOrFail($id);
        $media->delete();

        // Remove file
        File::Delete(base_path() . '/public' . $media->url);

        Session::flash('flash_message', '<strong>' . $media->title . '</strong> successfully deleted!');
        return redirect()->back();
    }
}
