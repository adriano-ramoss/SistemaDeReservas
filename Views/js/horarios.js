// Seleciona os elementos HTML
var opcaoSelect = document.getElementById("periodo");
var outroSelect = document.getElementById("horario");

// Define os valores iniciais com base na escolha inicial

  var horariosmanha = ["8:00 - 8:50", "8:50 - 9:40", "10:50 - 11:40"];
  var horariostarde = ["13:30 - 14:20", "14:20 - 15:10"];
  var horariosnoite = ["19:00 - 20:30", "20:50 - 22:15", "19:00 - 22:15"];

// Função para atualizar os valores do segundo select com base na escolha
function atualizarValores() {
  outroSelect.innerHTML = ""; // Limpa o segundo select

  var escolha = opcaoSelect.value; // Obtém a escolha atual

  // Define os valores com base na escolha atual
  var valores = [];
  if (escolha === "manha") {
    valores = horariosmanha;
  } else if (escolha === "tarde") {
    valores = horariostarde;
  } else if (escolha === "noite") {
    valores = horariosnoite;
  }

  // Adiciona as opções ao segundo select
  valores.forEach(function(valor) {
    var option = document.createElement("option");
    option.value = valor;
    option.textContent = valor; // Para exibir "Valor X (Opção Y)"
    outroSelect.appendChild(option);
  });
}

// Adiciona um event listener para o campo de seleção que influencia
opcaoSelect.addEventListener("change", atualizarValores);

// Chama a função inicialmente para exibir os valores corretos
atualizarValores();
