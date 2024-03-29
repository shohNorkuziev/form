<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\StoreRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index()
    {
        $image=Image::orderBy('created_at', 'desc')->get();
        $user = Auth::user();
        $data=[
            'naw'=>true,
            'background'=>$user->theme->image->path,
            'active'=>'image',
            'image'=>$image,
        ];
        return view('image.index')->with('data',$data);
    }

    public function create()
    {
        $user = Auth::user();
        $data=[
            'naw'=>true,
            'background'=>$user->theme->image->path,
        ];
        return view('image.create')->with('data',$data);
    }

    public function store(StoreRequest $request)
    {
        $path=$request->file('image')->store('/','public');
        Image::create(["path"=>$path]+$request->validated());

        return redirect()->route('indeximage');
    }

    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->path);

        $image->delete();

        return redirect()->route('indeximage');
    }
}
