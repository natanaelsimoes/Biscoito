<?php

namespace Biscoito\Lib\Util;

/**
 * Classe para Paginação Dinâmica
 * @license     Baseada na classe http://www.catchmyfame.com/2009/08/04/php-pagination-class/
 * @access      publico
 * @author      Cleyton Ferrari <cleyton@w7br.com>,Emerson Soares <emerson@w7br.com>, Melquetaleques Pasian Cerqueira Santos <melquetaleques@w7br.com>, Emerson Soares <emerson@w7br.com>
 * @copyright   W7BR Soluções em Tecnologia - 05/11/2010
 * @version     0.1
 * @example 
 * $total=$bd->RetornaDataSet('select count(*) from tabela');<br />
 * $paginacao=new Paginacao();<br />
 * $paginacao->numPgExibidas=5;<br />
 * $paginacao->totalItens=$total[0][0];<br />
 * $paginacao->Paginar();<br />
 * $retorno=$bd->RetornaDataSet('select * from tabela '.$paginacao->limite);<br />
 * foreach ($retorno as $value) {
 * echo $value[2].'<br />';
 * }
 * echo $paginacao->MostrarPaginas();<br />
 * echo $paginacao->MostrarPularPagina();<br />
 * echo $paginacao->MostrarSelecaoItensPorPagina();<br />
 * * </code>
 */
class TPaginacao {

    /**
     *
     * @var int Número de itens por página.
     */
    public $itensPorPagina;
    /**
     *
     * @var int Número total de itens para a páginação.
     */
    public $totalItens;
    /**
     *
     * @var int Número da página que está sendo exibida.
     */
    private $paginaAtual;
    /**
     *
     * @var int Número de páginas criadas.
     */
    private $numeroPaginas;
    /**
     *
     * @var int Número de páginas exibidas na paginação.
     */
    public $numPgExibidas = 7;
    /**
     *
     * @var int Define o limite mais baixo da paginação.
     */
    public $baixo;
    /**
     *
     * @var int Define o limite mais alto da paginação.
     */
    public $alto;
    /**
     *
     * @var int Define o limite por página.
     */
    public $limite;
    /**
     *
     * @var string Retorna os valores processados para a página.
     */
    public $retorno;
    /**
     *
     * @var int Define a quantidade padrão de registros por página.
     */
    private $quantidadePadrao = 10;
    /**
     *
     * @var string Define outros parametros a serem passados por URL.<br>Ex.&categoria=geral.
     */
    public $queryString;

    /**
     * Inicializa as variáveis de paginação
     */
    function Paginacao() {
        $this->paginaAtual = 1;
        $this->itensPorPagina = (!empty($_GET['quantidade'])) ? $_GET['quantidade'] : $this->quantidadePadrao;
    }

