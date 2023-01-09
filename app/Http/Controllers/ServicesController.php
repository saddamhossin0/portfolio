<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(){
        return view('protfolio.admin.services.service_add');
    }
    public function store(Request $request){


        $services = new Service();
        $services->title = $request->title;
        $services->name = $request->name;
        $services->service = $request->service;
        $services->save();
        return response($services);

    }
    public function Show(){
        $services_show = Service::all();
        return response($services_show);
    }
}
