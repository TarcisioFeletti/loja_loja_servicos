<?php
require_once 'conexao.inc.php';
require_once '../classes/tipo.inc.php';

class TipoDAO
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        ($this)->con = $conexao->getConexao();
    }

    public function getTipos()
    {
        $sql = ($this)->con->query(
            "SELECT * FROM tipo;"
        );
        $tipos = array();
        while ($t = $sql->fetch(PDO::FETCH_OBJ)) {
            $tipo = new Tipo();
            $tipo->setAll(
                $t->nome,
                $t->valor
            );
            $tipo->set_id_tipo($t->id_tipo);
            $tipos[] = $tipo;
        }
        return $tipos;
    }

    public function getTipo($id)
    {
        $sql = ($this)->con->prepare(
            "SELECT * FROM tipo WHERE id_tipo = :id;"
        );
        $sql->bindValue(':id', $id);
        $sql->execute();
        $t = $sql->fetch(PDO::FETCH_OBJ);
        $tipo = new Tipo();
        $tipo->setAll(
            $t->nome,
            $t->valor
        );
        $tipo->set_id_tipo($t->id_tipo);
        return $tipo;
    }

    public function incluir(Tipo $tipo)
    {
        $sql = ($this)->con->prepare(
            "INSERT INTO tipo(
                nome,
                valor
                ) VALUES (
                :nome,
                :valor
                )"
        );
        $sql->bindValue(":nome", $tipo->get_nome());
        $sql->bindValue(":valor", $tipo->get_valor());
        $sql->execute();
    }

    public function atualizar(Tipo $tipo)
    {
        $sql = ($this)->con->prepare(
            "UPDATE 
            tipo 
            SET 
            nome = :nome, 
            valor = :valor
            WHERE 
            id_tipo = :id_tipo;"
        );
        $sql->bindValue(":id_tipo", $tipo->get_id_tipo());
        $sql->bindValue(":nome", $tipo->get_nome());
        $sql->bindValue(":valor", $tipo->get_valor());
        $sql->execute();
    }

    public function excluir($id)
    {
        $sql = ($this)->con->prepare(
            "DELETE FROM tipo WHERE id_tipo = :id_tipo);"
        );
        $sql->bindValue(":id_tipo", $id);
        $sql->execute();
    }
}
