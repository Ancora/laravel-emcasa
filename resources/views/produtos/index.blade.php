@extends('layouts.app')
@section('title', 'Lista de Produtos')
@section('content')
    <h1 class="text-center">Produtos</h1>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
    <div class="row no-gutters">
        <div class="col-md-3">
            <form method="POST" action="{{url('produtos/search')}}">
                @csrf
                <div class="input-group mb-3">
                <input type="text" class="form-control" id="search" name="search"
                    placeholder="Pesquisar Produto" value="{{$pesquisar}}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary">Pesquisar</button>
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
                <h6><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->title}}</a></h6>
            </div>
            @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
            <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto"
                class="img-fluid img-thumbnail">
            @endif
            <p class="card-text">R$ {{number_format($produto->price, 2, ',' , '.')}}</p>
            <p class="card-text">Estoque: {{$produto->quantity}}</p>
            <div class="mb-3">
                <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-primary btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    <p>{{$produtos->links()}}</p>
@endsection

