<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Attribute;
use Validator;
use Session;
// use Input;

class AttributeController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-shopping-cart',
        'page_title' => 'Shop',
        'page_desc'  => 'Product\'s Attribute'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $attributes = Attribute::all();
        return view('product_attribute.index', $this->data)->withAttributes($attributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('product_attribute.create', $this->data);
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
            'attribute_name' => 'required',
            'type' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $input = $request->all();
            Attribute::create($input);

            Session::flash('flash_message', 'Attribute successfully added!');
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
        $attribute = Attribute::findOrFail($id);

        return view('product_attribute.edit', $this->data)->withAttribute($attribute);
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
        $attribute = Attribute::findOrFail($id);

        $rules = [
            'attribute_name' => 'required',
            'type' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $input = $request->all();
            $attribute->fill($input)->save();

            Session::flash('flash_message', 'Attribute successfully updated!');
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
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        Session::flash('flash_message', 'Attribute successfully deleted!');
        return redirect()->back();
    }
}
