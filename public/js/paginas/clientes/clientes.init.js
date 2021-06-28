$(document).ready(function () {
  $('#tabela').DataTable({
    language: {
      url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
    }
  });
});

function modal_remover(cliente, id) {
  var mensagem = document.getElementById('mensagem_remover');
  mensagem.innerText = 'Você tem certeza que deseja remover o cliente ' + cliente + '?';
  var botao_remover = document.getElementById('btn_remover');
  botao_remover.setAttribute('onclick', 'funcao_remover("' + id + '")');

  $('#modal_confirmacao_remover').modal('show');
}

function funcao_remover(id) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var _token = document.getElementsByName('_token')[0].value;
  $.ajax({
    url: window.location.origin + '/clientes/remover',
    method: 'post',
    data: {
      '_token': _token,
      'id': id
    },
    success: function (response) {

      if (response.status === true) {
        document.getElementById('mensagens_retorno').innerHTML = '';
        var mensagem = document.createElement('p');
        mensagem.innerText = response.mensagem;
        document.getElementById('mensagens_retorno').appendChild(mensagem);
        $('#modal_retorno').modal('show');
        setTimeout(function () {
          $('#modal_retorno').modal('hide');
          window.location.reload(true);
        }, 2000);
      }
      else {
        document.getElementById('mensagens_retorno').innerHTML = '';
        var mensagem = document.createElement('p');
        mensagem.innerText = response.mensagem;
        document.getElementById('mensagens_retorno').appendChild(mensagem);
        $('#modal_retorno').modal('show');
      }
    },
    error: function (response) {
      document.getElementById('mensagens_retorno').innerHTML = '';
      var mensagem = document.createElement('p');
      mensagem.innerText = 'Ocorreu um erro na solicitação! Por favor, contate nosso suporte.';
      document.getElementById('mensagens_retorno').appendChild(mensagem);
      $('#modal_retorno').modal('show');
    }
  });
}