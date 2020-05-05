<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatosController extends Controller
{
    public function index()
    {
        $data['title'] = 'Contato';
        return view('contato', $data);
    }

    public function enviar(Request $request)
    {
        // colocar validação dos campos
        $dadosEmail = array(
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'msg' => $request->input('msg')
        );

        Mail::send('email.contato', $dadosEmail, function ($message) {
            $message->from('atendimento@ancora-ti.com.br', 'Formulário de Contato');
            $message->to('atendimento@ancora-ti.com.br');
            $message->subject('Contato via Site');
        });

        return redirect('contatos')->with('success', 'Mensagem enviada com sucesso!');
    }
}
