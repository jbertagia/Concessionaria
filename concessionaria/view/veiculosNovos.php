<?php
require_once "model/Veiculo.php";
$veiculos = Veiculo::listar("Novo", $_GET['marca'] ?? null, $_GET['modelo'] ?? null);
// var_dump($_GET); // debug: parâmetros de filtro GET
// var_dump($lista); // debug: listar veículos novos filtrados

?>
<h1>Veículos Novos</h1>
<?php include "componentes/filtroVeiculos.php"; ?>
<hr>
<?php
foreach ($veiculos as $veiculo) {
    // var_dump($veiculo); // debug: dados individuais de veículo
    
    include "componentes/cardVeiculo.php";
}
?>