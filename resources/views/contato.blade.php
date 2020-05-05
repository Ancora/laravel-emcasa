@extends('layouts.app')
@section('title', 'Fale Conosco')
@section('content')
    <h1 class="mb-3">Fale Conosco</h1>
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
    <form method="POST" action="{{url('contatos/enviar')}}">
        @csrf
        <div class="row">
            <div class="form-group mb-3 col-md-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome ..." required>
            </div>
            <div class="form-group mb-3 col-md-4">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail ..." required>
            </div>
        </div>

        <div class="row">
            <div class="form-group mb-3 col-md-6">
                <label for="subject">Assunto</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto ..." required>
            </div>
        </div>

	 	<div class="form-group mb-3">
		    <label for="msg">Descrição</label>
		   	<textarea class="form-control" id="msg" name="msg" rows="6" placeholder="Mensagem ..." required></textarea>
        </div>
	 	<button type="submit" class="btn btn-primary">Enviar</button>
	</form>
@endsection

