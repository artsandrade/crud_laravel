@extends('layout.base')

@section('titulo', 'Alterar cliente')

@section('conteudo')

@foreach($dados_cliente as $cliente)
<form id="form_alterar_cliente" method="POST">
  @csrf
  <div class="row">
    <div class="col-sm-12 col-md-6 form-group">
      <label for="nome">Nome <b>*</b></label>
      <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do cliente ..." value="{{$cliente->nome}}" autofocus>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-6 form-group">
      <label for="email">E-mail <b>*</b></label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Digite o e-mail do cliente ..." value="{{$cliente->email}}">
    </div>
    <div class="col-sm-12 col-md-2 form-group">
      <label for="telefone">Telefone</label>
      <input type="tel" class="form-control mascara" name="telefone" id="telefone" data-inputmask="'mask': '(99) 9999-9999'" value="{{$cliente->telefone}}">
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-2 form-group">
      <label for="cep">CEP <b>*</b></label>
      <input type="text" class="form-control mascara" name="cep" id="cep" aria-describedby="cepInfo" data-inputmask="'mask': '99999-999'" onchange="buscaEndereco()" value="{{$cliente->cep}}">
      <small id="cepInfo" class="form-text text-muted">Ao digitar seu CEP, o endereço será preenchido.</small>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-10 form-group">
      <label for="logradouro">Logradouro <b>*</b></label>
      <input type="text" class="form-control" name="logradouro" id="logradouro" value="{{$cliente->logradouro}}">
    </div>
    <div class="col-sm-12 col-md-2 form-group">
      <label for="numero">Número <b>*</b></label>
      <input type="number" class="form-control" name="numero" id="numero" value="{{$cliente->numero}}">
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 col-md-3 form-group">
      <label for="complemento">Complemento</label>
      <input type="text" class="form-control" name="complemento" id="complemento" value="{{$cliente->complemento}}">
    </div>
    <div class="col-sm-12 col-md-3 form-group">
      <label for="bairro">Bairro <b>*</b></label>
      <input type="text" class="form-control" name="bairro" id="bairro" value="{{$cliente->bairro}}">
    </div>
    <div class="col-sm-12 col-md-3 form-group">
      <label for="cidade">Cidade <b>*</b></label>
      <input type="text" class="form-control" name="cidade" id="cidade" value="{{$cliente->cidade}}" readonly>
    </div>
    <div class="col-sm-12 col-md-3 form-group">
      <label for="estado">Estado <b>*</b></label>
      <input type="text" class="form-control" name="estado" id="estado" value="{{$cliente->estado}}" readonly>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 form-group">
      <p class="form-text">É necessário preencher os campos marcados com <b>*</b> !</p>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12 form-group">
      <button type="button" class="btn btn-secondary float-left" onclick="validaFormulario()">Voltar</button>
      <button type="submit" class="btn btn-primary ml-1 float-right" id="btn_alterar">Alterar</button>
      <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#modal_confirmacao_limpar">Limpar</button>
    </div>
  </div>
</form>
@endforeach

<!-- Modal para confirmar se deseja limpar os campos -->
<div class="modal fade" id="modal_confirmacao_limpar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Limpar campos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você tem certeza que deseja limpar os campos do formulário?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-danger" onclick="limpaFormulario()" data-dismiss="modal">Limpar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal para confirmar se deseja voltar para página de clientes -->
<div class="modal fade" id="modal_confirmacao_voltar" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Voltar para clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Notamos que algum campo do formulário está preenchido. Você tem certeza que deseja voltar para a página de clientes? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <a href="{{route('clientes_get')}}" class="btn btn-primary">Voltar</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal com retorno sobre a alteração -->
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

@stop

@section('importacoes_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js" integrity="sha512-6Jym48dWwVjfmvB0Hu3/4jn4TODd6uvkxdi9GNbBHwZ4nGcRxJUCaTkL3pVY6XUQABqFo3T58EMXFQztbjvAFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Arquivo JS referente à página -->
<script src="{{asset('js/paginas/clientes/alterar.init.js')}}"></script>
@stop