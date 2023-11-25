function esconderMensagemSenha() {
    var errorMessage = document.querySelector('.error-message');
    errorMessage.style.display = 'none';
  }

  // Adiciona o evento de clique ao input para chamar a função esconderMensagemSenha
  document.getElementById('cpf').onclick = esconderMensagemSenha;
  document.getElementById('senha').onclick = esconderMensagemSenha;