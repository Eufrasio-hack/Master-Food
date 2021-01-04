<?php
    require_once("Controller/ReceitaController.php");
    $receitaController = new ReceitaController();

    if (filter_input(INPUT_GET, "cod")) {
        $receitaController->Deletar(filter_input(INPUT_GET, "cod"));
    }

    $listaReceita = $receitaController->RetornaTudo();
?>

<div class="card-content">
    <h3>Pesquisar</h3>
    <?php if ($listaReceita != null ) { ?>
    <table class="table table-responsive table-striped">
        <thead class="success">
            <tr>
                <th>Autor</th>
                <th>Titulo</th>
                <th>Data e Hora</th>
                <th>Ação</th>
            </tr>
        </thead>    
        <tbody>
            <?php foreach ($listaReceita as $receita) {?>
                <tr>
                    <td><?= $receita->getAutor(); ?></td>
                    <td><?= $receita->getTitulo() ?></td>
                    <td><?= $receita->getDataHora(); ?></td>
                    <td><a href="?pagina=ver&cod=<?= $receita->getCod(); ?>" class="btn btn-info">Ver</a><span>&nbsp</span>
                    <a href="?pagina=novo&cod=<?= $receita->getCod(); ?>" class="btn btn-primary">Editar</a><span>&nbsp</span>
                    <a href="?pagina=pesquisa&cod=<?= $receita->getCod(); ?>" class="btn btn-danger">Deletar</a></td>
                </tr>
            <?php } ?>
        </tbody>    
    </table>
    <?php 
    }else{
        echo "Nenhuma receita cadastrada";
    }
    ?>
</div>