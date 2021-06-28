/* Preenchimento de endereço, bairro, cidade e estado através da API VIA CEP */
function buscaEndereco() {
  const $campoCep = document.querySelector('[id="cep"]');
  const $campoLogradouro = document.querySelector('[id="logradouro"]');
  const $campoBairro = document.querySelector('[id="bairro"]');
  const $campoCidade = document.querySelector('[id="cidade"]');
  const $campoEstado = document.querySelector('[id="estado"]');

  const cep = $campoCep.value;

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(respostaDoServer => {
      return respostaDoServer.json();
    })
    .then(dadosDoCep => {
      $campoCidade.value = dadosDoCep.localidade;
      $campoEstado.value = dadosDoCep.uf;
      $campoLogradouro.value = dadosDoCep.logradouro;
      $campoBairro.value = dadosDoCep.bairro;
    });
}

/* Máscara para campos de CEP e telefone */
$(document).ready(function () { $(".mascara").inputmask() });

/* Valida formulário para permitir voltar */
function validaFormulario() {

  var form = $('#form_alterar_cliente');
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

  var form = $('#form_alterar_cliente');

  for (i = 0; i < form.length; i++) {
    for (j = 0; j < form[i].length; j++) {
      if (form[i][j].tagName == 'INPUT' && form[i][j].value != '') {
        form[i][j].value = null;
      }
    }
  }
}