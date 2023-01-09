<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForntentController extends Controller
{
    public function index(){
        // $Contact_show = Contact::all();
        $Contact_show = DB::table('abouts')->first();
        $portfolio_show = DB::table('services')->first();
        $portfolio_show_contacts = DB::table('contacts')->orderBy('id', 'DESC')->first();
        $portfolio_show_carts = DB::table('services')->limit(4)->get();
        $portfolio_show_portfolios = DB::table('portfolios')->limit(6)->get();

        // dd( $portfolio_show_cart);
        // $about_show = About::all();
        // $portfolio_show = Portfolio::all();->limit(10)->get();

        $services_show = Service::all();
        return view('protfolio.frontent.protfolio_master',compact('portfolio_show_contacts','Contact_show','portfolio_show','portfolio_show_carts','portfolio_show_portfolios'));
    }


    public function store(Request $request){
        // dd($request->all());
        $Contact = new Contact();
        $Contact->full_name = $request->full_name;
        $Contact->phone = $request->phone;
        $Contact->email = $request->email;
        $Contact->messages = $request->messages;
        $Contact->save();
        return response($Contact);

    }
}
