<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Validator;
use Input;
use File;

use App\User;
use App\Category;
use App\Page;

class PageController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-link',
        'page_title' => 'Page',
        'page_desc'  => 'Homepage'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $pages = Page::all();

        $parentPages = Page::lists('title', 'id');
        return view('page.index', $this->data)->withPages($pages);
        //dd($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $pages = Page::lists('title', 'id');
        $authors = User::lists('name', 'id');
        return view('page.create', $this->data)
                ->withPages($pages)
                ->withAuthors($authors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validation
        $rules = [
            'title' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'featured_image' => 'mimes:png,jpg,jpeg,bmp',
            'post_type' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            // $image = $request->file('featured_image');
            // dd($image->getClientOriginalName());
            $input = array (
                'title' => $request->input('title'),
                'user_id' => $request->input('user_id'),
                'parent_id' => $request->input('parent_id'),
                'content' => $request->input('content'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : "",
                'post_type' => $request->input('post_type')
            );

            // Save and Get returned Inserted ID
            $post_id = Page::create($input)->id;

            if ($request->file('featured_image') != null) {
                // Upload Featured Image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/page/', $imageName);
            }

            Session::flash('flash_message', 'Page successfully added!');
            return redirect()->back();
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
        $page = Page::find($id);

        return view('page.show', $this->data)
                ->withPage($page);
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
        $page = Page::find($id);
        if ($page->children != null) {
            $pages = Page::where('id', '!=', $id)
                    ->where('id', '!=', $page->children['id'])
                    ->lists('title', 'id');
        } else {
            $pages = Page::where('id', '!=', $id)
                    ->lists('title', 'id');
        }

        $pages[0] = 'Select Parent Page';
        $authors = User::lists('name', 'id');

        return view('page.edit', $this->data)
                ->withPage($page)
                ->withAuthors($authors)
                ->withPages($pages);
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
        $page = Page::findOrFail($id);

        // Validation
        $rules = [
            'title' => 'required',
            'user_id' => 'required',
            'content' => 'required',
            'featured_image' => 'mimes:png,jpg,jpeg,bmp',
            'post_type' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            // $image = $request->file('featured_image');
            // dd($image->getClientOriginalName());
            $input = array (
                'title' => $request->input('title'),
                'user_id' => $request->input('user_id'),
                'parent_id' => ($request->input('parent_id') == 0) ? null : $request->input('parent_id'),
                'content' => $request->input('content'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : $page->featured_image,
                'post_type' => $request->input('post_type')
            );

            // dd($input);

            // Save and Get returned Inserted ID
            $page->fill($input)->save();

            if ($request->file('featured_image') != null) {
                // Upload Featured Image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/page/', $imageName);
            }

            Session::flash('flash_message', 'Page successfully updated!');
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
        $page = Page::findOrFail($id);
        $page->delete();

        $this->removeImage($page->featured_image);

        Session::flash('flash_message', 'Page successfully deleted!');
        return redirect()->back();
    }

    public function removeImage($imageName) {
        File::Delete(base_path() . '/public/images/page/' . $imageName);

        return redirect()->back();
    }
}
