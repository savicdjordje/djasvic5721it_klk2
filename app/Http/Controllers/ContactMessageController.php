<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function create()
    {
        return view('contact_messages.contact');
    }

    public function createSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        return redirect()->back()->with('success', 'Poruka je uspešno poslata!');
    }

    public function list()
    {
        $active = ContactMessage::where('archived', false)->latest()->get();
        $archived = ContactMessage::where('archived', true)->latest()->get();

        return view('contact_messages.list', [
            'active' => $active,
            'archived' => $archived
        ]);
    }


    public function delete($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact-messages.list')->with('success', 'Poruka je obrisana.');
    }

    public function archive($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->archived = true;
        $msg->save();

        return back()->with('success', 'Poruka arhivirana.');
    }

    public function unarchive($id)
    {
        $msg = ContactMessage::findOrFail($id);
        $msg->archived = false;
        $msg->save();

        return back()->with('success', 'Poruka aktivirana.');
    }

}
