<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Attribute;
use App\Category;
use App\Product;
use Validator;
use Session;
use File;

class ProductController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-shopping-cart',
        'page_title' => 'Shop',
        'page_desc'  => 'Products'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return view('product.index', $this->data)->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $attributes = Attribute::all();
        $categories = Category::lists('category_name', 'id');
        return view('product.create', $this->data)->withAttributes($attributes)->withCategories($categories);
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
            'code' => 'required',
            'product_name' => 'required',
            'sku' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'categories' => 'required',
            'featured_image' => 'mimes:png,jpg,jpeg,bmp',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            // Get Input
            $input = array(
                'code' => $request->input('code'),
                'product_name' => $request->input('product_name'),
                'sku' => $request->input('sku'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'description' => $request->input('description'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : "",
            );
            $categories = $request->input('categories');
            $attributes = $request->input('attributes');

            /* Used to save in multiple value many-to-many
            | [ 0 => [ 1 => 100 ] ]
            | $speakers  = array(
            |     0 => 1,
            |     1 => 5,
            |     2 => 7
            | );
            | $pivotData = array_fill(0, count($speakers), ['is_speaker' => true]);
            | $syncData  = array_combine($speakers, $pivotData);
            | dd($syncData);
            | dd($attributes);
            */

            // Save and Get Inserted ID
            $product_id = Product::create($input)->id;

            if ($request->file('featured_image') != null) {
                // Upload featured image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/product/', $imageName);
            }

            // Save to Join Table
            Product::find($product_id)->categories()->sync($categories);
            Product::find($product_id)->attributes()->sync($attributes);

            Session::flash('flash_message', 'Product successfully added!');
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
        $product = Product::findOrFail($id);
        return view('product.show', $this->data)->withProduct($product);
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
        
        $product = Product::findOrFail($id);
        $categories = Category::lists('category_name', 'id');
        $attributes = Attribute::all();
        
        $attrElements = array();
        foreach ($attributes as $attr) {
            $element = array();
            if ($attr->type == 'text') {
                $element = array(
                    'id' => $attr->id,
                    'name' => $attr->attribute_name,
                    'type' => 'text',
                    'element' => "<input type='text' name='attributes[". $attr->id ."][value]' value='' class='form-control' />"
                );
            } else {
                $element = array(
                    'id' => $attr->id,
                    'name' => $attr->attribute_name,
                    'type' => 'editor',
                    'element' => "<textarea name='attributes[". $attr->id ."][value]' class='form-control'></textarea>"
                );
            }

            array_push($attrElements, $element);
        }

        foreach ($attrElements as &$attrEl) {
            foreach ($product->attributes as $pAttr) {
                if ($pAttr->id == $attrEl['id']) {
                    // echo $pAttr->id  . " == " . $attrEl['id'] . " ? " . ($pAttr->id == $attrEl['id']);
                    // echo "<br/>";
                    if ($attrEl['type'] == 'text') {
                        $attrEl['element'] = "<input type='text' class='form-control' name='attributes[". $attrEl['id'] ."][value]' value='" . $pAttr->pivot->value . "' />";
                    } else {
                        $attrEl['element'] = "<textarea name='attributes[". $attrEl['id'] ."][value]' class='form-control'>" . $pAttr->pivot->value . "</textarea>";
                    }
                }
            }
        }

        // dd($product->attributes);
        // dd($attrElements);
        return view('product.edit', $this->data)
                    ->withProduct($product)
                    ->with('attrElements', $attrElements)
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
        $product = Product::findOrFail($id);

        // Validation
        $rules = [
            'code' => 'required',
            'product_name' => 'required',
            'sku' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'categories' => 'required',
            'featured_image' => 'mimes:png,jpg,jpeg,bmp',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            // Get Input
            $input = array(
                'code' => $request->input('code'),
                'product_name' => $request->input('product_name'),
                'sku' => $request->input('sku'),
                'price' => $request->input('price'),
                'discount' => $request->input('discount'),
                'description' => $request->input('description'),
                'featured_image' => ($request->file('featured_image') != null) ? $request->file('featured_image')->getClientOriginalName() : $product->featured_image,
            );
            $categories = $request->input('categories');
            $attributes = $request->input('attributes');

            // Save and Get Inserted ID
            // $product_id = Product::create($input)->id;
            $product->fill($input)->save();

            if ($request->file('featured_image') != null) {
                // Upload featured image
                $imageName  = $request->file('featured_image')->getClientOriginalName();
                $request->file('featured_image')->move(base_path() . '/public/images/product/', $imageName);
            }

            // Save to Join Table
            Product::find($id)->categories()->sync($categories);
            Product::find($id)->attributes()->sync($attributes);

            Session::flash('flash_message', 'Product successfully updated!');
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
        $product = Product::findOrFail($id);
        $product->delete();

        // $this->removeImage($product->featured_image);
        Session::flash('flash_message', 'Product <strong>' . $product->product_name . '</strong> successfully deleted!');
        return redirect()->back();
    }

    public function removeImage($imageName) {
        File::Delete(base_path() . '/public/images/product/' . $imageName);

        return redirect()->back();
    }
}
