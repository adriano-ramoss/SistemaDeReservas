// //var input = document.getElementById('Data de Hoje');
// //input.addEventListener('change', function() {
//   //var agora = new Date();
//   //var escolhida = new Date(this.value);
//   //if (escolhida < agora) this.value = [agora.getFullYear(), 
//    // agora.getMonth() + 1, agora.getDate()].map(v => v < 10 ? '0' + v : v).join('-');});

// <input type="date" min={new Date('data de hoje').getFullYear() + '-' + String(new Date().getMonth() 
// + 1).padStart(2, '0') + '-' + new Date().getDate()} name="stockDate" id="dateMin" />   

// Obtém uma referência para o elemento de input
        const inputDate = document.getElementById("data");

        // Obtém a data atual no formato "YYYY-MM-DD"
        const dataAtual = new Date().toISOString().split('T')[0];

        // Define o valor mínimo do input como a data atual
        inputDate.setAttribute("min", dataAtual);