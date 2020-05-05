@extends('layouts.app')
@section('title', 'Cadastrar Produto')
@section('content')
    <h1 class="mb-3">Cadastrar Produto</h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" enctype="multipart/form-data" action="{{route('produtos.store')}}">
        @csrf
        <div class="row">
            <div class="form-group mb-3 col-md-2">
                <label for="sku">Código (sku)</label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="Código ..." required>
            </div>
            <div class="form-group mb-3 col-md-6">
                <label for="title">Título</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome ..." required>
            </div>
        </div>
        <div class="row">
            <div class="form-group mb-3 col-md-12">
                <label for="description">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Breve descrição ..." required></textarea>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-2">
                <label for="quantity">Estoque</label>
                <input type="number" class="form-control" id="quantity" name="quantity" rows="3" placeholder="Estoque inicial ..." required>
            </div>
            <div class="mb-3 col-md-3">
                <label for="price">Preço</label>
                <div class="input-group">
                    <p class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">R$</span>
                    </p>
                    <input type="number" step=".01" class="form-control text-right" id="price" name="price" placeholder="0,00" required>
                </div>
            </div>
        </div>

         <div class="input-group mb-3">
             <label for="image">Imagem</label>
             <input type="file" class="form-control-file" id="image" name="image">
         </div>
	 	<button type="submit" class="btn btn-primary">Cadastrar Produto</button>
	</form>
@endsection

