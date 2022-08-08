<?php
require_once 'conexao.inc.php';
require_once '../classes/cliente.inc.php';
require_once '../utils/dataUtil.inc.php';

class ClienteDAO
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        ($this)->con = $conexao->getConexao();
    }

    function autenticar($email, $senha)
    {
        $sql = ($this)->con->prepare(
            "SELECT * FROM clientes WHERE email = :usr AND senha = :pass"
        );
        $email = strtolower($email);
        $senha = strtolower($senha);
        $sql->bindValue(':usr', $email);
        $sql->bindValue(':pass', $senha);
        $sql->execute();
        $sql2 = ($this)->con->prepare(
            "SELECT * FROM usuarios WHERE login = :usr AND senha = :pass"
        );
        $sql2->bindValue(':usr', $email);
        $sql2->bindValue(':pass', $senha);
        $sql2->execute();
        if ($sql->rowCount() > 0 && $sql2->rowCount() > 0) {
            $c = $sql->fetch(PDO::FETCH_OBJ);
            $cliente = new Cliente();
            $cliente->setAll($c->nome, $c->endereco, $c->telefone, $c->cpf, $c->dt_nascimento, $c->email, $c->senha);
            $cliente->set_id_cliente($c->id_cliente);
            return $cliente;
        } else {
            return NULL;
        }
    }

    function incluirCliente(Cliente $cliente)
    {
        $sql = ($this)->con->prepare(
            "INSERT INTO `clientes` (
                `nome`, 
                `endereco`, 
                `telefone`, 
                `cpf`, 
                `dt_nascimento`, 
                `email`, 
                `senha`
            ) VALUES (
                :nome, 
                :endereco, 
                :tel, 
                :cpf, 
                :dt, 
                :email, 
                :senha
            );"
        );
        $sql->bindValue(':nome', $cliente->get_nome());
        $sql->bindValue(':endereco', $cliente->get_endereco());
        $sql->bindValue(':tel', $cliente->get_telefone());
        $sql->bindValue(':cpf', $cliente->get_cpf());
        $sql->bindValue(':dt', conversorData($cliente->get_dt_nascimento()));
        $login = strtolower($cliente->get_email());
        $senha = strtolower($cliente->get_senha());
        $sql->bindValue(':email', $login);
        $sql->bindValue(':senha', $senha);
        $sql->execute();
        $sql = ($this)->con->prepare(
            "INSERT INTO usuarios(
                login, 
                senha,
                tipo
            ) VALUES (
                :login, 
                :senha,
                :tipo
            );"
        );
        $sql->bindValue(":login", $login);
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":tipo", 2);
        $sql->execute();
    }

    public function getClientes()
    {
        $sql = ($this)->con->query(
            "SELECT * FROM clientes;"
        );
        $clientes = array();
        while ($c = $sql->fetch(PDO::FETCH_OBJ)) {
            $cliente = new Cliente();
            $cliente->setAll($c->nome, $c->endereco, $c->telefone, $c->cpf, $c->dt_nascimento, $c->email, $c->senha);
            $cliente->set_id_cliente($c->id_cliente);
            $clientes[] = $cliente;
        }
        return $clientes;
    }

    public function getCliente($id)
    {
        $sql = ($this)->con->prepare(
            "SELECT * FROM clientes WHERE id_cliente = :id_cliente"
        );
        $sql->bindValue(":id_cliente", $id);
        $sql->execute();
        $c = $sql->fetch(PDO::FETCH_OBJ);
        $cliente = new Cliente();
        $cliente->setAll($c->nome, $c->endereco, $c->telefone, $c->cpf, $c->dt_nascimento, $c->email, $c->senha);
        $cliente->set_id_cliente($c->id_cliente);
        return $cliente;
    }

    public function excluirCliente($id)
    {
        $cliente = ($this)->getCliente($id);
        $sql = ($this)->con->prepare(
            "UPDATE FROM clientes SET data_exclusao = :data_exclusao WHERE id_cliente = :id_cliente"
        );
        $sql->bindValue(":id_cliente", $id);
        $sql->bindValue(":data_exclusao", conversorData(time()));
        $sql->execute();
        $sql = ($this)->con->prepare(
            "DELETE FROM usuarios WHERE login = :login AND senha = :senha AND tipo = :tipo);"
        );
        $sql->bindValue(":login", $cliente->get_email());
        $sql->bindValue(":senha", $cliente->get_senha());
        $sql->bindValue(":tipo", 2);
        $sql->execute();
    }

    public function atualizarCliente(Cliente $cliente)
    {
        session_start();
        $antigoCliente = $_SESSION['cliente'];
        $sql = ($this)->con->prepare(
            "UPDATE 
            clientes 
            SET 
            nome = :nome, 
            endereco = :endereco,
            telefone = :telefone,
            cpf = :cpf, 
            dt_nascimento = :dt_nascimento,
            email = :email, 
            senha = :senha
            WHERE 
            id_cliente = :id_cliente"
        );
        $sql->bindValue(":id_cliente", $cliente->get_id_cliente());
        $sql->bindValue(":nome", $cliente->get_nome());
        $sql->bindValue(":endereco", $cliente->get_endereco());
        $sql->bindValue(":cpf", $cliente->get_cpf());
        $sql->bindValue(":telefone", $cliente->get_telefone());
        $sql->bindValue(":dt_nascimento", conversorData($cliente->get_dt_nascimento()));
        $sql->bindValue(":email", $cliente->get_email());
        $sql->bindValue(":senha", $cliente->get_senha());
        $sql->execute();
        $sql = ($this)->con->prepare(
            "UPDATE usuarios 
            SET 
            login = :login,
            senha = :senha
            WHERE 
            login = :oldlogin AND
            senha = :oldsenha AND
            tipo = :tipo;"
        );
        $sql->bindValue(":login", $cliente->get_email());
        $sql->bindValue(":senha", $cliente->get_senha());
        $sql->bindValue(":oldlogin", $antigoCliente->get_email());
        $sql->bindValue(":oldsenha", $antigoCliente->get_senha());
        $sql->bindValue(":tipo", 2);
        $sql->execute();
    }
}
