<?php
require_once 'includes/autenticarMenu.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/iniciarSessao.inc.php';
if(!isset($_REQUEST['id']) || !isset($_SESSION['dias'])){
    echo "<h1 color='red'> Fluxo quebrado </h1>";
    echo "<h3>Retorne para a página <a href='index.php'>principal</a> </h3>";
}else{
?>
    <div class="container-fluid pt-5" align="center">
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
    <form action="../controlers/controlerCarrinho.php" method="post">
        <?php
        foreach ($dias as $dia) {
            if($dia->disponivel){
            echo "<p><input type='radio' name='pData' value='". $dia->data_servico ."'> " . formatarData(strtotime($dia->data_servico));
            }else{
                echo "<p><input type='radio' name='pData' value='". $dia->data_servico ."' disabled> " . formatarData(strtotime($dia->data_servico));
            }
        }
        ?>
        <br>
        <input type="hidden" name="opcao" value="1">
        <input type="hidden" name="id" value="<?php echo $idServico ?>">
        <input type="submit" value="Escolher"> <input type="reset" value="Limpar">
    </form>
    </div>
<?php
}
require_once 'includes/rodape.inc.php';
?>