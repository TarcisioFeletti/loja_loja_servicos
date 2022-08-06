<?php
class Venda
{
    private $id_venda;
    private $id_cliente;
    private $valor_total;

    function __construct($id_cliente, $valor)
    {
        ($this)->id_cliente = $id_cliente;
        ($this)->valor_total = $valor;
    }

    public function get_id_venda()
    {
        return ($this)->id_venda;
    }

    public function set_id_venda($novo_id)
    {
        ($this)->id_venda = $novo_id;
    }

    public function get_id_cliente()
    {
        return ($this)->id_cliente;
    }

    public function set_id_cliente($novo_id_cliente)
    {
        ($this)->id_cliente = $novo_id_cliente;
    }

    public function get_valor_total()
    {
        return ($this)->valor_total;
    }

    public function set_valor_total($novo_valorTotal)
    {
        ($this)->valor_total = $novo_valor_total;
    }
}
