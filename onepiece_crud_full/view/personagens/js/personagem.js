const divErro = document.getElementById("divMsgErro");

function salvarPersonagemAjax() {
    if (!divErro) return;

    divErro.innerHTML = "";
    divErro.style.display = "none";

    const form = document.forms["frmCadastroPersonagem"];
    if (!form) return;

    const dados = new FormData(form);

    const xhttp = new XMLHttpRequest();
    xhttp.open("POST", "../../api/personagem_salvar.php", true);

    /*
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            const erros = this.responseText;

            if (erros) {
                divErro.innerHTML = erros;
                divErro.style.display = "block";
            } else {
                window.location = "listar.php";
            }
        }
    };
    */
    xhttp.onload = function() {
        const erros = this.responseText;

        if (erros) {
            divErro.innerHTML = erros;
            divErro.style.display = "block";
        } else {
            window.location = "listar.php";
        }
    }

    xhttp.send(dados);
}
