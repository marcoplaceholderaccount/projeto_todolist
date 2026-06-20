<?php
include("../../db.php"); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../login.php");
}

$user_id = $_SESSION["user_id"];

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");
    $sentencia = $conexion->prepare("SELECT * FROM tbl_tarefas WHERE id=:id AND user_id=:user_id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":user_id", $user_id);
    $sentencia->execute();
    $registo = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $registo['titulo'];
    $descricao = $registo['descricao'];
    $prazo = $registo['prazo'];
}

if($_POST){
    $txtID = (isset($_POST['txtID']) ? $_POST['txtID'] : "");
    $titulo = (isset($_POST["titulo"]) ? $_POST["titulo"] : "");
    $descricao = (isset($_POST["descricao"]) ? $_POST["descricao"] : "");
    $prazo = (isset($_POST["prazo"]) ? $_POST["prazo"] : "");

    $sentencia = $conexion->prepare("UPDATE tbl_tarefas 
        SET titulo=:titulo, descricao=:descricao, prazo=:prazo 
        WHERE id=:id AND user_id=:user_id");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descricao", $descricao);
    $sentencia->bindParam(":prazo", $prazo);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":user_id", $user_id);
    $sentencia->execute();

    $mensagem = "Atualizado com Sucesso";
    header("Location:index.php?mensagem=" . $mensagem);
    exit();
}
?>

<?php include("../../template/header.php");?>

<div class="card">
    <div class="card-header">Atualizar tarefa</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="txtID" class="form-label">ID</label>
                <input
                    type="text"
                    value="<?php echo $txtID;?>"
                    class="form-control"
                    readonly
                    name="txtID"
                    id="txtID"
                />
            </div>
            
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input
                    type="text"
                    value="<?php echo $titulo;?>"
                    class="form-control"
                    name="titulo"
                    id="titulo"
                    placeholder="Titulo"
                    required
                />
            </div>
            
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <input
                    type="text"
                    value="<?php echo $descricao;?>"
                    class="form-control"
                    name="descricao"
                    id="descricao"
                    placeholder="Descrição"
                />
            </div>
            
            <div class="mb-3">
                <label for="prazo" class="form-label">Prazo (Data e Hora)</label>
                <input
                    type="datetime-local"
                    value="<?php echo $prazo;?>"
                    class="form-control"
                    name="prazo"
                    id="prazo"
                    required
                />
            </div>
            
            <button 
                type="submit" 
                class="btn btn-success"
            >
                Atualizar Tarefa
            </button>
            <a 
                class="btn btn-danger" 
                href="index.php" 
                role="button"
                >Cancelar</a
            >
        </form>
    </div>
</div>

<?php include("../../template/footer.php");?>