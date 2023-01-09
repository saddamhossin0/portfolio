<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(){
        return view('protfolio.admin.portfolio.portfolio_add');
    }
    public function store(Request $request){
// dd($request->all);
        $portfolio = new Portfolio();
        $portfolio->name = $request->name;
        $portfolio->description = $request->description;
        if($request->file('portfolio_img')){
            $file= $request->file('portfolio_img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $portfolio_img= $filename;
        }

        $portfolio->portfolio_img = $portfolio_img;
        $portfolio->save();
        return response($portfolio);

    }
    public function Show(){
        $portfolio_show = Portfolio::all();
        return response($portfolio_show);
    }
}
