@extends('layout.base')

@section('titulo', 'Clientes')

@section('conteudo')

<div class="row">
  <div class="col-sm-12 form-group">
    <a href="{{route('clientes_cadastrar_get')}}" class="btn btn-success float-right">Cadastrar cliente</a>
  </div>
</div>

<table id="tabela" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Nome</th>
      <th>E-mail</th>
      <th width="100px">Telefone</th>
      <th width="120px">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($clientes as $cliente)
    <tr>
      <td>{{$cliente->nome}}</td>
      <td>{{$cliente->email}}</td>
      <td>{{$cliente->telefone}}</td>
      <td>
        <a href="{{route('clientes_alterar_get')}}?cliente={{$cliente->id}}" class="btn btn-primary" title="Alterar"><i class="fas fa-pen"></i></a>
        <a href="{{route('clientes_visualizar_get')}}?cliente={{$cliente->id}}" class="btn btn-secondary" title="Visualizar"><i class="fas fa-eye"></i></a>
        <a href="#" class="btn btn-danger" title="Remover" onclick="modal_remover('{{$cliente->nome}}', '{{$cliente->id}}')"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
      <th>Nome</th>
      <th>E-mail</th>
      <th width="100px">Telefone</th>
      <th width="120px">Ações</th>
    </tr>
  </tfoot>
</table>

<!-- Modal para confirmar se deseja remover cliente -->
<div class="modal fade" id="modal_confirmacao_remover" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Remover cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="mensagem_remover"></p>
      </div>
      <div class="modal-footer">
        <form action="javascript:void(0)" method="POST">
          @csrf
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-danger" id="btn_remover" data-dismiss="modal">Remover</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal com retorno sobre o cadastro -->
<div class="modal fade" id="modal_retorno" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mensagem</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="mensagens_retorno">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@stop

@section('importacoes_css')
<!-- DataTables (CSS) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
@stop

@section('importacoes_js')
<!-- DataTables (JS) -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- Arquivo JS referente à página -->
<script src="{{asset('js/paginas/clientes/clientes.init.js')}}"></script>
@stop