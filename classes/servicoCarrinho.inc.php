<?php
require_once 'servico.inc.php';
require_once 'data.inc.php';
require_once '../utils/dataUtil.inc.php';
class ServicoCarrinho extends Servico
{
    protected Data $data;

    function __construct(Servico $servico, Data $nova_data)
    {
        ($this)->id_servico = $servico->get_id_servico();
        ($this)->nome = $servico->get_nome();
        ($this)->valor = $servico->get_valor();
        ($this)->descricao = $servico->get_descricao();
        ($this)->id_tipo = $servico->get_id_tipo();
        ($this)->data = new Data();
        ($this)->data->setAll($nova_data->get_id_servico(), conversorData($nova_data->get_data_servico()), $nova_data->get_disponivel());
    }

    //getters and setters
    function get_data()
    {
        return ($this)->data;
    }

    function set_data($nova_data)
    {
        //($this)->data = strtotime(str_replace('/', '-', $nova_data)); //ERRADO!!!
    }
}
?>