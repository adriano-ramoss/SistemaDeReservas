function mostrarSenha() {
    var senhaInput = document.getElementById("senha");
    var passwordIcon = document.getElementById("showPassword");

    if (senhaInput.type === "password") {
        senhaInput.type = "text";
        passwordIcon.src = "views/img/hide.png";
    } else {
        senhaInput.type = "password";
       passwordIcon.src = "views/img/show.png";
    }
}