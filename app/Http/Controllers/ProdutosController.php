<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::all();
        return view('produtos.index', array('produtos' => $produtos));
    }

    public function show($id)
    {
        $produtos = Produtos::find($id);
        echo '<pre>';
        print_r($produtos);
        echo '</pre>';
    }
}
