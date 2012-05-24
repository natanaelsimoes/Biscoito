<?php

/**
 * FUNCOES GLOBAIS :: VETOR
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2010 Natanael Simoes
 *
 * DESCRICAO
 *
 * Conjunto de funcoes para tratamento de matrizes multidimensionais e celulares
 * com suporte a arrays provenientes de consultas SQL do tipo:
 *
 * Array(
 *      [0] => Array([CAMPO1] => 'valor1', [CAMPO2] => 'valor2'),
 *      [1] => Array([CAMPO1] => 'valor1', [CAMPO2] => 'valor2')
 *   )
 *
 * @package     Funcoes Globais
 * @subpackage  Vetor
 * @category    Functions
 * @author      Natanael Simoes <natanael@fabricadecodigo.com.br>
 * @copyright   Copyright (c) 2010 Natanael Simoes
 * @license     http://www.opensource.org/licenses/lgpl-3.0.html LGPLv3
 * @version     1.04
 * @link        http://www.fabricadecodigo.com.br/
 */
class CMS_Vetor {

    // <editor-fold defaultstate="collapsed" desc="#Atributos">
    /**
     * Array do objeto
     * @var mixed
     * @access private
     */
    public $dados;
    /**
     * Quantidade de itens no primeiro nivel do array
     * @var integer
     * @access public
     */
    public $Tamanho;

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="function __construct($_ = null)">
    /**
     * Inicializa um objeto de GF_Vetor.
     * Inicie colocando valores atraves dos parametros deste construtor.
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $_ (opcional)
     */
    function __construct($_ = null) {

        $this->dados = array();

        $dados = func_get_args();

        if (!is_null($dados))
            call_user_method_array('Adicionar', $this, $dados);

        else
            $this->Tamanho = 0;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="private function __calcularTamanho()">
    /**
     * Calcula a quantidade de itens na primeira dimensao do array
     *
     * Ultima revisao: 14/11/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     */
    private function __calcularTamanho() {
        $this->Tamanho = count($this->dados);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="private function __procurar($valor, $chave, $chaveRetorno, $quantidade, $nivel, $retornarMaster, $sensibilidade, $contem, $array)">
    /**
     * Faz busca num array, permitindo ao usuario realizar buscar personalizadas
     * com as opcoes paremetrizadas. Quando o nivel nao for especificado, o metodo
     * buscara recursivamente em todas dimensoes do array.
     *
     * Ultima revisao: 14/11/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valor O valor que sera procurado
     * @param mixed $chave A chave onde o valor sera procurado. NULL indica que sera procurado em todas as chaves
     * @param mixed $chaveRetorno Indica de qual chave sera retirado o valor de retorno. NULL indica que sera o valor de $key. USE APENAS SE O ROW_MODE ESTIVER DESABILITADO!
     * @param integer $quantidade A quantidade de registros que deseja receber. -1 caso queira voltar todos os registros encontrados.
     * @param integer $nivel A quantidade de niveis que o codigo deve procurar. -1 caso queira percorrer todos os niveis do array.
     * @param bool $retornarMaster Modo de retorno que traz toda a linha onde o item foi encontrada, como num banco de dados. FALSE para retornar apenas o registro encontrado.
     * @param bool $sensibilidade A busca sera realiza de forma sensivel diferenciando maiusculas de minusculas. FALSE para fazer a procura independentemente do case.
     * @param bool $igual Modo em que toda a setenca deve ser igual para que o registro seja incluido. FALSE faz a busca em qualquer parte do valor do registro (equivalente ao LIKE '%valor%' em SQL).
     * @param mixed $array Array onde sera feita a busca.
     * @return mixed Um array contendo os valores encontrados na busca.
     */
    private function __procurar($valor, $chave, $chaveRetorno, $quantidade, $nivel, $retornarMaster, $sensibilidade, $igual, $array) {

        if (is_array($array)) {

            $return_array = array();

            $chaveRetorno = (is_null($chaveRetorno)) ? $chave : $chaveRetorno;

            foreach ($array as $keyGF => $valueGF) {

                if (( $nivel < 0 & is_array($valueGF) ) | ( $nivel > 1 & is_array($valueGF) )) {

                    foreach ($this->__procurar($valor, $chave, $chaveRetorno, $quantidade, $nivel - 1, $retornarMaster, $sensibilidade, $igual, $valueGF) as $rowGF)
                        $return_array[$keyGF] = $rowGF;
                } else if (
                        ($chave == null | $keyGF == $chave) &&
                        (
                        ( $sensibilidade & ( ( $igual & $valueGF == $valor ) | (!$igual & strpos($valueGF, $valor) !== false ) ) )
                        ||
                        (!$sensibilidade & ( ( $igual & strtoupper($valueGF) == strtoupper($valor) ) | (!$igual & stripos($valueGF, $valor) !== false ) ) )
                        )
                ) {
                    if (!$retornarMaster) {

                        if (is_null($chaveRetorno))
                            $return_array[$keyGF] = $valueGF;

                        else
                            $return_array[$keyGF] = $array[$chaveRetorno];
                    }
                    else
                        $return_array[] = $array;
                }

                if ($quantidade != -1 & count($return_array) >= $quantidade) {
                    return $return_array;
                }
            }

            return $return_array;
        }
        else
            return $array;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="private function __organizar($ordem = SORT_ASC, $chave = null, $arrayOrdenar = null)">
    /**
     * Ordena os dados do array
     *
     * Ultima revisao: 14/11/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param mixed $ordem Tipo de ordenacao utilizando as constantes SORT_ASC ou SORT_DESC
     * @param mixed $chave A chave que regera a ordenacao
     * @param mixed $arrayOrdenar Array para ordenar
     */
    private function __organizar($ordem = SORT_ASC, $chave = null, $arrayOrdenar = null) {

        $array = $arrayOrdenar;

        if (is_null($array))
            $array = $this->dados;

        if (!is_array($array))
            return;

        for ($i = 0; $i < count($array); $i++) {
            if (is_array($array[$i]))
                $array[$i] = $this->__organizar($ordem, $chave, $array[$i]);
        }

        if (is_null($chave))
            array_multisort($array, $ordem);
        else if (is_array($array[0])) {
            if (array_key_exists($chave, $array[0])) {

                $canChange = true;

                while ($canChange) {
                    $canChange = false;
                    for ($i = 0; $i < count($array) - 1; $i++) {

                        if ($array[$i][$chave] > $array[$i + 1][$chave]) {

                            $temp = $array[$i];

                            $array[$i] = $array[$i + 1];

                            $array[$i + 1] = $temp;

                            $canChange = true;
                        }
                    }
                }
            }
        }

        if ($ordem == SORT_DESC) {
            if (is_null($arrayOrdenar))
                $this->dados = array_reverse($array);
            else
                return array_reverse($array);
        }
        else {
            if (is_null($arrayOrdenar))
                $this->dados = $array;
            else
                return $array;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="private function __remover($valor, $nivel, $restrito, $arrayRemover = null)">
    /**
     * Remove um ou mais itens do array atraves do valor procurado
     *
     * Ultima revisao: 05/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param mixed $valor Valor para delecao
     * @param integer $nivel Nivel para busca no array
     * @param bool $restrito Forca a funcao a verificar alem do valor o tipo de dado compativel
     * @param mixed $arrayRemover Array de onde sera removido o item
     */
    private function __remover($valor, $nivel, $restrito, $arrayRemover = null) {

        $array = $arrayRemover;

        if (is_null($array))
            $array = $this->dados;

        if (is_array($array)) {

            if ($nivel > 1) {

                for ($i = 0; $i < count($array); $i++)
                    $array[$i] = $this->__remover($valor, $nivel - 1, $restrito, $array[$i]);

                if (is_null($arrayRemover))
                    $this->dados = $array;

                else
                    return $array;
            }
            else {

                foreach (array_keys($array, $valor, $restrito) as $key) {

                    unset($array[$key]);
                }

                if (is_null($arrayRemover))
                    $this->dados = $array;

                else
                    return $array;
            }
        }
        else
            return $array;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="private function __removerEm($indice, $nivel, $arrayRemover = null)">
    /**
     * Remove um item do array atraves de seu indice
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param integer|string $indice Indice para delecao
     * @param integer $nivel Nivel de busca do indice, busca recursivamente dentro do array
     * @param mixed $arrayRemover Array para remover o item
     */
    private function __removerEm($indice, $nivel, $arrayRemover = null) {

        $array = $arrayRemover;

        if (is_null($array))
            $array = $this->dados;

        if (is_array($array)) {

            if ($nivel > 1) {

                for ($i = 0; $i < count($array); $i++)
                    $array[$i] = $this->__removerEm($indice, $nivel - 1, $array[$i]);

                if (is_null($arrayRemover))
                    $this->dados = $array;

                else
                    return $array;
            }
            else {

                unset($array[$indice]);

                if (is_null($arrayRemover))
                    $this->dados = $array;

                else
                    return $array;
            }
        }
        else
            return $array;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Adicionar($valor, $_ = null)">
    /**
     * Inclui valores no array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valor Variavel qualquer para adicionar, pode ser integer, string, array, etc.
     * @param mixed $_ (opcional)
     */
    public function Adicionar($valor, $_ = null) {

        $this->dados = array_merge($this->dados, func_get_args());

        $this->__calcularTamanho();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Imprimir()">
    /**
     * Exibe na tela os dados contidos no array
     *
     * Ultima revisao: 05/05/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     */
    static public function Imprimir($dados = null, $return = false) {

        $dados = (is_null($dados)) ? $this->dados : $dados;

        if (!$return) {

            foreach ($dados as $key => $value) {

                echo "[$key] => ";

                if (is_array($value)) {

                    echo '<br /><blockquote>( ';

                    GF_Vetor::Imprimir($value, false);

                    echo '<br /></blockquote>(';
                }

                else
                    echo $value . '&nbsp;&nbsp;';

            }
        }

        else {

            foreach ($dados as $key => $value) {

                $array.= "[$key] => ";

                if (is_array($value)) {

                    $array.= '<blockquote>( ';

                    $array.= GF_Vetor::Imprimir($value, true);

                    $array.= ')</blockquote> ';
                }

                else
                    $array.= $value . '&nbsp;&nbsp;';

                
            }

            return $array;
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Indice($valor)">
    /**
     * Retorna o indice da primeira ocorrencia em que se acha o valor
     * passado por parametro
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valor Valor para buscar
     * @return integer Posicao do valor no array ou -1 no caso de nao encontrar
     */
    public function Indice($valor) {

        $indice = array_search($valor, $this->dados);

        return ($indice === false) ? -1 : $indice;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Limpar()">
    /**
     * Limpa o array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     */
    public function Limpar() {

        $this->dados = array();

        $this->Tamanho = 0;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Organizar($ordem = SORT_ASC, $chave = null)">
    /**
     * Ordena os dados do array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param mixed $ordem Tipo de ordenacao utilizando as constantes SORT_ASC ou SORT_DESC
     * @param mixed $chave A chave que regera a ordenacao
     */
    public function Organizar($ordem = SORT_ASC, $chave = null) {
        $this->__organizar($ordem, $chave, null);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Procurar($valor, $chave = null, $chaveRetorno = null, $quantidade = -1, $nivel = -1, $retornarMaster = false, $sensibilidade = false, $igual = true)">
    /**
     * Faz busca num array, permitindo ao usuario realizar buscar personalizadas
     * com as opcoes paremetrizadas
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valor O valor que sera procurado
     * @param mixed $chave A chave onde o valor sera procurado. NULL indica que sera procurado em todas as chaves
     * @param mixed $chaveRetorno Indica de qual chave sera retirado o valor de retorno. NULL indica que sera o valor de $key. USE APENAS SE O ROW_MODE ESTIVER DESABILITADO!
     * @param integer $quantidade A quantidade de registros que deseja receber. -1 caso queira voltar todos os registros encontrados.
     * @param integer $nivel A quantidade de niveis que o codigo deve procurar. -1 caso queira percorrer todos os niveis do array.
     * @param bool $retornarMaster Modo de retorno que traz toda a linha onde o item foi encontrada, como num banco de dados. FALSE para retornar apenas o registro encontrado.
     * @param bool $sensibilidade A busca sera realiza de forma sensivel diferenciando maiusculas de minusculas. FALSE para fazer a procura independentemente do case.
     * @param bool $igual Modo em que toda a setenca deve ser igual para que o registro seja incluido. FALSE faz a busca em qualquer parte do valor do registro (equivalente ao LIKE '%valor%' em SQL).
     * @return mixed Um array contendo os valores encontrados na busca.
     */
    public function Procurar($valor, $chave = null, $chaveRetorno = null, $quantidade = -1, $nivel = -1, $retornarMaster = false, $sensibilidade = false, $igual = true) {
        return $this->__procurar($valor, $chave, $chaveRetorno, $quantidade, $nivel, $retornarMaster, $sensibilidade, $igual, $this->dados);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Remover($array, $valor, $nivel = 1, $restrito = false)">
    /**
     * Remove um ou mais itens do array atraves do valor procurado
     *
     * Ultima revisao: 05/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param mixed $valor Valor para delecao
     * @param integer $nivel Nivel para busca no array
     * @param bool $restrito Forca a funcao a verificar alem do valor o tipo de dado compativel
     */
    public function Remover($valor, $nivel = 1, $restrito = true) {
        $this->__remover($valor, $nivel, $restrito, null);
        $this->__calcularTamanho();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function RemoverEm($indice, $nivel = 1)">
    /**
     * Remove um item do array atraves de seu indice
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param integer|string $indice Indice para delecao
     * @param integer $nivel Nivel de busca do indice, busca recursivamente dentro do array
     */
    public function RemoverEm($indice, $nivel = 1) {
        $this->__removerEm($indice, $nivel, null);
        $this->__calcularTamanho();
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Reverter()">
    /**
     * Reverte a disposicao dos itens no array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     */
    public function Reverter() {
        $this->dados = array_reverse($this->dados);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function Valor($indice)">
    /**
     * Retorna o valor em um indice especifico do array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param integer|string $indice Indice para buscar
     * @return mixed
     */
    public function Valor($indice) {
        return $this->dados[$indice];
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public function UltimoIndice($valor)">
    /**
     * Retorna o ultimo indice de uma busca por um valor na primeira dimensao do array
     *
     * Ultima revisao: 14/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valor Valor para procurar
     * @return integer O indice ou -1 caso nao encontre
     */
    public function UltimoIndice($valor) {
        return!($indice = array_pop(array_keys($this->dados, $valor))) && ($indice !== 0) ? -1 : $indice;
    }

    // </editor-fold>

    static public function InputParaVetor($valor1, $valor2, $_ = null) {

        $array = func_get_args();

        foreach ($array as $value)
            if (!empty($value))
                $new_array[] = $value;

        return $new_array;
    }
}

?>