<?php
include("../../db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

if($_POST){
    $titulo = (isset($_POST["titulo"]) ? $_POST["titulo"] : "");
    $descricao = (isset($_POST["descricao"]) ? $_POST["descricao"] : "");
    $prazo = (isset($_POST["prazo"]) ? $_POST["prazo"] : "");
    
    $estado = "Ativo"; 

    $sentencia = $conexion->prepare("INSERT INTO `tbl_tarefas` (`id`, `titulo`, `descricao`, `estado`, `data_criacao`, 
    `data_conclusao`, `prazo`, `user_id`) VALUES (NULL, :titulo, :descricao, :estado, NOW(), NULL, :prazo, :user_id);");
    
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descricao", $descricao);
    $sentencia->bindParam(":estado", $estado);
    $sentencia->bindParam(":prazo", $prazo);
    $sentencia->bindParam(":user_id", $user_id);
    $sentencia->execute();
    
    header("Location:index.php");
}
?>

<?php include("../../template/header.php");?>
<br/>
<div class="card">
    <div class="card-header">Registar tarefa</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Título</label>
                <input
                    type="text"
                    class="form-control"
                    name="titulo"
                    id="titulo"
                    aria-describedby="helpId"
                    placeholder="Título da tarefa"
                    required
                />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input
                    type="text"
                    class="form-control"
                    name="descricao"
                    id="descricao"
                    aria-describedby="helpId"
                    placeholder="Descrição de tarefa"
                />
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Prazo (Data e Hora)</label>
                <input
                    type="datetime-local"
                    class="form-control"
                    name="prazo"
                    id="prazo"
                    aria-describedby="helpId"
                    placeholder=""
                    required
                />
            </div>
            <button
                type="submit"
                class="btn btn-success"
            >
                Adicionar Tarefa
            </button>
            <a
                name=""
                id=""
                class="btn btn-danger"
                href="index.php"
                role="button"
                >Cancelar</a
            >
        </form>
    </div>
</div>

<?php include("../../template/footer.php");?>