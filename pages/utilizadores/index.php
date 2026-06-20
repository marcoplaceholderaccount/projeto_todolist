<?php
include("../../db.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../../login.php");
    exit();

}

//bloquear quem nao é admin
if($_SESSION['tipo'] != "admin"){
    echo "Acesso negado!";
    header("Location: ../../login.php");
    exit();
}


if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])?$_GET['txtID']:"");
    $sentencia=$conexion->prepare("DELETE  FROM 
    tbl_utilizadores WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    header("Location:index.php");


}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_utilizadores`");
$sentencia->execute();
$lista_user = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("../../template/header.php");
include("../../fundo.php");?>
            
            
<br/>
<div class="card bg-light-transparent">
    <div class="card-header">
<a
    name="username"
    id="username"
    class="btn btn-primary"
    href="create.php"
    role="button"
    >Adicionar Utilizador</a>

    </div>
    <div class="card-body">
        <div
            class="table-responsive-sm"
        >
            <table
                class="table" id="table_id"
            >
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Utilizador</th>
                        <th scope="col">Password</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Data de Criacao</th>
                        <th scope="Ação">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_user as $registo){?>
                        <tr class="">
                        <td scope="row"><?php echo $registo['id'];?></td>
                        <td scope="row"><?php echo $registo['username'];?></td>
                        <td scope="row"><?php echo $registo['password'];?></td>
                        <td scope="row"><?php echo $registo['tipo'];?></td>
                        <td scope="row"><?php echo $registo['data_criacao'];?></td>
                        <td>
                            <a class="btn btn-info"
                            href="update.php?txtID=<?php echo $registo['id'];?>"
                            role="button"
                            >Update</a>
                            <a class="btn btn-danger"
                            href="javascript:eliminar(<?php echo $registo['id'];?>);" 
                            role="button"
                            >Delete</a>
                       </td>
                    </tr>
                 <?php };?>
                    
                </tbody>
            </table>
        </div>
        

    </div>
</div>



<?php include("../../template/footer.php");?>