<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Admin side
    // contact list
    public function userContactList(){
        $contacts = Contact::paginate(5);
        return view('admin.user.contact',compact('contacts'));
    }
    // delete contact
    public function userContactDelete($id){
        Contact::where('id',$id)->delete();
        return back();
    }

    // detail contact
    public function userContactDetail($id){
        $contact = Contact::where('id',$id)->first();
        return view();
    }







    //User side
    //home page
    public function contactHomePage(){
        return view('user.contact.home');
    }

    //get contact data
    public function contactData(Request $request){
        $this->contactValidationCheck($request, 'create');
        $datas = $this->data($request);
        Contact::create($datas);
        return redirect()->route('user#contactHomePage');
    }




    // private function

    private function contactValidationCheck($request, $action)
    {
        $validationRules = [
            'name' => 'required|unique:products,name,',
            'email' => 'required',
            'message' => 'required',
        ];

        Validator::make($request->all(), $validationRules)->validate();
    }

    private function data($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }
}
