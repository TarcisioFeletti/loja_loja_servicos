<?php
require_once 'conexao.inc.php';
require_once '../utils/dataUtil.inc.php';
require_once '../classes/venda.inc.php';
require_once '../classes/cliente.inc.php';
require_once '../classes/servico.inc.php';
require_once '../classes/servicoCarrinho.inc.php';
require_once '../dao/diasDisponiveisDAO.inc.php';

class VendaDAO
{
    private $con;

    function __construct()
    {
        $conexao = new Conexao();
        ($this)->con = $conexao->getConexao();
    }

    public function incluirVenda($venda, $carrinho)
    {
        $sql = ($this)->con->prepare(
            'INSERT INTO vendas (
                id_cliente, 
                valor_total
                ) VALUES (
                :cli, 
                :vt
                )'
        );
        $sql->bindValue(':cli', $venda->get_id_cliente());
        $sql->bindValue(':vt', $venda->get_valor_total());
        $sql->execute();
        $id = ($this)->getIdVenda();
        ($this)->incluirItens($id, $carrinho);
    }

    function incluirItens($idVenda, $carrinho)
    {
        foreach ($carrinho as $item) {
            $sql = ($this)->con->prepare(
                'INSERT INTO item_venda (
                    id_servico, 
                    id_venda
                    ) VALUES (
                    :id_servico, 
                    :id_venda
                )'
            );
            $sql->bindValue(":id_servico", $item->get_id_servico());
            $sql->bindValue(":id_venda", $idVenda);
            $sql->execute();
            $dataDao = new DiasDisponiveisDAO();
            $dataDao->setIndisponivel(conversorData($item->get_data()->get_data_servico()), $item->get_id_servico());
        }
    }

    function getIdVenda()
    { //retorna o ultimo idvenda na tabela
        $sql = ($this)->con->query(
            'SELECT MAX(id_venda) AS maior FROM vendas'
        );
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_OBJ);
        return $row->maior;
    }
}
