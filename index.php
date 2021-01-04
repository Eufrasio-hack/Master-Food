<!DOCTYPE html>
<html lang="pt-ao">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="js/Bootstrap/css/bootstrap.css">
    <title>Master Food</title>
</head>
<body>
    <div class="container"> 
        <div class="row">
            <div class="col md12">
                <div class="card">
                    <div class="card-image">
                        <span class="card-title">Master Food</span>
                    </div>
                    <div class="card-action">
                        <a href="?pagina=novo">Nova receita</a>
                        <a href="?pagina=pesquisa">Pesquisar receita</a>
                    </div>
                    <div class="card-content">
                        <?php
                            $pagina = filter_input(INPUT_GET, "pagina");
                            switch ($pagina) {
                                case 'novo':
                                    require_once("View/novo.php");
                                    break;
                                case 'pesquisa':
                                    require_once("View/pesquisar.php");
                                    break;
                                case 'ver':
                                    require_once("View/ver.php");
                                    break;
                                default:
                                    require_once("View/novo.php");
                                    break;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>