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
    <tr>
      <td>Arthur Souza Andrade</td>
      <td>arthursandrade@icloud.com</td>
      <td>(16) 3311-6413</td>
      <td>
        <a href="#" class="btn btn-primary" title="Alterar"><i class="fas fa-pen"></i></a>
        <a href="#" class="btn btn-secondary" title="Visualizar"><i class="fas fa-eye"></i></a>
        <a href="#" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <tr>
      <td>Arthur Souza Andrade</td>
      <td>arthursandrade@icloud.com</td>
      <td>(16) 3311-6413</td>
      <td>
        <a href="#" class="btn btn-primary" title="Alterar"><i class="fas fa-pen"></i></a>
        <a href="#" class="btn btn-secondary" title="Visualizar"><i class="fas fa-eye"></i></a>
        <a href="#" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <tr>
      <td>Arthur Souza Andrade</td>
      <td>arthursandrade@icloud.com</td>
      <td>(16) 3311-6413</td>
      <td>
        <a href="#" class="btn btn-primary" title="Alterar"><i class="fas fa-pen"></i></a>
        <a href="#" class="btn btn-secondary" title="Visualizar"><i class="fas fa-eye"></i></a>
        <a href="#" class="btn btn-danger" title="Remover"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
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