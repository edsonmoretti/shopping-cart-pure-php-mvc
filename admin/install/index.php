<?php
if (isset($_POST['server'])) {
    $server = filter_input(INPUT_POST, 'server');
    $database = filter_input(INPUT_POST, 'database');
    $password = filter_input(INPUT_POST, 'password');
    $user = filter_input(INPUT_POST, 'user');
    $url = filter_input(INPUT_POST, 'url');
    if(!file_exists('../app/config/')){
        mkdir('../app/config/');
    }
    $configFile = fopen("../app/config/configuration.php", "w") or die("Unable to open file!");
    $config = "<?php
define('DB_HOST', '$server');
define('DB_USER', '$user');
define('DB_PASSWORD', '$password');
define('DB_NAME', '$database');
define('SESSION_NAME', md5('loggedUser' . date('dmy'))); //isso me dá um timeout de 24h

define('URL', '$url');
";
    fwrite($configFile, $config);
    fclose($configFile);


    $scripts = file_get_contents('../app/bd/tables.sql');

    $pdo = new PDO('mysql:host=' . $server . ';dbname=' . $database . '',
        $user,
        $password);
    $pdo->exec(
            $scripts
    );

    header('Location: ' . $url);


    die();
}

?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../admin/css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
    <title>Lojinha - Instalação</title>
</head>
<body>
<div class="container-fluid">
    <div style="text-align: center;"><h1>Configuração do Banco de Dados</h1></div>
    <form action="" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Servidor</label>
            <input type="text" class="form-control" name="server" aria-describedby="emailHelp"
                   placeholder="Ex: localhost:3306">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nome do banco de dados</label>
            <input type="text" class="form-control" name="database" aria-describedby="emailHelp"
                   placeholder="Ex.: lojinha">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Usuário</label>
            <input type="text" class="form-control" name="user" placeholder="Ex.: root">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input type="text" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">URL do painel Admin</label>
            <input type="text" class="form-control" name="url" value="http://localhost:8013/admin/"
                   placeholder="Ex.: http://localhost:8013/admin/">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
</body>
</html>
