<?php 
session_start();
include("db.php");
include("fundo.php");

if($_POST){
    $username = (isset($_POST["username"]) ? $_POST["username"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");

    // Procurar o utilizador na base de dados apenas pelo nome
    $sentencia = $conexion->prepare("SELECT * FROM tbl_utilizadores WHERE username = :username");
    $sentencia->bindParam(":username", $username);
    $sentencia->execute();
    
    $utilizador = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Verificar se o utilizador existe e se a password introduzida bate com o hash
    if($utilizador && password_verify($password, $utilizador['password'])){

        $_SESSION['user_id'] = $utilizador['id'];
        $_SESSION['username'] = $utilizador['username'];
        $_SESSION['tipo'] = $utilizador['tipo'];
        
        // Redireciona SEMPRE para o index.php, tal como tinhas antes
        header("Location: index.php");
        exit();
    } else {
        $erro = "Utilizador ou password incorretos!";
    }
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main class="container">
        <div class="row">
            <div class="col-md-4" >
                
            </div>
            <div class="col-md-4">
            </br></br>
                <div class="card border-0" style="background-color: #edeff3; width: 400px; min-height: 380px; margin-left: -30px; margin-top: 70px;">
                    <div class="card-header" style="background-color: #edeff3;">Login</div>
                    <div class="card-body">
                       <?php if(isset($mensagem)){?>
                        <div
                            class="alert alert-primary"
                            role="alert"
                        >
                            <strong><?php echo $mensagem?></strong> 
                        </div>
                        <?php } ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="" class="form-label">Username</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="username"
                                    id="username"
                                    aria-describedby="helpId"
                                    placeholder="Digite o nome do utlizador"
                                />

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    id="password"
                                    aria-describedby="helpId"
                                    placeholder="Digite a password do utilizador"
                                />

                            </div>

                          <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">
                                Entrar no sistema
                            </button>
                          </div>
                            
                        </form>

                        <div class="mt-3 text-center">
                            Não tem uma conta? <a href="registro.php">Registe-se aqui</a>
                        </div>

                    </div>
                </div>
                
                
            </div>
        </div>
            
            


        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
