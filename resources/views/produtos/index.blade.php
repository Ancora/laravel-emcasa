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
        @foreach ($produtos as $produto)
        <div class="card col-md-3">
            @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
            <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail card-img-top">
            @endif
            <div class="card-body">
                <h5 class="text-center"><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->title}}</a></h5>
                <div class="mb-3">
                    <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-info btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-3">
            @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
            <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
            @endif
            <h5 class="text-center"><a href="{{URL::to('produtos')}}/{{$produto->id}}">{{$produto->title}}</a></h5>
            <div class="mb-3">
                <form method="POST" action="{{action('ProdutosController@destroy', $produto->id)}}">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <a href="{{URL::to('produtos/' . $produto->id . '/edit')}}" class="btn btn-info btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            </div>
        </div> --}}
        @endforeach
    </div>
@endsection

