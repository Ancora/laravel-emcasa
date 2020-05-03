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
        $produto = Produtos::find($id);
        return view('produtos.show', array('produto' => $produto));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sku' => 'required|unique:produtos|min:3',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        $produto = new Produtos();
        $produto->sku = $request->input('sku');
        $produto->title = $request->input('title');
        $produto->description = $request->input('description');
        $produto->quantity = $request->input('quantity');
        $produto->price = $request->input('price');

        if ($produto->save()) {
            return redirect('produtos/create')->with('success', 'Produto ' . $produto->title . ' cadastrado com sucesso!');
        }
    }

    public function edit($id)
    {
        $produto = Produtos::find($id);
        return view('produtos.edit', compact('produto', 'id'));
    }

    public function update(Request $request, $id)
    {
        $produto = Produtos::find($id);

        $this->validate($request, [
            'sku' => 'required|min:3',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric'
        ]);

        if ($request->hasFile('image')) {
            $imagem = $request->file('image');
            $nomearquivo = md5($id) . '.' . $imagem->getClientOriginalExtension();
            $request->file('image')->move(public_path('./img/produtos/'), $nomearquivo);
        }

        $produto->sku = $request->get('sku');
        $produto->title = $request->get('title');
        $produto->description = $request->get('description');
        $produto->quantity = $request->get('quantity');
        $produto->price = $request->get('price');

        if ($produto->save()) {
            return redirect('produtos/' . $id . '/edit')->with('success', 'Produto ' . $produto->title . ' alterado com sucesso!');
        }
    }
}
