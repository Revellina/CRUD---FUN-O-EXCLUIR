<?php
define('MYSQL_HOST', 'localhost:3306');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB_NAME', 'dbname');

try {
    $PDO = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
} catch (PDOException $e) {
    echo 'Erro ao conectar com o MySQL ' . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_GET['registro']) ? filter_var($_GET['registro'], FILTER_SANITIZE_NUMBER_INT) : null;
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sql = "UPDATE dbname SET nome=:nome, endereco=:endereco, bairro=:bairro, cep=:cep, cidade=:cidade, estado=:estado WHERE id=:id";
    $stmt = $PDO->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: consultar.php');
    } else {
        echo 'Erro ao atualizar o registro.';
    }
}

$id = isset($_GET['registro']) ? filter_var($_GET['registro'], FILTER_SANITIZE_NUMBER_INT) : null;

$sql = "SELECT * FROM dbname WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $nome = $row['nome'];
    $endereco = $row['endereco'];
    $bairro = $row['bairro'];
    $cep = $row['cep'];
    $cidade = $row['cidade'];
    $estado = $row['estado'];
} else {
    echo 'Registro não encontrado.';
}
?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>php cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js "
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3 " crossorigin="anonymous ">
    </script>
</head>

<body>

    <div class="d-flex flex-column wrapper" >
    <nav class="navbar navbar-expand-lg navbar bg-primary" data-bs-theme="dark">
              <div class="container">
                         <a class="navbar-brand text-white" href="#">SISTEMA WEB</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse">
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
                
              <form class=" mt-3 " method="POST" action="">
                          
              <div class="mb-3">
                                <label for="Nome" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1 nome" name="nome" required value=" <?php 
                                 echo $nome; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereco: </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1 endereco" name="endereco" required value=" <?php 
                                 echo $endereco; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="bairro" class="form-label">Bairro: </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1 bairro" name="bairro" required value=" <?php 
                                 echo $bairro; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="cidade" class="form-label">Cidade: </label>
                                <input type="text" class="form-control" id="exampleFormControlInput1 cidade" name="cidade" required value=" <?php 
                                 echo $cidade ?>">
                            </div>
                            <div class="mb-3">
                                <label for="estado" class="form-label">Estado: </label>
                                <select class="form-select" name="estado" id="estado" aria-label="Default select example">
                                <option value="<?php 
                                 echo $estado; ?>">SP</option>
                                    <option value="RJ">RJ</option>
                                    <option value="MG">MG</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cep" class="form-label">CEP: </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1 cep" name="cep" placeholder="xxxxx-xxx" required value=" <?php 
                                 echo $cep ?>">
                            </div>
                         
                                  <input type="submit" value="Cadastrar" class="btn btn-primary">
                </form>
            </div>
        </main>
    </div>
    </div>
</body>

</html>