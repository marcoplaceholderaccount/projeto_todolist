<?php
include("db.php"); // Ajusta o caminho se o db.php estiver noutra pasta

if($_POST){
    $username = (isset($_POST["username"]) ? $_POST["username"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $tipo = "normal"; 

    if(!empty($username) && !empty($password)){
        $validar = $conexion->prepare("SELECT * FROM tbl_utilizadores WHERE username = :username");
        $validar->bindParam(":username", $username);
        $validar->execute();
        
        if($validar->rowCount() > 0){
            $erro = "Este nome de utilizador já está a ser utilizado!";
        } else {
            // Criar o hash seguro da password aqui também
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sentencia = $conexion->prepare("INSERT INTO tbl_utilizadores
            (id, username, password, tipo, data_criacao) VALUES (null, :username, :password, :tipo, NOW())");
           
            $sentencia->bindParam(":username", $username);
            // Guardar o hash
            $sentencia->bindParam(":password", $password_hash);
            $sentencia->bindParam(":tipo", $tipo);

            if($sentencia->execute()){
                header("Location: login.php?registo=sucesso");
                exit();
            }
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>

<!doctype html>
<html lang="pt">
<head>
    <title>Criar Conta</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Criar Nova Conta</h4>
                </div>
                <div class="card-body text-dark">
                    
                    <?php if(isset($erro)){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $erro; ?>
                        </div>
                    <?php } ?>

                    <form action="" method="post">  
                        <div class="mb-3">
                            <label for="username" class="form-label">Nome de Utilizador</label>
                            <input type="text" class="form-control" name="username" id="username" required placeholder="Escolha um nome de utilizador" />
                        </div>
                            
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Escolha uma password" />
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Registar e Entrar</button>
                        </div>
                        
                        <div class="mt-3 text-center text-secondary">
                            Já tem uma conta? <a href="login.php" class="text-primary text-decoration-none">Inicie sessão aqui</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>