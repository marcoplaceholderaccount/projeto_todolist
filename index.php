
<?php include("template/header.php");
include("fundo.php");?>


<br/>
<div class="p-5 mb-4 bg-light-transparent rounded-3">
    <div class="container-fluid py-5">
        <h5 class="display-5 fw-bold"><?php echo $_SESSION['username'];?>: Bem-vindo ao Sistema</h5>
        <p class="col-md-8 fs-4">
            
            O presente projeto consiste no desenvolvimento de um sistema web de Gestão de Lista de Tarefas,
            com o objetivo de apoiar a organização, controlo e administração de dados relacionados com
                utilizadores e suas tarefas. O sistema permitirá a realização de operações
                fundamentais, tais como registo, edição, eliminação, listagem e pesquisa de dados, 
                bem como o controlo de acesso através de mecanismos de autenticação e autorização.
        </p>

        
        
    </div>
</div>
            

<?php include("template/footer.php");?>
        