<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Image;
use App\User;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Gallery::latest()->with('images','user','comments.user')->paginate(6);
    }

    public function userGalleries(User $user)
    {
        return $user->galleries()->with('images','comments')->latest()->get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // \Log::info($request->all());
        $gallery = new Gallery;
        $picture = new Image;
        $gallery->name = request()->input('name');
        $gallery->description = request()->input('description');
        $gallery->user_id = request()->input('user_id');       
        $gallery->save();

        foreach ($request->input('image_url') as $image) {
            // \Log::info($image);
            $gallery->images()->create(['image_url' => $image]);
        }
        return $gallery;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::with('user', 'images', 'comments.user')->findOrFail($id);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->update($request->all());
        return $gallery;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return $gallery;
    }

    public function indexId()
    {
        return Gallery::latest()->first();
    }

    public function search($term)
    {
    
        return Gallery::where('name', 'like', '%' . $term . '%')->with(['images', 'user'])->paginate(6);
    }
}