<?php
require_once '../classes/servico.inc.php';
require_once '../dao/servicoDAO.inc.php';
require_once '../dao/tipoDAO.inc.php';
require_once '../dao/diasDisponiveisDAO.inc.php';

function uploadFotos($ref)
{
    $imagem = $_FILES["imagem"];
    $nome = $ref;
    if ($imagem != NULL) {
        $nome_temporario = $_FILES["imagem"]["tmp_name"];
        copy($nome_temporario, "../views/imagens/produtos/$nome.jpg");
    } else {
        echo "Você não realizou o upload de forma satisfatória.";
    }
}

function deletarFoto($ref)
{
    $arquivo = "../views/imagens/produtos/$ref.jpg";
    if (file_exists($arquivo)) {
        if (!unlink($arquivo)) {
            echo "Não foi possível deletar o arquivo!";
        }
    }
}

$opcao = (int)$_REQUEST['opcao'];

if ($opcao == 1) { //inclusão
    $datas = array();
    for ($i = 1; $i <= 7; $i++) {
        if (!empty($_REQUEST['pData' . $i])) {
            $datas[] = $_REQUEST['pData' . $i];
        }
    }
    $novoServico = new Servico();
    $novoServico->setAll(
        $_REQUEST['pNome'],
        $_REQUEST['pValor'],
        $_REQUEST['pDescricao'],
        $_REQUEST['pTipo']
    );
    $servicoDao = new ServicoDAO();
    $servicoDao->incluirServico($novoServico);
    $diasDao = new DiasDisponiveisDAO();
    $idServico = $servicoDao->getLastServicoId();
    $diasDao->insertDatas($datas, $idServico);
    if (isset($_REQUEST['imagem'])) {
        uploadFotos($idServico);
    }
    header('Location:controlerServico.php?opcao=2');
} else if ($opcao == 2 || $opcao == 6) {
    $servicoDao = new ServicoDAO();
    session_start();
    $_SESSION['servicos'] = $servicoDao->getServicos();
    if ($opcao == 2) {
        header('Location:../views/exibirServicos.php');
    } else { //opcao == 6
        header('Location:../views/servicosVenda.php');
    }
} else if ($opcao == 3) { //enviar para a tela de atualizar
    $id = (int)$_REQUEST['id'];
    $servicoDao = new ServicoDAO();
    $servico = $servicoDao->getServico($id);
    session_start();
    $_SESSION['servico'] = $servico;
    $tipoDao = new TipoDAO();
    $_SESSION['tipos'] = $tipoDao->getTipos();
    $diasDao = new DiasDisponiveisDAO();
    $_SESSION['datas'] = $diasDao->getAllDiasDisponiveisParaServicoComId($servico->get_id_servico());
    header("Location:../views/formServicoAtualizar.php");
} else if ($opcao == 4) {
    $id = (int)$_REQUEST['id'];
    $servicoDao = new ServicoDAO();
    deletarFoto($servicoDao->getServico($id)->get_id_servico());
    $servicoDao->excluirServico($id);
    header('Location:controlerServico.php?opcao=2');
} else if ($opcao == 5) {
    $servico = new Servico();
    $servico->setAll($_REQUEST['pNome'], $_REQUEST['pValor'], $_REQUEST['pDescricao'], $_REQUEST['pTipo']);
    $servico->set_id_servico($_REQUEST['pId']);
    $servicoDao = new ServicoDAO();
    $servicoDao->atualizarServico($servico);
    $datas = array();
    for ($i = 1; $i <= 7; $i++) {
        if (!empty($_REQUEST['pData' . $i])) {
            $datas[] = $_REQUEST['pData' . $i];
        }
    }
    $diasDao = new DiasDisponiveisDAO();
    $diasDao->atualizarDatas($datas, $servico->get_id_servico());
    header('Location:controlerServico.php?opcao=2');
} else if ($opcao == 7) {
    $pagina = (int)$_REQUEST['pagina'];
    $servicoDao = new ServicoDAO();
    $lista = $servicoDao->getServicosPaginacao($pagina);
    $numPaginas = $servicoDao->getPagina();
    session_start();
    $_SESSION['servicos'] = $lista;
    header("Location:../views/servicosVenda.php?paginas=" . $numPaginas);
} else if ($opcao == 8) {
    $servicoDao = new ServicoDAO();
    $servicoDao->incluirVariosServicos();
    header("Location:controlerServico.php?opcao=2");
} else if ($opcao == 9) {
    $pagina = (int)$_REQUEST['pagina'];
    $servicoDao = new ServicoDAO();
    session_start();
    var_dump($_REQUEST['pBusca']);
    if (isset($_REQUEST['pBusca']) && $_REQUEST['pBusca'] != null) {
        $busca = $_REQUEST['pBusca'];
        $lista = $servicoDao->getServicosPaginacaoBusca($pagina, $busca);
        $numPaginas = $servicoDao->getPaginaBusca($busca);
        session_start();
        $_SESSION['servicos'] = $lista;
        if (sizeof($lista) == 0) {
            header("Location:../views/servicosVendaBusca.php?paginas=" . $numPaginas . "&pBusca=" . $busca . "&erro=1");
        } else {
            header("Location:../views/servicosVendaBusca.php?paginas=" . $numPaginas . "&pBusca=" . $busca);
        }
    } else {
        $lista = $servicoDao->getServicosPaginacao($pagina);
        $numPaginas = $servicoDao->getPagina();
        session_start();
        $_SESSION['servicos'] = $lista;
        header("Location:../views/servicosVendaBusca.php?paginas=" . $numPaginas);
    }
}
