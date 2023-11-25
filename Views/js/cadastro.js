//mascara do CPF feita com a biblioteca Jquery
$('#cpf').mask('000.000.000-00', {reverse: false});

//Código pra sumir ou aparecer a navbar no celular
function Mudarestado(hidden) {
        var display = document.getElementById(hidden).style.display;
        if(display == "none")
            document.getElementById(hidden).style.display = 'grid';
        else
            document.getElementById(hidden).style.display = 'none';
    }

