<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return view('protfolio.admin.about.about_add');
    }
    public function store(Request $request){


        $about = new About();
        $about->title = $request->title;
        $about->name = $request->name;

        if($request->file('about_img')){
            $file= $request->file('about_img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $about_img= $filename;
        }
        // dd($about_img);
        $about->about_img =$about_img;
        $about->save();
        return response($about);



    }
}
