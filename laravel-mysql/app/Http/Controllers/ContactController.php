<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validated = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'message' => 'required',
            ]);
            try {
                Contact::create($validated);
                return redirect('/contact')->with('mensagem', "Message sent successfully, thanks for contacting us");
            } catch (Exception $e) {
                error_log($e->__toString());
                return redirect('/contact')->withErrors(['It was not possible to send your message'])->withInput();
            }
        }
        return view('contact');
    }
}
