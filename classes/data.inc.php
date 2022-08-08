<?php
class Data
{
    protected $id_disponibilidade;
    protected $id_servico;
    protected $data_servico;
    protected $disponivel;

    //metodo para setar todos os valores
    function setAll(
        $novo_id_servico,
        $novo_data_servico,
        $novo_disponivel
    ) {
        ($this)->id_servico = $novo_id_servico;
        ($this)->data_servico = strtotime(str_replace('/', '-', $novo_data_servico));
        ($this)->disponivel = $novo_disponivel;
    }

    //getters and setters
    function get_id_disponibilidade()
    {
        return ($this)->id_disponibilidade;
    }

    function set_id_disponibilidade($novo_id_disponibilidade)
    {
        ($this)->id_disponibilidade = $novo_id_disponibilidade;
    }

    function get_id_servico()
    {
        return ($this)->id_servico;
    }

    function set_id_servico($novo_id_servico)
    {
        ($this)->id_servico = $novo_id_servico;
    }

    function get_data_servico()
    {
        return ($this)->data_servico;
    }

    function set_data_servico($novo_data_servico)
    {
        ($this)->data_servico = strtotime(str_replace('/', '-', $novo_data_servico));
    }

    function get_disponivel()
    {
        return ($this)->disponivel;
    }

    function set_disponivel($novo_disponivel)
    {
        ($this)->disponivel = $novo_disponivel;
    }
}
?>