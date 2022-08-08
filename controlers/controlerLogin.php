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
    if($usuario == null){
        return null;
    }
    return $usuario->tipo;
}

if ($opcao == 1) {
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
    }else{
        header('Location:../views/formLogin.php?erro=1');
    }
} else if ($opcao == 2) { //logout
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
        unset($_SESSION['logado']);
        unset($_SESSION['tipousuario']);
        if (isset($_SESSION['cliente'])) {
            unset($_SESSION['cliente']);
        }
    }
    header('Location:../views/formLogin.php');
}
