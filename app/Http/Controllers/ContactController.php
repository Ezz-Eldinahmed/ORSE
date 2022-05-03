<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use \Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(ContactRequest $request): RedirectResponse
    {
        Contact::create($request->validated());
        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

    public function index()
    {
        return view('contact.index', ['contacts' => Contact::paginate(10)]);
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();
        return back()->with('success', 'Contact Deleted Successfully');
    }
}
