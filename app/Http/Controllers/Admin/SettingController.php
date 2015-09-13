<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Setting;

use Validator;
use Session;

class SettingController extends Controller
{
    protected $data = array(
        'page_icon'  => 'fa-cogs',
        'page_title' => 'Setting',
        'page_desc'  => 'General Setting'
    );

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $setting = Setting::findOrFail(1);
        return view('setting.index', $this->data)->withSetting($setting);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
        $setting = Setting::findOrFail($id);

        // Validation
        $rules = [
            'site_banner' => 'mimes:png,jpg,jpeg,bmp'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $input = array(
                'site_title' => $request->input('site_title'),
                'tagline' => $request->input('tagline'),
                'email_address' => $request->input('email_address'),
                'site_banner' => ($request->file('site_banner') != null) ? $request->file('site_banner')->getClientOriginalName() : $setting->site_banner,
            );

            $setting->fill($input)->save();

            if ($request->file('site_banner') != null) {
                // Upload Banner
                $imageName  = $request->file('site_banner')->getClientOriginalName();
                $request->file('site_banner')->move(base_path() . '/public/images/setting/', $imageName);
            }

            Session::flash('flash_message', 'Setting successfully updated!');
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
    }
}
