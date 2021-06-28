@extends('layout.base')

@section('titulo', 'Visualizar cliente')

@section('conteudo')

@foreach($dados_cliente as $cliente)
<div class="row">
  <div class="col-sm-12 col-md-6 form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" name="nome" id="nome" value="{{$cliente->nome}}" readonly>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-6 form-group">
    <label for="email">E-mail</label>
    <input type="email" class="form-control" name="email" id="email" value="{{$cliente->email}}" readonly>
  </div>
  <div class="col-sm-12 col-md-2 form-group">
    <label for="telefone">Telefone</label>
    <input type="tel" class="form-control mascara" name="telefone" id="telefone" value="{{$cliente->telefone}}" readonly>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-2 form-group">
    <label for="cep">CEP</label>
    <input type="text" class="form-control mascara" name="cep" id="cep" value="{{$cliente->cep}}" readonly>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-10 form-group">
    <label for="logradouro">Logradouro</label>
    <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$cliente->logradouro}}" readonly>
  </div>
  <div class="col-sm-12 col-md-2 form-group">
    <label for="numero">Número</label>
    <input type="number" class="form-control" name="numero" id="numero" value="{{$cliente->numero}}" readonly>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 col-md-3 form-group">
    <label for="complemento">Complemento</label>
    <input type="text" class="form-control" name="complemento" id="complemento" value="{{$cliente->complemento}}" readonly>
  </div>
  <div class="col-sm-12 col-md-3 form-group">
    <label for="bairro">Bairro</label>
    <input type="text" class="form-control" name="bairro" id="bairro" value="{{$cliente->bairro}}" readonly>
  </div>
  <div class="col-sm-12 col-md-3 form-group">
    <label for="cidade">Cidade</label>
    <input type="text" class="form-control" name="cidade" id="cidade" value="{{$cliente->cidade}}" readonly>
  </div>
  <div class="col-sm-12 col-md-3 form-group">
    <label for="estado">Estado</label>
    <input type="text" class="form-control" name="estado" id="estado" value="{{$cliente->estado}}" readonly>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 form-group">
    <a href="{{route('clientes_get')}}" class="btn btn-secondary float-left">Voltar</a>
    <a href="{{route('clientes_alterar_get')}}?cliente={{$cliente->id}}" class="btn btn-primary float-right">Alterar</a>
  </div>
</div>
@endforeach

@stop

@section('importacoes_css')

@stop

@section('importacoes_js')

@stop