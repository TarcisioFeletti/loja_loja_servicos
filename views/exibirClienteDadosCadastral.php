<?php
require_once 'includes/autenticar.inc.php';
require_once 'includes/autenticarMenu.inc.php';
require_once '../classes/cliente.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once 'includes/iniciarSessao.inc.php';
$cliente = $_SESSION['cliente'];
?>
<div class="corpo" align="center" style="line-height: 3em;">
    <h2>Dados Cadastrais</h2>
    <p>
    <p>ID: <?php echo $cliente->get_id_cliente() ?>
    <p>Nome: <?php echo $cliente->get_nome() ?>
    <p>Endereço: <?php echo $cliente->get_endereco() ?>
    <p>Telefone: <?php echo $cliente->get_telefone() ?>
    <p>CPF: <?php echo $cliente->get_cpf() ?>
    <p>Data de Nascimento: <?php echo conversorData($cliente->dt_nascimento()) ?>
    <p>E-mail: <?php echo $cliente->get_email() ?>
    <p>
    <p>Deseja excluir sua conta? Clique <a href='../controlers/controlerCliente.php?opcao=5'>aqui</a>!
</div>
<?php
require_once 'includes/rodape.inc.php';
?>