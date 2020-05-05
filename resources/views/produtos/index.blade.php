@extends('layouts.app')
@section('title', 'Lista de Produtos')
@section('content')
    <h1 class="text-center">Produtos</h1>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
    <div class="row">
        <div class="col-md-4">
            <form method="POST" action="{{url('produtos/search')}}">
                @csrf
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" name="search"
                    placeholder="Pesquisar Produto" value="{{$pesquisar}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form method="POST" action="{{url('produtos/order')}}">
                @csrf
                <div class="input-group mb-3">
                <select name="order" id="order" class="form-control">
                    <option>Ordenar por:</option>
                    <option value="1" @if ($order == 1) selected @endif>Nome (A-Z)</option>
                    <option value="2" @if ($order == 2) selected @endif>Nome (Z-A)</option>
                    <option value="3" @if ($order == 3) selected @endif>Valor (Maior-Menor)</option>
                    <option value="4" @if ($order == 4) selected @endif>Valor (Menor-Maior)</option>
                </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary">Ordenar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p>{{$produtos->links()}}</p>
    <div class="row no-gutters">
        @foreach ($produtos as $produto)
        <div class="card col-sm-3 border-primary text-primary text-center" style="margin: 0.008 !important;">
            <div class="card-header">
                <h6><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->title}}</a>

                </h6>
            </div>
            @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
            <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto"
                class="img-fluid img-thumbnail">
            @endif
            <p class="card-text">
                R$ {{number_format($produto->price, 2, ',' , '.')}}
                @if ($produto->price == $maiscaro)
                    <span class="badge badge-danger">Maior Preço</span>
                @endif
                @if ($produto->price == $maisbarato)
                    <span class="badge badge-success">Menor Preço</span>
                @endif
            </p>
            @if ($produto->quantity == 0)
                <p class="card-text badge badge-warning">Produto indisponível</p>
            @else
                <p class="card-text">Estoque: {{$produto->quantity}}</p>
            @endif
            @if (Auth::check())
            <div class="mb-3">
                <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-primary btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    <p><strong>Valor médio dos produtos: </strong>R$ {{number_format($media, 2, ',' , '.')}}</p>
    <p><strong>Valor total dos produtos: </strong>R$ {{number_format($total, 2, ',' , '.')}}</p>
    <p><strong>Quantidade total de produtos: </strong>{{$qtd}}</p>
    <p>{{$produtos->links()}}</p>
@endsection

