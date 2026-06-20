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

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID']) ? $_GET['txtID'] : "");

    $sentencia = $conexion->prepare("DELETE FROM tbl_tarefas WHERE id=:id AND user_id=:user_id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":user_id", $user_id);
    $sentencia->execute();
    
    $mensagem = "Tarefa Eliminada com Sucesso";
    header("Location:index.php?mensagem=" . urlencode($mensagem));
    exit();
}

if (isset($_GET['id_check']) && isset($_GET['status'])) {
    $id_check = $_GET['id_check'];
    $status = $_GET['status'];

    $sentencia = $conexion->prepare("SELECT prazo FROM tbl_tarefas WHERE id = :id AND user_id = :user_id");
    $sentencia->bindParam(":id", $id_check);
    $sentencia->bindParam(":user_id", $user_id);
    $sentencia->execute();
    $tarefa_prazo = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($tarefa_prazo) {
        $agora = new DateTime();
        $prazo = new DateTime($tarefa_prazo['prazo']);

        if ($status == 1) {
            if ($agora > $prazo) {
                $estado = 'Concluido com Atraso';
            } else {
                $estado = 'Concluido';
            }
            
            $sentencia = $conexion->prepare("UPDATE tbl_tarefas SET estado = :estado, 
            data_conclusao = NOW() WHERE id = :id AND user_id = :user_id");
        } else {
            if ($agora > $prazo) {
                $estado = 'Atraso';
            } else {
                $estado = 'Ativo';
            }
            
            $sentencia = $conexion->prepare("UPDATE tbl_tarefas SET estado = :estado, 
            data_conclusao = NULL WHERE id = :id AND user_id = :user_id");
        }

        $sentencia->bindParam(":estado", $estado);
        $sentencia->bindParam(":id", $id_check);
        $sentencia->bindParam(":user_id", $user_id);
        $sentencia->execute();
    }

    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM `tbl_tarefas` WHERE user_id=:user_id");
$sentencia->bindParam(":user_id", $user_id);
$sentencia->execute();
$lista_tarefas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../template/header.php");
include("../../fundo.php")?>

<br/>
<div class="card bg-light-transparent">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="create.php" role="button">Adicionar tarefa</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="table_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col"></th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Data criacao</th>
                        <th scope="col">Data conclusao</th>
                        <th scope="col">Prazo</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($lista_tarefas as $registo) {
                    $data_inicio = new DateTime();
                    $dataFinal = new DateTime($registo['prazo']);
                    
                    $estado = $registo['estado'];
                    
                    // Se o prazo passou e a tarefa não está concluída, força 'Atraso'
                    if (($estado == 'Ativo' || $estado == 'Atraso') && $data_inicio > $dataFinal) {
                        if ($estado != 'Atraso') {
                            $estado = 'Atraso';
                            $sentenciaUpdate = $conexion->prepare("UPDATE tbl_tarefas SET estado = 'Atraso' WHERE id = :id AND user_id = :user_id");
                            $sentenciaUpdate->bindParam(":id", $registo['id']);
                            $sentenciaUpdate->bindParam(":user_id", $user_id);
                            $sentenciaUpdate->execute();
                        }
                    }
                    // Se o prazo foi prolongado e estava como 'Atraso', volta para 'Ativo'
                    elseif ($estado == 'Atraso' && $data_inicio <= $dataFinal) {
                        $estado = 'Ativo';
                        $sentenciaUpdate = $conexion->prepare("UPDATE tbl_tarefas SET estado = 'Ativo' WHERE id = :id AND user_id = :user_id");
                        $sentenciaUpdate->bindParam(":id", $registo['id']);
                        $sentenciaUpdate->bindParam(":user_id", $user_id);
                        $sentenciaUpdate->execute();
                    }
                    
                    $check = ($estado == 'Concluido' || $estado == 'Concluido com Atraso') ? "checked" : "";
                ?>
                    <tr>
                        <td><?php echo $registo['id']; ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input border-dark" type="checkbox"  value="" <?php echo $check; ?> onchange="alterarEstado(<?php echo $registo['id']; ?>, this.checked)" />
                                <label class="form-check-label"></label>
                            </div>
                        </td>
                        <td><?php echo $registo['titulo']; ?></td>
                        <td><?php echo $registo['descricao']; ?></td>
                        <td><?php echo $estado; ?></td>
                        
                        <?php $data_criacao = new DateTime($registo['data_criacao']); ?>
                        <td><?php echo $data_criacao->format('Y-m-d H:i'); ?></td>
                        
                        <td>
                            <?php if($registo['data_conclusao'] != NULL) {
                                $data_conclusao = new DateTime($registo['data_conclusao']);
                                echo $data_conclusao->format('Y-m-d H:i');
                            } ?>
                        </td>

                        <?php $data_prazo = new DateTime($registo['prazo']); ?>
                        <td><?php echo $data_prazo->format('Y-m-d H:i'); ?></td>

                        <td>
                            <a 
                                class="btn btn-info" 
                                href="update.php?txtID=<?php echo $registo['id']; ?>" 
                                role="button"
                            >Update</a>
                            <a 
                                class="btn btn-danger" 
                                href="javascript:eliminar(<?php echo $registo['id']; ?>);" 
                                role="button"
                            >Delete</a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../template/footer.php");?>