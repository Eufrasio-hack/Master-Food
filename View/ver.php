<?php
    require_once("Controller/ReceitaController.php");
    $cod = filter_input(INPUT_GET, "cod");
?>
<div class="card-content">
    <h3>Visualizar Receita</h3>
    <?php
        if ($cod) {
            $receitaController = new ReceitaController();
            $receita = $receitaController->RetornaReceita($cod); 

            if ($receita != null) {
            ?> 
                <ul>
                    <li class="titulo">Autor</li>
                    <li class="break"><?= $receita->getAutor(); ?></li>

                    <li class="titulo">Titulo</li>
                    <li class="break"><?= $receita->getTitulo(); ?></li>

                    <li class="titulo">Ingredientes</li>
                    <li class="break"><?= $receita->getIngredientes(); ?></li>

                    <li class="titulo">Modo de Preparo</li>
                    <li class="break"><?= $receita->getModoPreparo(); ?></li>

                    <li class="titulo">
                        <a href="?pagina=novo&cod=<?= $receita->getCod(); ?>" class="btn btn-primary">Editar receita</a><span>&nbsp</span>
                        <a href="?pagina=pesquisa&cod=<?= $receita->getCod(); ?>" class="btn btn-danger">Deletar receita</a></td>
                    </li>
                </ul>
            <?php
            }else{
                echo "Receita não encontrada";
            }
        }else{
            echo "Codigo informado invalido!";
        }
    ?>
</div>
 