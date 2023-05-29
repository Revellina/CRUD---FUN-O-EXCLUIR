<?php
    session_start();

    define('MYSQL_HOST', 'localhost:3306');
    define('MYSQL_USER', 'root');
    define('MYSQL_PASSWORD', '');
    define('MYSQL_DB_NAME', 'dbname');


    try{
        $PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
    }catch (PDOException $e){
   
        echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
    }

    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    $_SESSION['nome'] = $nome;
    $_SESSION['endereco'] = $endereco;
    $_SESSION['bairro'] = $bairro;
    $_SESSION['cidade'] = $cidade;
    $_SESSION['estado'] = $estado;
    $_SESSION['cep'] = $cep;

    $sql = "INSERT INTO dbname (nome, endereco, bairro, cidade, estado, cep) VALUES (:nome, :endereco, :bairro, :cidade, :estado, :cep)";

    $stmt = $PDO->prepare($sql);

    $stmt->execute(['nome' => $nome, 'endereco' => $endereco, 'bairro' => $bairro, 'cidade' => $cidade, 'estado' => $estado, 'cep' => $cep]);

   
    header("Location: consultar.php");

    exit();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js " integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3 " crossorigin="anonymous ">
    </script>
    <title>Document</title>
</head>

<body>
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

    <div class="container">
        <div class="texto">
            <br>
            <h3>Cadastrar - Agendamento de Potenciais Clientes</h3>
            Sistema utilizado para agendamento de serviços
            <br>
            <br>
            <br>
            <br>
            <br>
            <h1>Obrigada por fazer o seu cadastro com a gente :)</h1>
        </div>
    </div>
</body>

</html>