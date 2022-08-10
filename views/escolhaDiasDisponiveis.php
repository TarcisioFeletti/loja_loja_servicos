<?php
require_once '../classes/data.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/autenticarMenu.inc.php';
if (!isset($_REQUEST['id']) || !isset($_SESSION['dias'])) {
    echo "<h1 color='red'> Fluxo quebrado </h1>";
    echo "<h3>Retorne para a página <a href='index.php'>principal</a> </h3>";
} else {
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
            $count = 0;
            $mostrou = false;
            foreach ($dias as $dia) {
                if ($dia->get_disponivel()) {
                    if (!isset($_SESSION['carrinho'])) {
                        echo "<p><input type='radio' name='pData' value='" . $count . "'> " . formatarData($dia->get_data_servico());
                        $mostrou = true;
                    } else {
                        $carrinho = $_SESSION['carrinho'];
                        foreach ($carrinho as $item) {
                            if ($item->get_id_servico() == $idServico) {
                                if ($item->get_data()->get_data_servico() == $dia->get_data_servico()) {
                                    echo "<p><input type='radio' name='pData' value='" . $count . "' disabled> " . formatarData($dia->get_data_servico());
                                    $mostrou = true;
                                }
                            }
                        }
                    }
                    if (!$mostrou) {
                        echo "<p><input type='radio' name='pData' value='" . $count . "'> " . formatarData($dia->get_data_servico());
                    }
                    $count++;
                    $mostrou = false;
                } else {
                    echo "<p><input type='radio' name='pData' value='" . $count . "' disabled> " . formatarData($dia->get_data_servico());
                }
            }
            ?>
            <br>
            <input type="hidden" name="opcao" value="1">
            <input type="hidden" name="id" value="<?php echo $idServico ?>">
            <input type="submit" value="Escolher"> <input type="reset" value="Limpar">
        </form>
    <?php
    if (isset($_REQUEST['erro'])) {
        if ($_REQUEST['erro'] == 1) {
            echo "<font color = 'red'><p>Escolha uma data</p></font>";
        }
    }
    echo "</div>";
}
require_once 'includes/rodape.inc.php';
    ?>