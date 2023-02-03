<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\ToSweetAlert;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contacts.list', [
            'contacts' => Contacts::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'phone' => 'required|regex:/[0-9]{9}/',
        ];

        $messages = [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 5 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone is invalid',
        ];

        $validation = $request->validate($rules, $messages);

        if ($validation) {
            // Create a new contact
            $contact = new Contacts();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->save();

            //return redirect()->route('contacts.index');

            return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
        }else{
            return redirect()->route('contacts.create')->with('error', 'Contact creation failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $contact_show = Contacts::find($id);

        if (!$contact_show) {
            return redirect()->route('contacts.index')->with('error', 'Contact not found.');
        }

        return view('contacts.create', [
            'contact_show' => $contact_show
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $contacts)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contacts $contacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $contact = Contacts::find($id);
        
        if ($contact) {
            $contact->delete();
            return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
        }else{
            return redirect()->route('contacts.index')->with('error', 'Contact deletion failed.');
        }
    }
}
