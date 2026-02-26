<?php

namespace App\Http\Controllers\Back;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\UpdateVideoRequest;
use App\Http\Requests\Back\StoreVideoRequest;

class VideoController extends Controller
{
    public function index()
    {
        Gate::authorize('view-any', Video::class);
        $videos = Video::latest('id')->paginate();

        return view('back.videos.index', compact('videos'));
    }

    public function edit(int $id) {
        $video = Video::find($id);

        return view('back.videos.edit', compact('video'));
    }

    public function update(UpdateVideoRequest $request, int $id)
    {
        $video = Video::find($id);
        Gate::authorize('update', $video);

        $inputs = $request->safe()->except(['image']);

        $video->update($inputs);

        return redirect()->route('admin.videos.index');
    }

    public function create()
    {
        return view('back.videos.create');
    }

    public function published(int $id)
    {
        $video = Video::find($id);
        Gate::authorize('update', $video);

        $video->is_published = !$video->is_published;
        $video->save();

        return redirect()->back();
    }

    public function store(StoreVideoRequest $request)
   // public function store( Request $request)
    {

        Gate::authorize('create', Video::class);
        // dd($request->all());
        $inputs = $request->safe()->except(['image']);

        if ($request->hasFile('image')) {
        $inputs['image'] = $request->file('image')->store('images', 'public');
}

        Video::create($inputs);

        return redirect()->route('admin.videos.index');
    }

    public function destroy(int $id) {
        $video = Video::find($id);
        Gate::authorize('delete', $video);

        $video->delete();
        return redirect()->route('admin.videos.index');
    }
   
}
