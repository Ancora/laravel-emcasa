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
}
