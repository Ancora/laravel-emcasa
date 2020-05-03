@extends('layouts.app')
@section('title', 'Editar Produto - ' . $produto->title)
@section('content')
    <h1 class="mb-3">Editar Produto - {{$produto->title}}</h1>
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
    <form method="POST" enctype="multipart/form-data" action="{{action('ProdutosController@update', $id)}}">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
		<div class="form-group mb-3">
		    <label for="sku">Código (sku)</label>
            <input type="text" class="form-control" id="sku" name="sku" value="{{$produto->sku}}" placeholder="Código ..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="title">Título</label>
		    <input type="text" class="form-control" id="title" name="title" value="{{$produto->title}}" placeholder="Nome ..." required>
	 	</div>
	 	<div class="form-group mb-3">
		    <label for="description">Descrição</label>
		   	<textarea class="form-control" id="description" name="description" rows="3" placeholder="Breve descrição ..." required>
                {{$produto->description}}
            </textarea>
         </div>
         <div class="form-group mb-3">
		    <label for="quantity">Estoque</label>
		   	<input type="number" class="form-control" id="quantity" name="quantity" value="{{$produto->quantity}}" rows="3" placeholder="Estoque inicial ..." required>
	 	</div>
	 	<label for="price">Preço</label>
	 	<div class="input-group mb-3">
		    <div class="input-group-prepend">
		    	<span class="input-group-text" id="basic-addon1">R$</span>
            </div>
            {{-- TODO: number_format do preço: como fazer? --}}
		    <input type="number" step=".01" class="form-control" id="price" name="price" value="{{$produto->price}}" placeholder="0,00" required>
        </div>
        <div class="row">
        @if (file_exists('./img/produtos/' . md5($produto->sku) . '.jpg'))
        <div class="col-md-4">
        <img src="{{url('img/produtos/' . md5($produto->sku) . '.jpg')}}" alt="Imagem Produto" class="img-fluid img-thumbnail">
        </div>
        @endif
        <div class="col-md-8">
            <div class="input-group mb-3">
                <label for="image">Alterar Imagem</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
        </div>
	 	<button type="submit" class="btn btn-info">Alterar Produto</button>
	</form>
@endsection

