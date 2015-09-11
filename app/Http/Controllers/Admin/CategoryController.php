<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Session;

class CategoryController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-clone',
        'page_title' => 'Categories',
        'page_desc'  => 'Post Category'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('post_category.index', $this->data)->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('post_category.create', $this->data);
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
        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $input = $request->all();
        Category::create($input);

        Session::flash('flash_message', 'Category <strong>' . $request->input('category_name') . '</strong> successfully added!');

        return redirect()->back();
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
        $category = Category::find($id);
        return view('post_category.edit', $this->data)->withCategory($category);
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
        $category = Category::findOrFail($id);

        $this->validate($request, [
            'category_name' => 'required'
        ]);

        $input = $request->all();
        $category->fill($input)->save();

        Session::flash('flash_message', 'Category successfully updated!');
        return redirect()->back();
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
        $category = Category::findOrFail($id);
        $category->delete();
        
        Session::flash('flash_message', 'Category <strong>' . $category->category_name . '</strong> successfully deleted!');
        return redirect()->back();        
    }
}
