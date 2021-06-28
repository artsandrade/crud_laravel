/* Preenchimento de endereço, bairro, cidade e estado através da API VIA CEP */
function buscaEndereco() {
  const $campoCep = document.querySelector('[id="cep"]');
  const $campoLogradouro = document.querySelector('[id="logradouro"]');
  const $campoBairro = document.querySelector('[id="bairro"]');
  const $campoCidade = document.querySelector('[id="cidade"]');
  const $campoEstado = document.querySelector('[id="estado"]');

  const cep = $campoCep.value;

  document.getElementById('mensagens_retorno').innerHTML = '';
  var mensagem = document.createElement('p');
  mensagem.innerText = 'Estamos localizando o endereço com base no CEP digitado!';
  document.getElementById('mensagens_retorno').appendChild(mensagem);
  $('#modal_retorno').modal('show');
  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(respostaDoServer => {
      return respostaDoServer.json();
    })
    .then(dadosDoCep => {
      if (dadosDoCep.erro == true) {

        setTimeout(function () {
          $('#modal_retorno').modal('hide');
        }, 2000);
        document.getElementById('mensagens_retorno').innerHTML = '';
        var mensagem = document.createElement('p');
        mensagem.innerText = 'CEP inválido!';
        document.getElementById('mensagens_retorno').appendChild(mensagem);
        $('#modal_retorno').modal('show');

      }
      else {

        $campoCidade.value = dadosDoCep.localidade;
        $campoEstado.value = dadosDoCep.uf;
        $campoLogradouro.value = dadosDoCep.logradouro;
        $campoBairro.value = dadosDoCep.bairro;
        setTimeout(function () {
          $('#modal_retorno').modal('hide');
        }, 2000)

      }
    });

}

/* Máscara para campos de CEP e telefone */
$(document).ready(function () { $(".mascara").inputmask() });

/* Valida formulário para permitir voltar */
function validaFormulario() {

  var form = $('#form_cadastrar_cliente');
  var valida = 0;

  for (i = 0; i < form.length; i++) {
    for (j = 0; j < form[i].length; j++) {
      if (form[i][j].tagName == 'INPUT' && form[i][j].value != '') {
        valida++
      }
    }
  }

  if (valida != 0) {
    $('#modal_confirmacao_voltar').modal('show');
  }
  else {
    window.location.href = window.location.origin + '/clientes'
  }
}

/* Valida formulário para permitir voltar */
function limpaFormulario() {

  var form = $('#form_cadastrar_cliente');

  for (i = 0; i < form.length; i++) {
    for (j = 0; j < form[i].length; j++) {
      if (form[i][j].tagName == 'INPUT' && form[i][j].value != '') {
        form[i][j].value = '';
      }
    }
  }
}

/* Cadastrar cliente */
var _token = document.getElementsByName('_token')[0].value;
$(document).ready(function (e) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#form_cadastrar_cliente').submit(function (e) {
    e.preventDefault();

    document.getElementsByName('_token')[0].value = _token;

    $('#btn_cadastrar').html('Cadastrando...');
    $.ajax({
      url: window.location.origin + '/clientes/cadastrar',
      method: 'post',
      data: $('#form_cadastrar_cliente').serialize(),
      success: function (response) {

        if (response.status === true) {
          document.getElementById('mensagens_retorno').innerHTML = '';
          var mensagens = response.mensagem;

          if (typeof mensagens === 'object') {
            Object.entries(mensagens).forEach(el => {
              var mensagem = document.createElement('p');
              mensagem.innerText = el[1];
              document.getElementById('mensagens_retorno').appendChild(mensagem);
            })
          }
          else {
            var mensagem = document.createElement('p');
            mensagem.innerText = response.mensagem;
            document.getElementById('mensagens_retorno').appendChild(mensagem);
          }

          $('#modal_retorno').modal('show');
          document.getElementById('form_cadastrar_cliente').reset();
          $('#btn_cadastrar').html('Cadastrar');
        }
        else {
          document.getElementById('mensagens_retorno').innerHTML = '';
          var mensagens = response.mensagem;

          if (typeof mensagens === 'object') {
            Object.entries(mensagens).forEach(el => {
              var mensagem = document.createElement('p');
              mensagem.innerText = el[1];
              document.getElementById('mensagens_retorno').appendChild(mensagem);
            })
          }
          else {
            var mensagem = document.createElement('p');
            mensagem.innerText = response.mensagem;
            document.getElementById('mensagens_retorno').appendChild(mensagem);
          }

          $('#modal_retorno').modal('show');
          $('#btn_cadastrar').html('Cadastrar');
        }
      },
      error: function (response) {
        document.getElementById('mensagens_retorno').innerHTML = '';
        var mensagem = document.createElement('p');
        mensagem.innerText = 'Ocorreu um erro na solicitação! Por favor, contate nosso suporte.';
        document.getElementById('mensagens_retorno').appendChild(mensagem);
        $('#modal_retorno').modal('show');
        $('#btn_cadastrar').html('Cadastrar');
      }
    });

  });
});