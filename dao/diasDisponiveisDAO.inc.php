<?php
require_once 'conexao.inc.php';
require_once '../classes/data.inc.php';

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
            $data = new Data();
            $data->setAll($d->id_servico, $d->data_servico, $d->disponivel);
            $data->set_id_disponibilidade($d->id_disponibilidade);
            $dias[] = $data;
        }
        return $dias;
    }

    public function getData($data, $id)
    {
        $sql = ($this)->con->prepare("SELECT * FROM datas_disponiveis WHERE id_servico = :id AND data_servico = :dt;");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":dt", $data);
        $sql->execute();
        $data = new Data();
        $d = $sql->fetch(PDO::FETCH_OBJ);
        $data->setAll($d->id_servico, $d->data_servico, $d->disponivel);
        $data->set_id_disponibilidade($d->id_disponibilidade);
        return $sql->fetch;
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

    public function atualizarDatas($datas, $id)
    {
        $sql = ($this)->con->prepare(
            "DELETE 
            FROM
            datas_disponiveis 
            WHERE 
            id_servico= :id"
        );
        $sql->bindValue(":id", $id);
        $sql->execute();
        $this->insertDatas($datas, $id);
    }

    public function getTipo($id)
    {
        $sql = ($this)->con->prepare("SELECT nome FROM tipo WHERE id_tipo = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $tipo = $sql->fetch(PDO::FETCH_OBJ);

        return $tipo->nome;
    }

    public function getMaxTipo()
    {
        $sql = ($this)->con->query("SELECT nome, MAX(tipo) FROM tipo GROUP BY nome");

        $tipo = $sql->fetch(PDO::FETCH_OBJ);

        return $tipo->nome;
    }

    public function setIndisponivel($data, $idServico)
    {
        $sql = ($this)->con->prepare(
            "UPDATE
            datas_disponiveis 
            SET
            disponivel = 0
            WHERE 
            id_servico = :id
            AND
            data_servico = :dt"
        );
        $sql->bindValue(":id", $idServico);
        $sql->bindValue(":dt", $data);
        $sql->execute();
    }

    public function setDisponivel($data, $idServico)
    {
        $sql = ($this)->con->prepare(
            "UPDATE
            datas_disponiveis 
            SET
            disponivel = 1
            WHERE 
            id_servico = :id
            AND
            data_servico = :dt"
        );
        $sql->bindValue(":id", $idServico);
        $sql->bindValue(":dt", $data);
        $sql->execute();
    }
}
