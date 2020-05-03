@extends('layout.app')
@section('title', 'Lista de Produtos')
@section('content')
    <h1 class="text-center">Produtos</h1>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif
    <div class="row">
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
    <div class="row">
        @foreach ($produtos as $produto)
        <div class="card col-md-3">
            @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
            <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail card-img-top">
            @endif
            <div class="card-body">
                <h5 class="text-center card-title"><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->title}}</a></h5>
                <div class="mb-3 row">
                    <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-info btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{$produtos->links()}}
@endsection

