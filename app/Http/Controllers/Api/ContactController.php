<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use App\Contact;

class ContactController extends Controller
{
    // Save contacts on db and notify with email
    public function store(Request $request)
    {
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }


        $data = $request->all();


        // New instance on db
        $new_contact = new Contact();

        // Populating new instance
        $new_contact->fill($data);

        // Save
        $new_contact->save();

        // Send email
        Mail::to('admin@site.com')->send(new ContactMessage($data));

        return response()->json($data);
    }
}
