<?php
require_once 'conexao.inc.php';

class DiasDisponiveisDAO
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        ($this)->con = $conexao->getConexao();
    }

    public function getAllDiasDisponiveisParaServicoComId($id)
    {
        $sql = ($this)->con->prepare("SELECT * FROM datas_disponiveis WHERE id_servico = :id;");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $dias = array();
        while ($d = $sql->fetch(PDO::FETCH_OBJ)) {
            $dias[] = $d;
        }
        return $dias;
    }

    public function excluirDatasDoServicoComOId($id)
    {
        $sql = ($this)->con->prepare("DELETE FROM datas_disponiveis WHERE id_servico = :id;");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function insertDatas($datas, $id)
    {
        foreach ($datas as $data) {
            $sql = ($this)->con->prepare("INSERT INTO datas_disponiveis(id_servico, data_servico, disponivel) 
        VALUES (:id, :dt, :disp)");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":dt", $data);
            $sql->bindValue(":disp", 1);
            $sql->execute();
        }
    }

    public function getTipo($id)
    {
        $sql = ($this)->con->prepare("SELECT nome FROM tipo WHERE id_tipo = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $tipo = $sql->fetch(PDO::FETCH_OBJ);

        //var_dump($fab);
        return $tipo->nome;
    }

    public function getMaxTipo()
    {
        $sql = ($this)->con->query("SELECT nome, MAX(tipo) FROM tipo GROUP BY nome");

        $tipo = $sql->fetch(PDO::FETCH_OBJ);

        //var_dump($fab);
        return $tipo->nome;
    }
}
