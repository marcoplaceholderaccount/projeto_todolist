<?php
include("../../db.php");
session_start();

if(!isset($_SESSION['username'])){
    header("Location: ../../login.php");
    exit();
}

// Bloquear quem não é admin
if($_SESSION['tipo'] != "admin"){
    echo "Acesso negado!";
    header("Location: ../../login.php");
    exit();
}

// Query ajustada para contar cada estado do ENUM separadamente (respeitando as maiúsculas)
$sql = "SELECT 
            SUM(CASE WHEN estado = 'Ativo' THEN 1 ELSE 0 END) as ativo,
            SUM(CASE WHEN estado = 'Concluido' THEN 1 ELSE 0 END) as concluido,
            SUM(CASE WHEN estado = 'Atraso' THEN 1 ELSE 0 END) as atraso,
            SUM(CASE WHEN estado = 'Concluido com Atraso' THEN 1 ELSE 0 END) as concluido_atraso
        FROM `tbl_tarefas`";

$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

// Definimos as variáveis para cada fatia do gráfico
$ativo = $resultado['ativo'] ?? 0;
$concluido = $resultado['concluido'] ?? 0;
$atraso = $resultado['atraso'] ?? 0;
$concluido_atraso = $resultado['concluido_atraso'] ?? 0;
?>

<?php include("../../template/header.php");
include("../../fundo.php")?>
            
<br/>
<div class="card bg-light-transparent">
    <div class="card-body ">
        <div class="table-responsive-sm">
            
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Estado', 'Quantidade'],
                    // Passamos as 4 fatias com os dados do banco para o JavaScript
                    ['Ativo', <?php echo $ativo; ?>],
                    ['Concluído', <?php echo $concluido; ?>],
                    ['Atraso', <?php echo $atraso; ?>],
                    ['Concluído com Atraso', <?php echo $concluido_atraso; ?>]
                ]);

                var options = {
                    title: 'Divisão de Tarefas',
                    pieHole: 0.4, 
                    // Cores opcionais para combinar com cada estado (Verde, Azul, Vermelho, Laranja)
                    colors: ['#28a745', '#007bff', '#dc3545', '#ffc107'], 
                    backgroundColor: 'transparent', 
                    chartArea: {
                        backgroundColor: 'transparent' 
                    }
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
            </script>

            <div id="donutchart" style="width: 100%; max-width: 900px; height: 500px;"></div>

        </div>
    </div>
</div>

<?php include("../../template/footer.php");?>