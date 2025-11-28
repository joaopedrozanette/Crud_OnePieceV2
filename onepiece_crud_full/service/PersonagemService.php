<?php
require_once(__DIR__ . "/../model/Personagem.php");

class PersonagemService {

    public function validar(Personagem $p) {
        $erros = [];

        if(!$p->getNome()) $erros[] = "Informe o nome!";
        if(!is_numeric($p->getIdade()) || $p->getIdade() <= 0) $erros[] = "Idade deve ser maior que 0";
        if(!$p->getRaca() || !$p->getRaca()->getId()) $erros[] = "Selecione a raça!";
        if(!$p->getAfiliacao() || !$p->getAfiliacao()->getId()) $erros[] = "Selecione a afiliação!";

        $rec = $p->getRecompensa();
        if(!is_numeric($rec)) {
            $erros[] = "Recompensa inválida.";
        } else {
            if($rec < 0) {
                $erros[] = "Recompensa deve ser igual ou maior 0.";
            }
           
            $MAX = 9999999999.99;
            if($rec > $MAX) {
                $erros[] = "Recompensa máxima permitida é 9.999.999.999,99.";
            }
        }

        
        $url = $p->getImageUrl();
        if($url && !filter_var($url, FILTER_VALIDATE_URL)) {
            $erros[] = "URL de imagem inválida.";
        }


        return $erros;
    }
}
