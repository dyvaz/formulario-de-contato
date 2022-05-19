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
                return redirect('/contact')->with('mensagem', "Mensagem enviada com sucesso");
            } catch (Exception $e) {
                return redirect('/contact')->withErrors(['Não foi possível enviar sua mensagem']);
            }
        }

        return view('contact');
    }
}
