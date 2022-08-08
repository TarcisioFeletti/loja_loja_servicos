<?php
require_once 'servico.inc.php';
class servicoCarrinho extends Servico
{
    protected $data;

    function __construct(Servico $servico, $nova_data)
    {
        ($this)->servico_id = $servico->get_id_servico();
        ($this)->nome = $servico->get_nome();
        ($this)->preco = $servico->get_valor();
        ($this)->descricao = $servico->get_descricao();
        ($this)->referencia = $servico->get_id_tipo();
        ($this)->data = strtotime(str_replace('/', '-', $nova_data));
    }

    //getters and setters
    function get_data()
    {
        return ($this)->quantidade;
    }

    function set_data($nova_data)
    {
        ($this)->data = strtotime(str_replace('/', '-', $nova_data));
    }
}
?>