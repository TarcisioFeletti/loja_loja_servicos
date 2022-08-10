<?php
class Tipo
{
    protected $id_tipo;
    protected $nome;
    protected $valor;

    function setAll(
        $novo_nome,
        $novo_valor
    ) {
        ($this)->nome = $novo_nome;
        ($this)->valor = $novo_valor;
    }

    function get_id_tipo()
    {
        return ($this)->id_tipo;
    }

    function set_id_tipo($novo_id_tipo)
    {
        ($this)->id_tipo = $novo_id_tipo;
    }

    function get_nome()
    {
        return ($this)->nome;
    }

    function set_nome($novo_nome)
    {
        ($this)->nome = $novo_nome;
    }

    function get_valor()
    {
        return ($this)->valor;
    }

    function set_valor($novo_valor)
    {
        ($this)->valor = $novo_valor;
    }
}
