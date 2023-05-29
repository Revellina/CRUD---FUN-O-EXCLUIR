<?php

define('MYSQL_HOST', 'localhost:3306');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB_NAME',  'dbname');

try {
    $PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Sistema de Acesso ao Banco de dados </title>
</head>

<body>
    <div class="d-flex flex-column wrapper">
        <nav class="navbar navbar-expand-lg navbar bg-primary" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand text-white" href="#">SISTEMA WEB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link text-white active " href="#">Cadastrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="consultar.php">Consultar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
            </div>
        </div>
        <main class="flex-fill">
            <div class="container">
                <div class="texto">
                    <br>
                    <h3>Cadastrar - Agendamento de Potenciais Clientes</h3>
                    Sistema utilizado para agendamento de serviços
                </div>

                <div class="row">
                    <div class="col">
                        <br>
                        <h1>Tabela Clientes</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <br>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Bairro</th>
                                        <th scope="col">Cidade</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">CEP</th>
                                        <th scope="col">Acoes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM dbname";
                                    $result = $PDO->query($sql);
                                    $rows = $result->fetchAll();
                                    foreach ($rows as $row) {

                                    ?>

                                        <tr>
                                            <th scope="row"><?php echo $row['id']; ?></th>
                                            <td><?php echo $row['nome']; ?></td>
                                            <td><?php echo $row['endereco']; ?></td>
                                            <td><?php echo $row['bairro']; ?></td>
                                            <td><?php echo $row['cep']; ?></td>
                                            <td><?php echo $row['cidade']; ?></td>
                                            <td><?php echo $row['estado']; ?></td>
                                            <td class="grupo_botao_acao">
                                                <form action="edicao.php" method="GET">
                                                    <input type="hidden" name="registro" value="<?php echo $row['id']; ?>">
                                                    <button class="editar_botao" type="submit">Editar</button>
                                                </form>
                                                <form action="deletar.php" method="POST">
                                                    <input type="hidden" name="registro" value="<?php echo $row['id']; ?>">
                                                    <button class="deletar_botao" type="submit"> Deletar</button>
                                                </form>
                                            </td>

                                        </tr>

                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</body>

</html>