<?php
    require_once("Controller/ReceitaController.php");
    require_once("Model/Receita.php");
    $receitaController = new ReceitaController();
    $receita = new Receita();

    $autor = "";
    $titulo = "";
    $ingredientes = "";
    $modoPreparo = "";
    $resultado = "";
    $cod = filter_input(INPUT_GET, "cod");

    $enviarDados = filter_input(INPUT_POST, "enviarDados");
    $cancelar = filter_input(INPUT_POST, "cancelar");
    if ($enviarDados) {

        $receita->setAutor(filter_input(INPUT_POST, "autor"));
        $receita->setTitulo(filter_input(INPUT_POST, "titulo"));
        $receita->setIngredientes(filter_input(INPUT_POST, "ingredientes"));
        $receita->setModoPreparo(filter_input(INPUT_POST, "modoPreparo"));
        $receita->setDataHora(date("Y-m-d H:i:s"));

        #Se a variavel cod não existe e uma nova receita
        if (!$cod) {
            # Novo
            if ($receitaController->Cadastrar($receita)) {
                $resultado = "Receita Cadastrada com sucesso.";
                header("location:?pagina=pesquisa");
            } else {
                $resultado = "Erro ao tentar cadastrar receita.";
            }
            
        } else {
            # Editando
            $receita->setCod($cod);
            if ($receitaController->Alterar($receita) == true) {
                $resultado = "Receita alterada com sucesso.";
                header("location:?pagina=pesquisa");
            } else {
                $resultado = "Erro ao tentar alterar receita.";
            }
        }
        
    }elseif($cancelar){
        $autor = "";
        $titulo = "";
        $ingredientes = "";
        $modoPreparo = "";
        $resultado = "";
        header("location:?pagina=pesquisa");
    }
    if ($cod) {
        $itemReceita = $receitaController->RetornaReceita($cod);
        $autor = $itemReceita->getAutor();
        $titulo = $itemReceita->getTitulo();
        $ingredientes = $itemReceita->getIngredientes();
        $modoPreparo = $itemReceita->getModoPreparo();
    }
?>
<div class="card-content">
    <h3>Nova Receita</h3>
    <form method="post" name="frmNovasReceitas">
        <div class="">
            <label for="txtNome">Seu nome</label>
            <input type="text" name="autor" id="nome" class="form-control" value="<?= $autor; ?>">
        </div>
        <div class="">
            <label for="txtNome">Titulo</label>
            <input type="text" name="titulo" id="nome" class="form-control" value="<?= $titulo; ?>">
        </div>
        <div class="">
            <label for="txtNome">Ingredientes</label>
            <textarea name="ingredientes" id="ingredientes" class="form-control"><?= $ingredientes; ?></textarea>
        </div>
        <div class="">
            <label for="txtNome">Modo de preparo</label>
            <textarea name="modoPreparo" id="modoPreparo" class="form-control"><?= $modoPreparo; ?></textarea>
        </div>
        <div>
            <span><?= $resultado; ?>&nbsp</span>
        </div>
        <input type="submit" value="Cadastrar" name="enviarDados" class="btn btn-success">
        <input type="submit" value="Cancelar" name="cancelar" class=" btn btn-danger">
    </form>
</div> 