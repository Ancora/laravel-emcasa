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
    <a href="javascript:history.go(-1)">Voltar</a>
@endsection
