<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'messageContent' => $request->input('message'), // Изменено на messageContent
        ];

        Mail::send('emails.contact', $data, function ($message) use ($data) {
            $message->to('nichitapaingu123@icloud.com')
                    ->subject('Новое сообщение от ' . $data['name']);
        });

        return redirect('/pages/contact')->with('success', 'Ваше сообщение было успешно отправлено!');
        
    }
}
