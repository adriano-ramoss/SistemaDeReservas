function esconderMensagemSenha() {
    var msg = document.querySelector('.message');
    msg.style.display = 'none';
  }

  // Adiciona o evento de clique ao input para chamar a função esconderMensagemSenha
  document.getElementById('nome').onclick = esconderMensagemSenha;
  document.getElementById('cpf').onclick = esconderMensagemSenha;
  document.getElementById('senha').onclick = esconderMensagemSenha;
  document.getElementById('select-box').onclick = esconderMensagemSenha;