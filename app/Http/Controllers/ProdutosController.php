<?php

namespace App\Http\Controllers;

use App\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produtos::paginate(8);
        return view('produtos.index', array('produtos' => $produtos, 'pesquisar' => null));
    }

    public function show($id)
    {
        $produto = Produtos::find($id);
        return view('produtos.show', array('produto' => $produto));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('produtos.create');
        } else {
            return redirect('login');
        }
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

        /* TODO: upload de mais de uma imagem */
        $imagem = $request->file('image');
        $nomearquivo = md5($request->input('sku')) . '.' . $imagem->getClientOriginalExtension();
        $request->file('image')->move(public_path('./img/produtos/'), $nomearquivo);

        if ($produto->save()) {
            return redirect('produtos/create')->with('success', 'Produto ' . $produto->title . ' cadastrado com sucesso!');
        }
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $produto = Produtos::find($id);
            return view('produtos.edit', compact('produto', 'id'));
        } else {
            return redirect('login');
        }
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
            $nomearquivo = md5($produto->sku) . '.' . $imagem->getClientOriginalExtension();
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

    public function destroy($id)
    {
        $produto = Produtos::find($id);

        if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg')) {
            unlink('./img/produtos/' . md5($produto->sku) . '.jpg');
        }

        $prod = $produto->title;
        $produto->delete();
        return redirect()->back()->with('success', 'Produto ' . $prod . ' excluído com sucesso!');
    }

    public function search(Request $request)
    {
        $pesquisaInput = $request->input('search');
        $produtos = Produtos::where('title', 'LIKE', '%' . $pesquisaInput . '%')
            ->orwhere('description', 'LIKE', '%' . $pesquisaInput . '%')
            ->paginate(8);
        return view('produtos.index', array('produtos' => $produtos, 'pesquisar' => $pesquisaInput));
    }
}
