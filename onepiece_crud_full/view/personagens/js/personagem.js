function salvarPersonagemAjax() {
  const form   = document.forms["frmCadastroPersonagem"];
  const dados  = new FormData(form);
  const msgBox = document.getElementById("divMsgErro");

  msgBox.style.display = "none";
  msgBox.innerHTML = "";

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../../api/personagem_salvar.php", true);

xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {

        let resp;
        try {
            resp = JSON.parse(xhr.responseText);
        } catch(e) {
            msgBox.innerHTML = "<div class='alert alert-danger'>Erro inesperado na resposta do servidor.</div>";
            msgBox.style.display = "block";
            return;
        }

        if (resp.success) {
            window.location.href = "listar.php";
            return;
        }

        if (resp.errors && resp.errors.length) {
            let html = "<div class='alert alert-danger'><ul>";
            resp.errors.forEach(function(e) {
                html += "<li>" + e + "</li>";
            });
            html += "</ul></div>";

            msgBox.innerHTML = html;
            msgBox.style.display = "block";
            return;
        }

        msgBox.innerHTML = "<div class='alert alert-danger'>Erro ao salvar personagem.</div>";
        msgBox.style.display = "block";

    }
};


  xhr.send(dados);
}
