<?php
require_once '../classes/servico.inc.php';
require_once 'conexao.inc.php';
require_once 'tipoDAO.inc.php';
require_once 'diasDisponiveisDAO.inc.php';
require_once '../utils/dataUtil.inc.php';

class ServicoDAO
{
    private $con; //constrola a conexão do BD
    private $porPagina;

    function __construct()
    {
        $conexao = new Conexao();
        ($this)->con = $conexao->getConexao();
        ($this)->porPagina = 12; //valor de exibição padrão
    }

    public function incluirVariosServicos()
    {
        for ($i = 1; $i <= 100; $i++) {
            $sql = ($this)->con->prepare("INSERT INTO servicos (nome, valor, descricao, id_tipo) 
            VALUES (:n, :v, :d, :id_t)");
            $sql->bindValue(':n', 'nome ' . $i);
            $sql->bindValue(':d', 'descricao do serviço ' . $i);
            $sql->bindValue(':v', 10 + (2 * $i));
            $tipoDao = new TipoDAO();
            $sql->bindValue(':id_t', $tipoDao->getMaxTipo());
            $sql->execute();
            $diasDao = new DiasDisponiveisDAO();
            $datas = array();
            $datas[] = '2022-08-08';
            $datas[] = '2022-08-09';
            $datas[] = '2022-08-10';
            $diasDao->insertDatas($datas, ($this)->getLastServicoId());
        }
    }

    public function getPagina()
    {
        $resultTotal = $this->con->query("SELECT count(*) AS total FROM servicos")->fetch(PDO::FETCH_OBJ);
        $numPaginas = ceil($resultTotal->total / $this->porPagina);
        return $numPaginas;
    }

    public function getServicosPaginacao($pagina)
    {
        $init = ($pagina - 1) * ($this)->porPagina;
        $result = ($this)->con->query("SELECT * FROM servicos LIMIT $init, $this->porPagina");
        $lista = array();
        while ($s = $result->fetch(PDO::FETCH_OBJ)) {
            $servico = new Servico();
            $servico->setAll($s->nome, $s->valor, $s->descricao, $s->id_tipo);
            $servico->set_id_servico($s->id_servico);
            $lista[] = $servico;
        }
        return $lista;
    }

    public function getPorPagina()
    {
        return ($this)->porPagina;
    }

    public function setPorPagina($novoPorPagina)
    {
        ($this)->porPagina = $novoPorPagina;
    }

    public function incluirServico(Servico $servico)
    {
        $sql = ($this)->con->prepare("INSERT INTO servicos(nome, valor, descricao, id_tipo) 
        VALUES (:nome, :preco, :descricao, :id_tipo)");
        $sql->bindValue(":nome", $servico->get_nome());
        $sql->bindValue(":preco", $servico->get_valor());
        $sql->bindValue(":descricao", $servico->get_descricao());
        $sql->bindValue(":id_tipo", $servico->get_id_tipo());
        $sql->execute();
    }

    public function getServicos()
    {
        $sql = ($this)->con->query("SELECT * FROM servicos;");
        $servicos = array();
        while ($s = $sql->fetch(PDO::FETCH_OBJ)) {
            $servico = new Servico();
            $servico->setAll($s->nome,$s->valor,$s->descricao,$s->id_tipo);
            $servico->set_id_servico($s->id_servico);
            $servicos[] = $servico;
        }
        return $servicos;
    }

    public function excluirServico($id_servico)
    {
        $diasDao = new DiasDisponiveisDAO();
        $diasDao->excluirDatasDoServicoComOId($id_servico);
        $sql = ($this)->con->prepare("DELETE FROM servicos WHERE id_servico = :id");
        $sql->bindValue(":id", $id_servico);
        $sql->execute();
    }

    public function getServico($id)
    { //parte do pressuposto que o produto existe no DB
        $sql = ($this)->con->prepare("SELECT * FROM servicos WHERE id_servico = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $s = $sql->fetch(PDO::FETCH_OBJ);
        $servico = new Servico();
        $servico->setAll($s->nome, $s->valor, $s->descricao, $s->id_tipo);
        $servico->set_id_servico($s->id_servico);
        return $servico;
    }

    public function getLastServicoId()
    { //parte do pressuposto que o produto existe no DB
        $sql = ($this)->con->query("SELECT Max(id_servico) AS maior FROM servicos");
        $sql->execute();
        $s = $sql->fetch(PDO::FETCH_OBJ);
        return $s->maior;
    }

    public function atualizarServico(Servico $servico)
    {
        $sql = ($this)->con->prepare(
            "UPDATE 
            servicos 
            SET 
            nome = :nome,
            valor = :preco, 
            descricao = :descricao, 
            id_tipo = :id_tipo
            WHERE 
            id_servico = :id_servico"
        );
        $sql->bindValue(":nome", $servico->get_nome());
        $sql->bindValue(":preco", $servico->get_valor());
        $sql->bindValue(":descricao", $servico->get_descricao());
        $sql->bindValue(":id_tipo", $servico->get_id_tipo());
        $sql->bindValue(":id_servico", $servico->get_id_servico());
        $sql->execute();
    }
}
