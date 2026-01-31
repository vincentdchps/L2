<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
   public function index()
{

    $videos = \App\Models\Video::paginate(10);
    
    return view('videos.index', compact('videos'));
}
}
