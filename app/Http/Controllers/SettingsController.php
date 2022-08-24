<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Settings $settings)
    {
        $row = Settings::all();
        foreach ($row as $rows) {
            $settings[$rows['settings_key']] = $rows['settings_value'];
        }
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {

        $data = $request->data;

        foreach ($data as $key => $value) {
            $key = trim($key);
            $value = trim($value);

            $settings->where('settings_key', $key)->update([
                'settings_value' => $value
            ]);
        }

        if ($request->has('logo')) {
            $fileOriginalName = $request->file('logo')->getClientOriginalExtension();
            $image = time() . '.' . $fileOriginalName;
            $request->logo->storeAs('image', $image, 'public');
            $settings->where('settings_key', 'website_logo')->update([
                'settings_value' => $image
            ]);
        }

        if ($request->has('favicon')) {
            $fileOriginalNames = $request->file('favicon')->getClientOriginalExtension();
            $favicon = time() . '.' . $fileOriginalNames;
            $request->favicon->storeAs('image', $favicon, 'public');

            $settings->where('settings_key', 'favicon')->update([
                'settings_value' => $favicon
            ]);
        }

        if ($request->has('vc_image')) {
            $fileOriginalName_vc = $request->file('vc_image')->getClientOriginalExtension();
            $vc_image = time(). '.'. $fileOriginalName_vc;
            $request->vc_image->storeAs('image', $vc_image, 'public');

            $settings->where('settings_key', 'vc_image')->update([
                'settings_value' => $vc_image
            ]);
        }

        if ($request->has('constitution')) {
            $fileOriginalNames = $request->file('constitution')->getClientOriginalExtension();
            $constitution = time() . '.' . $fileOriginalNames;
            $request->constitution->storeAs('constitution', $constitution, 'public');

            $settings->where('settings_key', 'constitution')->update([
                'settings_value' => $constitution
            ]);
        }

        if ($request->has('other_logo')) {
            $fileOriginalNames = $request->file('other_logo')->getClientOriginalExtension();
            $other_logo = time() . '.' . $fileOriginalNames;
            $request->other_logo->storeAs('image', $other_logo, 'public');

            $settings->where('settings_key', 'other_logo')->update([
                'settings_value' => $other_logo
            ]);
        }

        return redirect(route('settings.index'))->with('message', 'Settings Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Settings $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
