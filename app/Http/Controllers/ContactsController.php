<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(){
        return view('protfolio.admin.contacts.contact_add');
    }
    public function store(Request $request){


        $Contact = new Contact();
        $Contact->full_name = $request->full_name;
        $Contact->phone = $request->phone;
        $Contact->email = $request->email;
        $Contact->messages = $request->messages;
        $Contact->save();
        return response($Contact);

    }
    public function Show(){
        $Contact_show = Contact::all();
        return response($Contact_show);
    }
}
