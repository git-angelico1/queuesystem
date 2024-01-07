<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\video;

class VideoController extends Controller
{

    function upload()
    {
        $myvid=video::all();
        return view('upload',['myvid'=>$myvid]);

    }
    public function delete($id)
    {

        $video = video::find($id);
    
        if (!$video) {
            return redirect()->back()->with('error', 'Video not found');
        }
    
        
        $video->delete();
    
        return redirect()->back()->with('success', 'Video deleted successfully');
    } 

    function fetch()
    {
        $data=video::all()->toArray();
        return view('videos',compact('data'));  

    }
    function insert(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,ogx,avi,ogv,oga,ogg,webm'
        ]);
        $existingVideo = Video::first();
        if ($existingVideo) {
            return redirect()->back()->withErrors(['video' => 'You can only upload one video.']);
        }

        $file=$request->file('video');
        $file->move('upload1',$file->getClientOriginalName());
        $file_name=$file->getClientOriginalName();

        $insert = new video();
        $insert->video = $file_name;
        $insert->save();

        return redirect('upload');

    }
    public function liveMonitor()
    {
        $data=video::all()->toArray(); 
        return view('Monitor.index', compact('data'));
    }
    public function a4tech()
    { 
        return view('Monitor.studview');
    }
}
