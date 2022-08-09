<?php
require_once '../classes/cliente.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarMenu.inc.php';
$cliente = $_SESSION['cliente'];
?>
<div class="corpo"  style="line-height: 3em;">
    <h2 align="center">Dados Cadastrais</h2>
    <p>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item">ID: <?php echo $cliente->get_id_cliente() ?></li>
            <li class="list-group-item">Nome: <?php echo $cliente->get_nome() ?></li>
            <li class="list-group-item">Endereço: <?php echo $cliente->get_endereco() ?></li>
            <li class="list-group-item">Telefone: <?php echo $cliente->get_telefone() ?></li>
            <li class="list-group-item">CPF: <?php echo $cliente->get_cpf() ?></li>
            <li class="list-group-item">Data de Nascimento: <?php echo formatarData($cliente->get_dt_nascimento()) ?></li>
            <li class="list-group-item">E-mail: <?php echo $cliente->get_email() ?></li>
        </ul>
        <p align="center">Deseja excluir sua conta? Clique <a href='../controlers/controlerCliente.php?opcao=5'>aqui</a>!
    </div>

</div>


<?php
require_once 'includes/rodape.inc.php';
?>