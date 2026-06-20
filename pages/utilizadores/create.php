<?php
include("../../db.php"); 

if($_POST){
   
    $username = (isset($_POST["username"]) ? $_POST["username"] : "");
    $password = (isset($_POST["password"]) ? $_POST["password"] : "");
    $tipo = (isset($_POST["tipo"]) ? $_POST["tipo"] : "");

    // Criar o hash seguro da password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sentencia = $conexion->prepare("INSERT INTO tbl_utilizadores
    (id, username, password, tipo, data_criacao) VALUES (null, :username, :password, :tipo, NOW())");
   
    $sentencia->bindParam(":username", $username);
    // Guardamos o hash na base de dados, não a password em texto limpo
    $sentencia->bindParam(":password", $password_hash);
    $sentencia->bindParam(":tipo", $tipo);

    $sentencia->execute();
   
    header("Location:index.php");
}
?>


<?php include("../../template/header.php");?>

<br/>
<div class="card">
    <div class="card-header">Adicionar Utilizador</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">  
            <div class="mb-3">
            <label for="text" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                aria-describedby="helpId"
                placeholder="Nome do Utilizador"

            />
            </div>
                
        
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    aria-describedby="helpId"
                    placeholder="Password"
                />
            </div>
            <div class="mb-3">
                <label for="text" class="form-label">Tipo</label>
                <input
                    type="text"
                    class="form-control"
                    name="tipo"
                    id="tipo"
                    aria-describedby="helpId"
                    placeholder="Tipo"
                />
            </div>

            <div class="mb-3">
            <button
            type="submit"
            class="btn btn-success"
            >
            Adicionar Utilizador
            </button>
            <a
            name=""
            id=""
            class="btn btn-danger"
            href="index.php"
            role="button"
            >Cancelar</a>
          
            </div>
        </form>
    </div>
  

</div>





<?php include("../../template/footer.php");?>