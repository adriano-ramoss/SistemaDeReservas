
    // Função para esconder a mensagem após 2 segundos
setTimeout(function() {
        var message = document.querySelector(".message");
        if (message) {
            message.style.display = 'none';
        }
    }, 2000); // 2000 milissegundos = 2 segundos