    /**
     * Médoto responsável por realizar a páginação.
     */
    function Paginar() {

        if (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') {
            $this->numeroPaginas = ceil($this->totalItens / $this->quantidadePadrao);
            $this->itensPorPagina = $this->quantidadePadrao;
        } else {
            if (!is_numeric($this->itensPorPagina) OR $this->itensPorPagina <= 0) {

                $this->itensPorPagina = $this->quantidadePadrao;
            }
            $this->numeroPaginas = ceil($this->totalItens / $this->itensPorPagina);
        }

        $this->paginaAtual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 0; // must be numeric > 0


        if ($this->paginaAtual < 1 Or !is_numeric($this->paginaAtual))
            $this->paginaAtual = 1;
        if ($this->paginaAtual > $this->numeroPaginas)
            $this->paginaAtual = $this->numeroPaginas;
        $prev_pagina = $this->paginaAtual - 1;
        $next_pagina = $this->paginaAtual + 1;

        if ($_GET) {
            $args = explode("&", $_SERVER['QUERY_STRING']);
            foreach ($args as $arg) {
                $keyval = explode("=", $arg);
                if ($keyval[0] != "pagina" And $keyval[0] != "quantidade")
                    $this->queryString .= "&" . $arg;
            }
        }

        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if ($key != "pagina" And $key != "quantidade")
                    $this->queryString .= "&$key=$val";
            }
        }

        if ($this->numeroPaginas > 10) {
            $this->retorno = ($this->paginaAtual != 1 And $this->totalItens >= 10) ? "<a class=\"Paginar\" href=\"$_SERVER[PHP_SELF]?pagina=$prev_pagina&quantidade=$this->itensPorPagina$this->queryString\">&laquo;</a> " : "";

            $this->start_range = $this->paginaAtual - floor($this->numPgExibidas / 2);
            $this->end_range = $this->paginaAtual + floor($this->numPgExibidas / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->numeroPaginas) {
                $this->start_range -= $this->end_range - $this->numeroPaginas;
                $this->end_range = $this->numeroPaginas;
            }
            $this->range = range($this->start_range, $this->end_range);

            for ($i = 1; $i <= $this->numeroPaginas; $i++) {
                if ($this->range[0] > 2 And $i == $this->range[0])
                    $this->retorno .= " ... ";
                // loop through all paginas. if first, last, or in range, display
                if ($i == 1 Or $i == $this->numeroPaginas Or in_array($i, $this->range)) {
                    $this->retorno .= ( $i == $this->paginaAtual And (isset($_GET['pagina']) && $_GET['pagina'] != 'Todos')) ? "<a title=\"Vai para a página $i de $this->numeroPaginas\" class=\"current\" href=\"#\">$i</a> " : "<a class=\"Paginar\" title=\"Vai para a página $i de $this->numeroPaginas\" href=\"$_SERVER[PHP_SELF]?pagina=$i&quantidade=$this->itensPorPagina$this->queryString\">$i</a> ";
                }
                if ($this->range[$this->numPgExibidas - 1] < $this->numeroPaginas - 1 And $i == $this->range[$this->numPgExibidas - 1])
                    $this->retorno .= " ... ";
            }
            $this->retorno .= ( ($this->paginaAtual != $this->numeroPaginas And $this->totalItens >= 10) And ((isset($_GET['pagina']) && $_GET['pagina'] != 'Todos') || (!isset($_GET['pagina']))) ) ? "<a class=\"Paginar\" href=\"$_SERVER[PHP_SELF]?pagina=$next_pagina&quantidade=$this->itensPorPagina$this->queryString\"> &raquo;</a>\n" : "";
            //$this->retorno .= ( isset($_GET['pagina']) && $_GET['pagina'] == 'Todos') ? "<a class=\"current\" style=\"margin-left:10px\" href=\"#\">Todos</a> \n" : "<a class=\"Paginar\" style=\"margin-left:10px\" href=\"$_SERVER[PHP_SELF]?pagina=1&quantidade=Todos$this->queryString\">Todos</a> \n";
        }
        else {
            for ($i = 1; $i <= $this->numeroPaginas; $i++) {
                $this->retorno .= ( $i == $this->paginaAtual) ? "<a class=\"current\" href=\"#\">$i</a> " : "<a class=\"Paginar\" href=\"$_SERVER[PHP_SELF]?pagina=$i&quantidade=$this->itensPorPagina$this->queryString\">$i</a> ";
            }
            //$this->retorno .= "<a class=\"Paginar\" href=\"$_SERVER[PHP_SELF]?pagina=1&quantidade=Todos$this->queryString\">Todos</a> \n";
        }
        $this->baixo = ($this->paginaAtual - 1) * $this->itensPorPagina;
        if ($this->baixo<0) {
            $this->baixo=0;
        }
        $this->alto = (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') ? $this->totalItens : ($this->paginaAtual * $this->itensPorPagina) - 1;
        $this->limite = (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') ? "" : " LIMIT $this->baixo,$this->itensPorPagina";
    }
/**
 * Método responsável por processar a a paginação e retornar um array para o template contendo dados de páginação.
 * @return array  Dados necessários na montagem pelo template da barra de paginação.
 * <br />- linkAnterior: Link que retorna para a página anterior.
 * <br />- pontoAnterior: Três pontinhos após a primeira página na barra de paginação quando existem muitas páginas a serem exibidas.
 * <br />- paginaLink: Array contendo a sequencia a sequencia de paginas e os links a serem exibidos.
 * <br />>>>>>- linkPagina: Link para a página na barra de paginação.
 * <br />>>>>>- pagina: Número da página na barra de paginação.
 * <br />- pontoProximo: Três pontinhos antes da última página na barra de paginação quando existem muitas páginas a serem exibidas.
 * <br />- linkProxima: Link que leva a próxima a ser exibida.
 */
    function PaginarParaTemplate() {

        if (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') {

            $this->numeroPaginas = ceil($this->totalItens / $this->quantidadePadrao);
            $this->itensPorPagina = $this->quantidadePadrao;
        } else {

            if (!is_numeric($this->itensPorPagina) OR $this->itensPorPagina <= 0) {

                $this->itensPorPagina = $this->quantidadePadrao;
            }
            $this->numeroPaginas = ceil($this->totalItens / $this->itensPorPagina);
        }

        $this->paginaAtual = (isset($_GET['pagina'])) ? $_GET['pagina'] : 0; // must be numeric > 0


        if ($this->paginaAtual < 1 Or !is_numeric($this->paginaAtual))
            $this->paginaAtual = 1;
        if ($this->paginaAtual > $this->numeroPaginas)
            $this->paginaAtual = $this->numeroPaginas;
        $prev_pagina = $this->paginaAtual - 1;
        $next_pagina = $this->paginaAtual + 1;

        if ($_GET) {
            $args = explode("&", $_SERVER['QUERY_STRING']);
            foreach ($args as $arg) {
                $keyval = explode("=", $arg);
                if ($keyval[0] != "pagina" And $keyval[0] != "quantidade")
                    $this->queryString .= "&" . $arg;
            }
        }

        if ($_POST) {
            foreach ($_POST as $key => $val) {
                if ($key != "pagina" And $key != "quantidade")
                    $this->queryString .= "&$key=$val";
            }
        }

        if ($this->numeroPaginas > 10) {
            $paginacao = array();
            $paginaLink = array();
            $paginacao['linkAnterior'] = ($this->paginaAtual != 1 And $this->totalItens >= 10) ? "$_SERVER[PHP_SELF]?pagina=$prev_pagina&quantidade=$this->itensPorPagina$this->queryString" : "#";

            $this->start_range = $this->paginaAtual - floor($this->numPgExibidas / 2);
            $this->end_range = $this->paginaAtual + floor($this->numPgExibidas / 2);

            if ($this->start_range <= 0) {
                $this->end_range += abs($this->start_range) + 1;
                $this->start_range = 1;
            }
            if ($this->end_range > $this->numeroPaginas) {
                $this->start_range -= $this->end_range - $this->numeroPaginas;
                $this->end_range = $this->numeroPaginas;
            }
            $this->range = range($this->start_range, $this->end_range);

            for ($i = 1; $i <= $this->numeroPaginas; $i++) {
                if ($this->range[0] > 2 And $i == $this->range[0])
                    $paginacao['pontoAnterior'] = " ... ";
                // loop through all paginas. if first, last, or in range, display
                if ($i == 1 Or $i == $this->numeroPaginas Or in_array($i, $this->range)) {
                    $paginaLink[$i]['linkPagina'] = ( $i == $this->paginaAtual And (isset($_GET['pagina']) && $_GET['pagina'] != 'Todos')) ? "#" : "$_SERVER[PHP_SELF]?pagina=$i&quantidade=$this->itensPorPagina$this->queryString";
                    $paginaLink[$i]['pagina'] = $i;
                }
                if ($this->range[$this->numPgExibidas - 1] < $this->numeroPaginas - 1 And $i == $this->range[$this->numPgExibidas - 1])
                    $paginacao['pontoProximo'] = " ... ";
            }
            $paginacao['paginaLink'] = $paginaLink;
            $paginacao['linkProxima'] = ( ($this->paginaAtual != $this->numeroPaginas And $this->totalItens >= 10) And (isset($_GET['pagina']) && $_GET['pagina'] != 'Todos')) ? "$_SERVER[PHP_SELF]?pagina=$next_pagina&quantidade=$this->itensPorPagina$this->queryString" : "#";
            $paginacao['Todos'] = "$_SERVER[PHP_SELF]?pagina=1&quantidade=Todos$this->queryString";
        }
        else {
            for ($i = 1; $i <= $this->numeroPaginas; $i++) {
                $paginaLink[$i]['linkPagina'] = ( $i == $this->paginaAtual) ? "#" : "$_SERVER[PHP_SELF]?pagina=$i&quantidade=$this->itensPorPagina$this->queryString";
                $paginaLink[$i]['pagina'] = $i;
            }
            $paginacao['paginaLink'] = $paginaLink;
            $paginacao['Todos'] = "$_SERVER[PHP_SELF]?pagina=1&quantidade=Todos$this->queryString";
        }
        $this->baixo = ($this->paginaAtual - 1) * $this->itensPorPagina;
        if ($this->baixo<0) {
            $this->baixo=0;
        }
        $this->alto = (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') ? $this->totalItens : ($this->paginaAtual * $this->itensPorPagina) - 1;
        $this->limite = (isset($_GET['quantidade']) && $_GET['quantidade'] == 'Todos') ? "" : " LIMIT $this->baixo,$this->itensPorPagina";

        return $paginacao;
    }
    /**
     * Método responsável por dar a opção de escolha de quantos itens devem aparecer por página.
     * @return string Html de um select com o retorno do método.
     */
    function MostrarSelecaoItensPorPagina() {
      
        $items = '';
        $quantidade_array = array(10, 25, 50, 100, 'Todos');
        foreach ($quantidade_array as $quantidade_opt)
            $items .= ( $quantidade_opt == $this->itensPorPagina) ? "<option selected value=\"$quantidade_opt\">$quantidade_opt</option>\n" : "<option value=\"$quantidade_opt\">$quantidade_opt</option>\n";
        return "<span class=\"paginate\">Items por página:</span><select class=\"Paginar\" onchange=\"window.location='$_SERVER[PHP_SELF]?pagina=$this->paginaAtual&quantidade='+this[this.selectedIndex].value+'$this->queryString';return false\">$items</select>\n";
    }

    /**
     * Método responsável por dar a opção de escolha de quantos itens devem aparecer por página, retornando um array para ser processado pelo template.
     * @return array Contém os valores que montam um select de opções no template:
     * <br />- opcao: array contendo os dados para o select no template:
     * <br />>>>>>- selecionada: Valor selecionado previamente, disponível no array opcao.
     * <br />>>>>>- numPagina: Número de das páginas possiveis de serem exibidas, disponível no array opcao.
     * <br />- linkEscolha: O link para o select determinar qual a página selecionada.
     */
    function MostrarSelecaoItensPorPaginaTemplate() {
        $paginacao = array();
        $opcao = array();
        $items = '';
        $i = 0;
        $quantidade_array = array(10, 25, 50, 100, 'Todos');
        foreach ($quantidade_array as $quantidade_opt) {
            $opcao[$i]['selecionada'] = ( $quantidade_opt == $this->itensPorPagina) ? "selected" : "";
            $opcao[$i]['numPagina'] = $quantidade_opt;
            $i++;
        }
        $paginacao['opcao'] = $opcao;
        $paginacao['linkQuantidade'] = "$_SERVER[PHP_SELF]?pagina=$this->paginaAtual&quantidade='+this[this.selectedIndex].value+'$this->queryString";
        return $paginacao;
    }

    /**
     * Método responsável por dar a opção de escolha de qual página deve ser visualizada.
     * @return string Html de um select com as páginas existentes.
     */
    function MostrarPularPagina() {
        $option = '';
        for ($i = 1; $i <= $this->numeroPaginas; $i++) {
            $option .= ( $i == $this->paginaAtual) ? "<option value=\"$i\" selected>$i</option>\n" : "<option value=\"$i\">$i</option>\n";
        }
        return "<span class=\"Paginar\">Página:</span><select class=\"Paginar\" onchange=\"window.location='$_SERVER[PHP_SELF]?pagina='+this[this.selectedIndex].value+'&quantidade=$this->itensPorPagina$this->queryString';return false\">$option</select>\n";
    }

    /**
     * Método responsável por passar um array com variáveis para escolher qual pagina deve ser visualizada.
     * @return array Contém os valores que montam um select de opções no template:
     * <br />- opcao: array contendo os dados para o select no template:
     * <br />>>>>>- selecionada: Valor selecionado previamente, disponível no array opcao.
     * <br />>>>>>- numPagina: Número de das páginas possiveis de serem exibidas, disponível no array opcao.
     * <br />- linkEscolha: O link para o select determinar qual a página selecionada.
     */
    function MostrarPularPaginaTemplate() {
        $paginacao = array();
        $opcao = array();
        for ($i = 1; $i <= $this->numeroPaginas; $i++) {
            $opcao[$i]['selecionada'] = ( $i == $this->paginaAtual) ? "selected" : "";
            $opcao[$i]['numPagina'] = $i;
        }
        $paginacao['opcao'] = $opcao;
        $paginacao['linkEscolha'] = "$_SERVER[PHP_SELF]?pagina='+this[this.selectedIndex].value+'&quantidade=$this->itensPorPagina$this->queryString";
        return $paginacao;
    }

    /**
     * Método responsável por mostrar a barra de páginação.
     * @return string Html de links de paginação.
     */
    function MostrarPaginas() {
        return $this->retorno;
    }

}