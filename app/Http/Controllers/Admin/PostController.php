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
use App\Post;

class PostController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-pencil-square-o',
        'page_title' => 'Post',
        'page_desc'  => 'Blog Post'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('post.index', $this->data)->withPosts($posts);
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
        $authors = User::lists('name', 'id');
        return view('post.create', $this->data)->withCategories($categories)->withAuthors($authors);
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
            'categories' => 'required',
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
                'content' => $request->input('content'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : "",
                'post_type' => $request->input('post_type')
            );
            $categories = $request->input('categories');

            // Save and Get returned Inserted ID
            $post_id = Post::create($input)->id;

            if ($request->file('featured_image') != null) {
                // Upload Featured Image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/post/', $imageName);
            }

            // Save to Join Table
            Post::find($post_id)->categories()->sync($categories);
            Session::flash('flash_message', 'Post successfully added!');
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
        $post = Post::find($id);
        $categories = $post->categories;

        return view('post.show', $this->data)->withPost($post)->withCategories($categories);
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
        $post = Post::find($id);

        $categories = Category::lists('category_name', 'id');
        $authors = User::lists('name', 'id');

        // dd($post->categories->lists('category_name','id'));

        return view('post.edit', $this->data)
                ->withPost($post)
                ->withCategories($categories)
                ->withAuthors($authors);
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
        // Get Edited value
        $post = Post::findOrFail($id);

        // Validation
        $rules = [
            'title' => 'required',
            'user_id' => 'required',
            'categories' => 'required',
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
                'content' => $request->input('content'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : $post->featured_image,
                'post_type' => $request->input('post_type')
            );
            $categories = $request->input('categories');

            // Save and Get returned Inserted ID
            $post->fill($input)->save();

            if ($request->file('featured_image') != null) {
                // Upload Featured Image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/post/', $imageName);
            }

            // Save to Join Table
            Post::find($id)->categories()->sync($categories);
            Session::flash('flash_message', 'Post successfully updated!');

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
        // Get edited value
        $post = Post::findOrFail($id);
        $post->delete();

        Session::flash('flash_message', 'Post successfully deleted!');
        return redirect()->back();
    }

    public function removeImage($imageName) {
        File::Delete(base_path() . '/public/images/post/' . $imageName);

        return redirect()->back();
    }
}
