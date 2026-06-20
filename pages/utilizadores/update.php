<?php 
include("../../db.php");
if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])?$_GET['txtID']:"");
    $sentencia=$conexion->prepare("SELECT * FROM  
    tbl_utilizadores WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    $registo=$sentencia->fetch(PDO::FETCH_LAZY);
    $username=$registo['username'];
}

if($_POST){
    $txtID = (isset($_GET['txtID'])?$_GET['txtID']:"");
    $username = (isset($_POST["username"])?$_POST["username"]:"");
    $sentencia=$conexion->prepare("UPDATE 
    tbl_utilizadores SET username=:username WHERE id=:id");
    $sentencia->bindParam(":username", $username);
    $sentencia->bindParam(":id", $txtID );
    $sentencia->execute();
    header("Location:index.php");
}

?>

<?php include("../../template/header.php");?>
            
Atualizar Utilizadores
            
<div class="card">
    <div class="card-header">Utilizador</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="" class="form-label">ID</label>
                <input
                    type="text"
                    value="<?php echo $txtID;?>"
                    class="form-control"
                    readonly
                    name="txtID"
                    id="txtID"
                    aria-describedby="helpId"
                    placeholder=""
                />
            </div>
        <div class="mb-3">
            <label for="username" class="form-label">Utilizador</label>

            
            <input
                type="text"
                value="<?php echo $username;?>"
                class="form-control"
                name="username"
                id="username"
                aria-describedby="helpId"
                placeholder="Utilizador"
            />
        </div>
        <button
            type="submit"
            class="btn btn-success"
        >
            Atualizar Utilizador
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