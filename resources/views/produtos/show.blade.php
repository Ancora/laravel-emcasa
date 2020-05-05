<!DOCTYPE html>
@extends('layouts.app')
@section('title', $produto->title)
@section('content')
    <h1>Produto: {{$produto->title}}</h1>
    <div class="row">
        @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
        <div class="col-md-4">
        <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
        </div>
        @endif
        <div class="col-md-8">
            <ul>
                <li><strong>Código: </strong>: {{$produto->sku}}</li>
                <li><strong>Qtd: </strong>: {{$produto->quantity}}</li>
                <li><strong>Preço: </strong>: R$ {{number_format($produto->price, 2, ',' , '.')}}</li>
                <li><strong>Adicionado em: </strong>: {{date('d/m/Y H:i', strtotime($produto->created_at))}}</li>
            </ul>
            <p>{{$produto->description}}</p>
        </div>
    </div>
    <div class="row">
        @foreach ($produto->mostrarComentarios as $comentario)
        <div class="card col-md-12">
            <div class="card-header">
                {{$comentario->user}}
            </div>
            <div class="card-body">
                {{$comentario->comment}}
            </div>
            <div class="card-footer">
                {{date('d/m/Y H:i', strtotime($comentario->created_at))}}
            </div>
        </div>
        @endforeach
    </div>
    <button class="btn btn-primary"><a href="javascript:history.go(-1)" style="color: whitesmoke;">Voltar</a></button>

@endsection
