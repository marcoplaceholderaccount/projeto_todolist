<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$url_base = "http://localhost/projeto_todolist/";
if(!isset($_SESSION['username'])){
    header("Location:".$url_base."login.php");

}

?>


<!doctype html>
<html lang="en">
    <head>
        <title>To-Do list</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />

        <script 
            src="https://code.jquery.com/jquery-3.6.3.min.js" 
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" 
            crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css" />

        <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>

        
    </head>

    

    <body>
        <header>
            <!-- place navbar here -->
        </header>

    <nav class="navbar navbar-expand navbar-light bg-light-transparent">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="http://localhost/projeto_todolist/" aria-current="page"
                    >Sistema Web <span class="visually-hidden">(current)</span></a
                >
            </li>

            <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'normal'){ ?>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>pages/tarefas">Tarefas</a>
            </li>

            <?php } ?>

            <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'admin'){ ?> 

            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>pages/utilizadores">Utilizadores</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>pages/report">Estatisticas</a>
            </li>

            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base;?>logout.php">Logout</a>
            </li>

        </ul>
    </nav>        
        <main class="container">


<?php if(isset($_GET['mensagem'])){?>
<script>
    Swal.fire({icon: "success", title: "<?php echo $_GET['mensagem'];?>"});
</script>    
<?php }?> 