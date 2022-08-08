<?php
class Cliente
{
    private $id_cliente;
    private $nome;
    private $endereco;
    private $telefone;
    private $cpf;
    private $dt_nascimento;
    private $dt_exclusao;
    private $email;
    private $senha;

    function __construct()
    {
        ($this)->dt_exclusao = null;
    }
    function setAll(
        $novo_nome,
        $novo_endereco,
        $novo_telefone,
        $novo_cpf,
        $novo_dt_nascimento,
        $novo_email,
        $novo_senha
    ) {
        ($this)->nome = $novo_nome;
        ($this)->endereco = $novo_endereco;
        ($this)->telefone = $novo_telefone;
        ($this)->cpf = $novo_cpf;
        ($this)->dt_nascimento = strtotime(str_replace('/', '-', $novo_dt_nascimento));
        ($this)->email = $novo_email;
        ($this)->senha = $novo_senha;
    }

    function set_id_cliente($novo_id_cliente)
    {
        $this->id_cliente = $novo_id_cliente;
    }
    function get_id_cliente()
    {
        return $this->id_cliente;
    }
    function set_nome($novo_nome)
    {
        $this->nome = $novo_nome;
    }
    function get_nome()
    {
        return $this->nome;
    }
    function set_endereco($novo_endereco)
    {
        $this->endereco = $novo_endereco;
    }
    function get_endereco()
    {
        return $this->endereco;
    }
    function set_telefone($novo_telefone)
    {
        $this->telefone = $novo_telefone;
    }
    function get_telefone()
    {
        return $this->telefone;
    }
    function set_cpf($novo_cpf)
    {
        $this->cpf = $novo_cpf;
    }
    function get_cpf()
    {
        return $this->cpf;
    }
    function set_dt_exclusao($novo_dt_exclusao)
    {
        $this->dt_exclusao = strtotime(str_replace('/', '-', $novo_dt_exclusao));
    }
    function get_dt_exclusao()
    {
        return $this->dt_exclusao;
    }
    function set_dt_nascimento($novo_dt_nascimento)
    {
        $this->dt_nascimento = strtotime(str_replace('/', '-', $novo_dt_nascimento));
    }
    function get_dt_nascimento()
    {
        return $this->dt_nascimento;
    }
    function set_email($novo_email)
    {
        $this->email = $novo_email;
    }
    function get_email()
    {
        return $this->email;
    }
    function set_senha($novo_senha)
    {
        $this->senha = $novo_senha;
    }
    function get_senha()
    {
        return $this->senha;
    }
}
