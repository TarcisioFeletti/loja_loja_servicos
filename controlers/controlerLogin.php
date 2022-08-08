<?php
require_once '../dao/conexao.inc.php';
require_once '../classes/cliente.inc.php';
require_once '../dao/clienteDAO.inc.php';

$opcao = $_REQUEST['opcao'];

function efetuarLogin($login, $senha)
{
    $con = new Conexao();
    $conexao = $con->getConexao();
    $sql = $conexao->prepare("SELECT * FROM usuarios WHERE login = :usr AND senha = :pass");
    $login = strtolower($login);
    $senha = strtolower($senha);
    $sql->bindValue(':usr', $login);
    $sql->bindValue(':pass', $senha);
    $sql->execute();
    $usuario = $sql->fetch(PDO::FETCH_OBJ);
    return $usuario;
}

if ($opcao == 1) {
    $tipo = $_REQUEST['pTipo'];
    $login = $_REQUEST['pLogin'];
    $senha = $_REQUEST['pSenha'];
    $logado = efetuarLogin($login, $senha);
    if ($logado == "1") {
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['tipousuario'] = '1';
        header('Location:../views/index.php');
    } else if ($logado == "2") {
        session_start();
        $_SESSION['logado'] = true;
        $_SESSION['tipousuario'] = '2';
        $clienteDao = new ClienteDAO();
        $_SESSION['cliente'] = $clienteDao->autenticar($login, $senha);
        header('Location:../views/index.php');
    }
}
