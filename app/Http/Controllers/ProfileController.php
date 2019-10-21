<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use File;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::orderBy('created_at', 'desc')->get();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'image' => 'required|image|max:20000',
            'screen_name' => 'required',
            'content' => 'required',
            'description' => 'required',
            'user_name' => 'required',
            'date' => 'required|date'
        ]);

        $attributes['date'] = Carbon::parse($request->date);
        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('profile_images', 'public');
        }
        Profile::create($attributes);
        return redirect('/')->with([
            'type' => 'success',
            'message' => 'Successfully Saved'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'image' => 'image|max:20000',
            'screen_name' => 'required',
            'content' => 'required',
            'description' => 'required',
            'user_name' => 'required',
            'date' => 'required|date'
        ]);

        $attributes['date'] = Carbon::parse($request->date);
        if ($request->hasFile('image')) {
            if (File::exists(storage_path('app/public/' . $profile->image))) {
                File::delete(storage_path('app/public/' . $profile->image));
            }
            $attributes['image'] = $request->file('image')->store('profile_images', 'public');
        }

        $profile->update($attributes);

        return redirect('/')->with([
            'type' => 'success',
            'message' => 'Successfully Updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        if (File::exists(storage_path('app/public/' . $profile->image))) {
            File::delete(storage_path('app/public/' . $profile->image));
        }

        $profile->delete();

        return redirect('/')->with([
            'type' => 'error',
            'message' => 'تمت حذف الفاعلية بنجاح'
        ]);
    }
}
