<?php

namespace Biscoito\Lib\Util;

/**
 * FUNCOES GLOBAIS :: TEXTO
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2010 Natanael Simoes
 *
 * DESCRICAO
 *
 * @package     Funcoes Globai s
 * @subpackage  Texto
 * @category    Functions
 * @author      Natanael Simoes <natanael@fabricadecodigo.com.br>
 * @copyright   Copyright (c) 2010 Natanael Simoes
 * @license     http://www.opensource.org/licenses/lgpl-3.0.html LGPLv3
 * @version     1.04
 * @link        http://www.fabricadecodigo.com.br/
 */
class TTexto {

    // <editor-fold defaultstate="collapsed" desc="static public Adicionar($texto, $argumento, $posicao)">
    /**
     * Insere um argumento num texto indicando a posicao onde sera colocado
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto onde sera inserido o argumento
     * @param string $argumento Argumento para ser inserido
     * @param integer $posicao Posicao no texto para adicionar
     * @return string O texto com o argumento inserido
     */
    static function Adicionar($texto, $argumento, $posicao) {
        return substr($texto, 0, $posicao) . $argumento . substr($texto, $posicao);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Aparar($texto)">
    /**
     * Retira os espacos em branco no comeco e no final de um texto.
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto para aparar
     * @return string
     */
    static function Aparar($texto) {
        return trim($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ApararDireita($texto)">
    /**
     * Retira espacos em branco a direita do texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto para aparar
     * @return string
     */
    static function ApararDireita($texto) {
        return rtrim($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ApararEsquerda($texto)">
    /**
     * Retira os espacos em branco a esquerda do texto
     * 
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     * 
     * @since 1.02
     * @author Natanael Simoes
     * 
     * @param string $texto Texto para aparar
     * @return string 
     */
    static function ApararEsquerda($texto) {
        return ltrim($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ArrayCaracteres($texto)">
    /**
     * Cria um array com os caracteres de um texto. Espacos em branco tambem
     * contarao como elementos do array
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto utilizado para criar o array
     * @return mixed
     */
    static function ArrayCaracteres($texto) {
        return str_split($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public CaixaAlta($string)">
    /**
     * Transforma em maisculas todas as letras de uma string
     *
     * Ultima revisao: 20/12/2010
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $string
     * @return string
     */
    static function CaixaAlta($string) {
        return strtoupper($string);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public CaixaBaixa($string)">
    /**
     * Transforma em minusculas todas as letras de uma string
     * 
     * Ultima revisao: 20/12/2010
     * Versao: 1.00
     * 
     * @since 1.00
     * @author Natanael Simoes
     * 
     * @param string $string
     * @return string 
     */
    static function CaixaBaixa($string) {
        return strtolower($string);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Caracter($texto, $posicao)">
    /**
     * Retorna o caracter de um texto numa posicao determinada
     * 
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     * 
     * @since 1.02
     * @author Natanael Simoes
     * 
     * @param string $texto Texto para retirar o caracter
     * @param integer $posicao Posicao dentro do texto
     * @return string 
     */
    static function Caracter($texto, $posicao) {
        return substr($texto, $posicao, 1);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ComecaCom($texto, $comeca)">
    /**
     * Verifica se o texto comeca com o argumento especificado
     * 
     * Ultima revisao: 29/04/2011
     * Versao: 1.02
     * 
     * @since 1.02
     * @author Natanael Simoes
     * 
     * @param string $texto Texto para verificar
     * @param string $comeca Argumento que deve estar no comeco
     * @return boolean
     */
    static function ComecaCom($texto, $comeca) {
        return (strpos($texto, $comeca) === 0);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Concatenar($texto1, $texto2, $_ = null)">
    /**
     * Cria um novo texto pela concatenacao de varias partes passadas por parametro.
     * Podem ser entrados tantos textos para concatenar quanto preciso.
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto1 Primeiro texto
     * @param string $texto2 Segundo texto
     * @param string $_ (opcional)
     * @return string
     */
    static function Concatenar($texto1, $texto2, $_ = null) {

        foreach (func_get_args() as $texto)
            $concat .= $texto;

        return $concat;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Indice($texto, $argumento)">
    /**
     * Retorna o indice da primeira ocorrencia do argumento no texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto onde sera procurado
     * @param string $argumento Argumento para procurar no texto
     * @return integer Retorna o indice do argumento no texto ou -1 se nao encontrar
     */
    static function Indice($texto, $argumento) {
        return !($indice = strpos($texto, $argumento)) && ($indice !== 0) ? -1 : $indice;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Juntar($separador, $texto1, $texto2, $_ = null)">
    /**
     * Junta textos, como na concatenacao, mas inserindo entre eles um separador
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $separador Separador que ficara entre os textos
     * @param string $texto1 Primeiro texto
     * @param string $texto2 Segundo texto
     * @param string $_ (opcional)
     * @return string
     */
    static function Juntar($separador, $texto1, $texto2, $_ = null) {

        $sep = null;

        $join = '';

        foreach (func_get_args() as $texto) {

            if (is_null($sep))
                $sep = $texto;

            else
                $join.= $texto . $sep;
        }

        return substr($join, 0, -1 * strlen($sep));
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public PreencherEsquerda($texto, $tamanho, $argumento)">
    /**
     * Preenche um texto a sua esquerda com um argumento quando o texto tem
     * tamanho menor do que aquele passado por parametro
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto para preencher
     * @param string $tamanho Tamanho que o texto deve ter apos preenchido
     * @param string $argumento Argumento com o qual o texto sera preenchido
     * @return string
     */
    static function PreencherEsquerda($texto, $tamanho, $argumento) {
        return str_pad($texto, $tamanho, $argumento, 0);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public PreencherDireita($texto, $tamanho, $argumento)">
    /**
     * Preenche um texto a sua direita com um argumento quando o texto tem
     * tamanho menor do que aquele passado por parametro
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto para preencher
     * @param string $tamanho Tamanho que o texto deve ter apos preenchido
     * @param string $argumento Argumento com o qual o texto sera preenchido
     * @return string
     */
    static function PreencherDireita($texto, $tamanho, $argumento) {
        return str_pad($texto, $tamanho, $argumento, 1);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public PrimeiraLetraMaiuscula($string)">
    /**
     * A primeira letra de palavra da string sera transformada para maiscula
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.02
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $string Texto para transformar
     * @return string
     */
    static function PrimeiraLetraMaiuscula($string) {

        $string = strtolower($string);

        $new_string = '';

        foreach (explode(' ', $string) as $part) {

            $new_string.= strtoupper(substr($part, 0, 1));

            $new_string.= substr($part, 1);

            $new_string.= ' ';
        }

        return substr($new_string, 0, -1);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Remover($texto, $indice, $tamanho)">
    /**
     * Remove parte dos caracteres de um texto indicando a posicao onde iniciara
     * a exclusao e o tamanho do conjunto que sera retirado do texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto que tera parte removida
     * @param integer $indice Posicao para inicio da remocao
     * @param integer $tamanho Tamanho do conjunto de caracteres a remover a partir do indice especificado
     * @return string
     */
    static function Remover($texto, $indice, $tamanho) {
        return substr($texto, 0, $indice) . substr($texto, $indice + $tamanho);
    }

    // </editor-fold>
    // // <editor-fold defaultstate="collapsed" desc="static public RemoverAcentos($texto)">
    /**
     * Remove os acentos de um texo
     *
     * Ultima revisao: 15/05/2012
     * Versao: 1.00
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto que tera o acento removido
     * @return string
     */
    static function RemoverAcentos($texto) {
        $comAcentos = '¿¡√¬… Õ”’‘⁄‹«‡·„‚ÈÍÌÛıÙ˙¸Á';
        $semAcentos = 'AAAAEEIOOOUUCaaaaeeiooouuc';
        return strtr($texto, $comAcentos, $semAcentos);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Reverter($texto)">
    /**
     * Reverte a disposicao dos caracteres de um texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto para ser revertido
     * @return string
     */
    static function Reverter($texto) {
        return strrev($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Substituir($texto, $procurar, $argumento, $ocorrencias = null)">
    /**
     * Procura por um argumento no texto substituindo por outro
     *
     * Ultima revisao: 29/04/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto onde sera procurado o argumento
     * @param string $procurar Argumento para procurar no texto
     * @param string $substituir Argumento para substituir a procura
     * @return string
     */
    static function Substituir($texto, $procurar, $substituir) {
        return str_replace($procurar, $substituir, $texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Subtexto($texto, $indice, $tamanho)">
    /**
     * Retira um pedaco do texto a partir de um indice e, se necessario,
     * o tamanho apos o indice
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto de onde sera retirado o subtexto
     * @param integer $indice Indice onde sera iniciada a extracao
     * @param integer $tamanho Tamanho do conjunto de caracteres apos o indice, nao o passe para retirar do indice ate o final do texto
     * @return string
     */
    static function Subtexto($texto, $indice, $tamanho = null) {
        return substr($texto, $indice, $tamanho);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Tamanho($texto)">
    /**
     * Retorna a quantidade de caracteres de um texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto
     * @return integer
     */
    static function Tamanho($texto) {
        return strlen($texto);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public TerminaCom($texto, $termina)">
    /**
     * Verifica se o texto termina com um argumento
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto que sera verificado
     * @param string $termina Argumento com a terminacao
     * @return boolean
     */
    static function TerminaCom($texto, $termina) {
        return (substr($texto, strlen($texto) - strlen($termina)) == $termina);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public UltimoIndice($texto, $argumento)">
    /**
     * Captura o ultimo indice de um argumento no texto
     *
     * Ultima revisao: 15/01/2011
     * Versao: 1.02
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $texto Texto onde sera procurado o argumento
     * @param string $argumento Argumento que sera procurado no texto
     * @return integer Indice da ultima ocorrencia do argumento no texto, -1 no caso de nao encontrar
     */
    static function UltimoIndice($texto, $argumento) {

        $ocorrencias = 0;

        $ultimoIndice = $atualIndice = GF_Texto::Indice($texto, $argumento);

        while ($atualIndice != -1) {

            $ultimoIndice = $atualIndice;

            $atualIndice = GF_Texto::Indice(substr($texto, $atualIndice + strlen($argumento) + $ocorrencias), $argumento);

            $ocorrencias++;
        }

        return $ultimoIndice + ( $ocorrencias - 1 );
    }

    // </editor-fold>
}

?>