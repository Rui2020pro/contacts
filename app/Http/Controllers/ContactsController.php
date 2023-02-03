<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\ToSweetAlert;
use RealRashid\SweetAlert\Facades\Alert;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contacts::all()->sortBy('id');

        return view('contacts.list', [
            'contacts' => $contacts
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
            'email' => 'required|email|unique:contacts',
            'phone' => 'required|regex:/[0-9]{9}/|unique:contacts',
        ];

        $messages = [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 5 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exists',
            'phone.required' => 'Phone is required',
            'phone.regex' => 'Phone is invalid',
            'phone.unique' => 'Phone already exists',
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

            Alert::success('Success', 'Contact created successfully.');

            // create an session flash message
            return redirect()->route('contacts.index');
        }else{
            Alert::error('Error', 'Contact not created.');
            return redirect()->route('contacts.create');
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
            Alert::error('Error', 'Contact not found.');
            return redirect()->route('contacts.index');
        }

        return view('contacts.create', [
            'contact_show' => $contact_show
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $contact_edit = Contacts::find($id);

        if (!$contact_edit) {
            Alert::error('Error', 'Contact not found.');
            return redirect()->route('contacts.index');
        }

        return view('contacts.create', [
            'contact_edit' => $contact_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param  \App\Models\Contacts  $contacts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $contact = Contacts::find($id);

        if (!$contact) {
            Alert::error('Error', 'Contact not found.');
            return redirect()->route('contacts.index');
        }

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
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->save();

            Alert::success('Success', 'Contact updated successfully.');

            return redirect()->route('contacts.index');
        }else{

            Alert::error('Error', 'Contact not updated.');

            return redirect()->route('contacts.edit', $id);
        }

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

            Alert::success('Success', 'Contact deleted successfully.');

            return redirect()->route('contacts.index');
           
            
        }else{

            Alert::error('Error', 'Contact not found.');

            return redirect()->route('contacts.index');
        }
    }
}
