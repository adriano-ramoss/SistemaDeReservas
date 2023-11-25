function mostrarSenha() {
    var senhaInput = document.getElementById("senha");
    var passwordIcon = document.getElementById("showPassword");

    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        passwordIcon.src = "../img/hide.png";
    } else {
        senhaInput.type = "password";
       passwordIcon.src = "../img/show.png";
    }
}