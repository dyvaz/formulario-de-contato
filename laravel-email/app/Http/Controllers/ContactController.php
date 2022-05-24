<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactEmail;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
                // enviar o email para o mailhog
                Mail::to('dy@dy.com')->send(new ContactEmail($validated['name'], $validated['email'], $validated['message']));
                return redirect('/contact')->with('mensagem', "Message sent successfully, thanks for contacting us");
            } catch (Exception $e) {
                error_log($e->__toString());
                return redirect('/contact')->withErrors(['It was not possible to send your message'])->withInput();
            }
        }
        return view('contact');
    }
}
