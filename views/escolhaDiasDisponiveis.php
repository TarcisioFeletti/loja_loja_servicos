<div class="container-fluid pt-5" align="center">
<?php
require_once 'includes/autenticarMenu.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/iniciarSessao.inc.php';
if(!isset($_REQUEST['id']) || !isset($_SESSION['dias'])){
    echo "<h1 color='red'> Fluxo quebrado </h1>";
    echo "<h3>Retorne para a página <a href='index.php'>principal</a> </h3>";
}else{
?>

    <h1> Dias disponíveis</h1>
    <p>
    <p>
    <h3> Selecione um dia</h3>
    <?php
    $idServico = $_REQUEST['id'];
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $dias = $_SESSION['dias'];
    ?>
    <form action="../controlers/controlerCarrinho.php?opcao=1&id=<?php echo $idServico;?>" method="post">
        <?php
        foreach ($dias as $dia) {
            echo "<input type='radio' name='pData' value='".formatarData($dia)."'> " . formatarData($dia);
        }
        ?>
        <input type="submit" value="Escolher"> <input type="reset" value="Limpar">
    </form>
<?php
}
echo "</div>";

require_once 'includes/rodape.inc.php';
?>