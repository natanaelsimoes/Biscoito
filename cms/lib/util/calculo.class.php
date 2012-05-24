<?php

/**
 * FUNCOES GLOBAIS :: CALCULO
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2010 Natanael Simoes
 *
 * DESCRICAO
 *
 * Conjunto de funcoes matematicas
 *
 * > Analise combinatoria
 * > Aritmetica
 * > Conjuntos
 * > Equacoes algebricas
 * > Estatistica
 * > Geometria analitica
 * > Matrizes
 * > Trigonometria
 *
 *
 * @package     Funcoes Globais
 * @subpackage  Calculo
 * @category    Functions
 * @author      Natanael Simoes <natanael@fabricadecodigo.com.br>
 * @copyright   Copyright (c) 2010 Natanael Simoes
 * @license     http://www.opensource.org/licenses/lgpl-3.0.html LGPLv3
 * @version     1.00
 * @link        http://www.fabricadecodigo.com.br/
 *
 * @todo Documentar todos as funcoes de area
 * @todo Criar funcao para calcular derivadas e integrais
 * @todo Criar funcao de area para Elipse
 */
class CMS_Calculo {

// <editor-fold defaultstate="collapsed" desc="static public Angulo($vertice = array(0,0), $ponto1 = array(0,1), $ponto2 = array(1,0), $precisao = null)">
    /**
     * Calcula o angulo formado por semi-retas que compartilham um mesmo vertice
     * estando representadas em um plano cartesiano a partir da marcacao de seus pontos
     *
     * Ultima revisao: 29/04/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanal Simoes
     *
     * @param mixed $vertice Array com o ponto x(A,B) do vertice do angulo
     * @param mixed $ponto1 Array com o ponto x(A,B) que formara uma das semi-retas
     * @param mixed $ponto2 Array com o ponto x(A,B) que formara uma das semi-retas
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Angulo($vertice, $ponto1, $ponto2, $precisao = null) {

        if ($vertice == $ponto1 || $vertice == $ponto2 || $ponto1 == $ponto2)
            return 0;

        $aP1 = (GF_Calculo::Distancia($vertice, $ponto1) != 0) ?
                GF_Calculo::ArcoSeno(( $ponto1[1] - $vertice[1] ) / GF_Calculo::Distancia($vertice, $ponto1)) : 90;

        $aP2 = (GF_Calculo::Distancia($vertice, $ponto2) != 0) ?
                GF_Calculo::ArcoSeno(( $ponto2[1] - $vertice[1] ) / GF_Calculo::Distancia($vertice, $ponto2)) : 90;

        $tA = 180 - $aP2 - $aP1;

        return ($tA <= 180) ? GF_Calculo::Precisao($tA, $presicao) : GF_Calculo::Precisao(360 - $tA, $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoCosseno($cosseno, $precisao = null)">
    /**
     * Retorna em graus o arco formado por um cosseno
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $cosseno Cosseno calculado
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoCosseno($cosseno, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(acos($cosseno), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoCosseno2($catetoAdjacente, $hipotenusa, $precisao = null)">
    /**
     * Retorna em graus o arco formado pelo calculo do cosseno
     *
     * Ultima revisao: 03/01/2010
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $catetoAdjacente Tamanho do cateto adjacente
     * @param float $hipotenusa Tamanho da hipotenusa
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoCosseno2($catetoAdjacente, $hipotenusa, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(acos($catetoAdjacente / $hipotenusa), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoSeno($seno, $precisao = null)">
    /**
     * Retorna em graus o arco formado por um seno
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $seno Seno calculado
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoSeno($seno, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(asin($seno), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoSeno2($catetoOposto, $hipotenusa, $precisao = null)">
    /**
     * Retorna em graus o arco formado pelo calculo do seno
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $catetoOposto Tamanho do cateto oposto
     * @param float $hipotenusa Tamanho da hipotenusa
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoSeno2($catetoOposto, $hipotenusa, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(asin($catetoOposto / $hipotenusa), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoTangente($tangente, $precisao = null)">
    /**
     * Retorna em graus o arco formado por uma tangente
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $tangente Tangente calculada
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoTangente($tangente, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(atan($tangente), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArcoTangente2($catetoOposto, $catetoAdjacente, $precisao = null)">
    /**
     * Retorna em graus o arco formado pelo calculo da tangente
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $catetoOposto Tamanho do cateto oposto
     * @param float $catetoAdjacente Tamanho do cateto adjacente
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ArcoTangente2($catetoOposto, $catetoAdjacente, $precisao = null) {
        return trim(GF_Calculo::RadianoParaGraus(atan($catetoOposto / $catetoAdjacente), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Area($valores, $precisao = null)">
    /**
     * Calcula a area de poligonos
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array contendo valores dos lados do poligono com ate 4 posicoes
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Area($valores, $precisao = null) {

        switch (count($valores)) {

            case 1: // CIRCUNFERENCIA

                return GF_Calculo::Precisao(pi() * GF_Calculo::Potencia($valores[0], 2), $precisao);

            case 2: // DIAGONAIS DE UM LOSANGO - BASE E ALTURA DE UM TRIANGULO

                $D = $valores[0];
                $d = $valores[1];

                return (is_null($precisao)) ? $D * $d / 2 : round($D * $d / 2, $precisao);

            case 3: // TRIANGULO

                $a = $valores[0];
                $b = $valores[1];
                $c = $valores[2];
                $perimetro = $a + $b + $c;

                if ($a == $b && $b == $c) // EQUILATERO
                    return GF_Calculo::AreaRegular(3, $a, $precisao);

                if ($a != $b && $a != $c && $b != $c) // ESCALENO
                    return GF_Calculo::Precisao(GF_Calculo::RaizQuadrada($perimetro / 2 * ( $perimetro / 2 - $a ) * ( $perimetro / 2 - $b ) * ( $perimetro / 2 - $c )), $precisao);

                if ($a == $b && ( $b != $c || $a != $c )) // ISOCELES
                    return GF_Calculo::Precisao($a * $c / 2, $precisao);

                if ($a == $c && ( $a != $b || $c != $b )) // ISOCELES
                    return GF_Calculo::Precisao($a * $b / 2, $precisao);

                if ($b == $c && ( $b != $a || $c != $a )) // ISOCELES
                    return GF_Calculo::Precisao($a * $b / 2, $precisao);

            case 4: // QUADRILATEROS

                $a = $valores[0];
                $b = $valores[1];
                $c = $valores[2];
                $d = $valores[3];
                $perimetro = $a + $b + $c + $d;

                if ($a == $b && $b == $c && $c == $d) // REGULAR
                    return GF_Calculo::AreaRegular(4, $a, $precisao);

                else
                    return GF_Calculo::RaizQuadrada(($perimetro / 2 - $a) * ($perimetro / 2 - $b) * ($perimetro / 2 - $c) * ($perimetro / 2 - $d), $precisao);

                break;

            default:

                return 'Esta classe calcula polígonos irregulares com até 4 lados.';
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaCilindro($raio, $altura, $precisao = null)">
    static public function AreaCilindro($raio, $altura, $precisao = null) {
        return array('AREA' => GF_Calculo::Precisao(( 2 * pi() * $raio * ( $altura + $raio )), $precisao), 'VOLUME' => GF_Calculo::Precisao(( pi() * $altura * GF_Calculo::Potencia($raio, 2)), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaCone($raio, $altura, $precisao = null)">
    static public function AreaCone($raio, $altura, $precisao = null) {
        return array('AREA' => GF_Calculo::Precisao(( pi() * $raio * ( GF_Calculo::Pitagoras($raio, $altura) + GF_Calculo::Area(array($raio)) )), $precisao), 'VOLUME' => GF_Calculo::Precisao(( 1 / 3 * $altura * GF_Calculo::Area(array($raio))), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaEsfera($raio, $altura, $precisao = null)">
    static public function AreaEsfera($raio, $precisao = null) {
        return array('AREA' => GF_Calculo::Precisao(( 4 * GF_Calculo::Area(array($raio))), $precisao), 'VOLUME' => GF_Calculo::Precisao(( 4 / 3 * pi() * GF_Calculo::Potencia($raio, 3)), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaPoliedro($faces, $tamanhoLado, $precisao = null)">
    /**
     *
     * @param <type> $faces
     * @param <type> $tamanhoLado
     * @param <type> $precisao
     * @return <type>
     */
    static public function AreaPoliedro($faces, $tamanhoLado, $precisao = null) {

        switch ($faces) {

            case 4:

                return array('AREA' => GF_Calculo::Precisao(( 4 * GF_Calculo::AreaRegular(3, $tamanhoLado)), $precisao), 'VOLUME' => GF_Calculo::Precisao(( GF_Calculo::RaizQuadrada(12) / 12 * GF_Calculo::Potencia($tamanhoLado, 3)), $precisao));

            case 6:

                return array('AREA' => GF_Calculo::Precisao(( 6 * GF_Calculo::Potencia($tamanhoLado, 2)), $precisao), 'VOLUME' => GF_Calculo::Potencia($tamanhoLado, 3, $precisao));

            case 8:

                return array('AREA' => GF_Calculo::Precisao(( 2 * M_SQRT3 * GF_Calculo::Potencia($tamanhoLado, 2)), $precisao), 'VOLUME' => GF_Calculo::Precisao(( 1 / 3 * M_SQRT2 * GF_Calculo::Potencia($tamanhoLado, 3)), $precisao));

            case 12:

                return array('AREA' => GF_Calculo::Precisao(( 3 * GF_Calculo::Potencia($tamanhoLado, 2) * GF_Calculo::RaizQuadrada(25 + ( 10 * GF_Calculo::RaizQuadrada(5)))), $precisao), 'VOLUME' => GF_Calculo::Precisao(1 / 4 * GF_Calculo::Potencia($tamanhoLado, 3) * (15 + (7 * GF_Calculo::RaizQuadrada(5))), $precisao));

            case 20:

                return array('AREA' => GF_Calculo::Precisao(( 5 * M_SQRT3 * GF_Calculo::Potencia($tamanhoLado, 2)), $precisao), 'VOLUME' => GF_Calculo::Precisao(5 / 12 * GF_Calculo::Potencia($tamanhoLado, 3) * ( 3 + GF_Calculo::RaizQuadrada(5) ), $precisao));

            default:

                return array('AREA' => 'A quantidade de faces entrada nao forma um poliedro.', 'VOLUME' => 0);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaRegular($lados, $tamanho, $precisao = null)">
    /**
     * Calcula a area de poligonos regulares (todos os lados iguais)
     *
     * Ultima revisao: 30/04/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $lados Quantidade de lados do poligono
     * @param float $tamanho Tamanho dos lados
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function AreaRegular($lados, $tamanho, $precisao = null) {
        return GF_Calculo::Precisao($lados * GF_Calculo::Potencia($tamanho, 2) / 4 * GF_Calculo::Tangente(180 / $lados), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public AreaToro($raio, $raioToro, $precisao = null)">
    static public function AreaToro($raio, $raioToro, $precisao = null) {
        return array('AREA' => GF_Calculo::Precisao(( 4 * $raioToro * GF_Calculo::Area(array($raio))), $precisao), 'VOLUME' => GF_Calculo::Precisao(( 2 * $raio * $raioToro * GF_Calculo::Area(array($raio))), $precisao));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArranjoCompleto($elementos, $tamanhoGrupo)">
    /**
     * Arranjos completos de n elementos, de k a k são os arranjos de k elementos não necessariamente distintos.
     * Em vista disso, quando vamos calcular os arranjos completos, deve-se levar em consideração os
     * arranjos com elementos distintos (arranjos simples) e os elementos repetidos.
     *
     * Ultima revisao: 07/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $elementos Quantidade de elementos para estudo
     * @param integer $tamanhoGrupo Quantidade de elementos para selecionar
     * @return integer
     */
    static public function ArranjoCompleto($elementos, $tamanhoGrupo) {
        return GF_Calculo::Potencia($elementos, $tamanhoGrupo);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArranjoSimples($elementos, $tamanhoGrupo)">
    /**
     * Arranjos Simples são agrupamentos sem repetições em que um grupo se torna
     * diferente do outro pela ordem ou pela natureza dos elementos componentes.
     *
     * Ultima revisao: 07/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $elementos Quantidade de elementos para estudo
     * @param integer $tamanhoGrupo Quantidade de elementos para selecionar
     * @return integer
     */
    static public function ArranjoSimples($elementos, $tamanhoGrupo) {
        return GF_Calculo::Fatorial($elementos) / GF_Calculo::Fatorial($elementos - $tamanhoGrupo);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArredondarParaBaixo($valor)">
    /**
     * Arredonda um numero decimal para o numero inteiro abaixo
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para arredondar
     * @return integer
     */
    static public function ArredondarParaBaixo($valor) {
        return floor($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ArredondarParaCima($valor)">
    /**
     * Arredonda um numero decimal para o numero inteiro acima
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para arredondar
     * @return integer
     */
    static public function ArredondarParaCima($valor) {
        return ceil($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public BinarioParaDecimal($binario)">
    /**
     * Converte um numero da base binaria para decimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $binario Binario para conversao
     * @return integer
     */
    static public function BinarioParaDecimal($binario) {
        return bindec($binario);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public BinarioParaHexadecimal($binario)">
    /**
     * Converte um numero da base binaria para hexadecimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $binario Binario para conversao
     * @return string
     */
    static public function BinarioParaHexadecimal($binario) {
        return GF_Calculo::DecimalParaHexadecimal(GF_Calculo::BinarioParaDecimal($binario));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public BinarioParaOctal($binario)">
    /**
     * Converte um numero da base binaria para octal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $binario Binario para conversao
     * @return string
     */
    static public function BinarioParaOctal($binario) {
        return GF_Calculo::DecimalParaOctal(GF_Calculo::BinarioParaDecimal($binario));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public CombinacaoCompleta($elementos, $tamanhoGrupo)">
    /**
     * Combinações completas de n elementos, de k a k, são combinações de k elementos não necessariamente distintos.
     * Em vista disso, quando vamos calcular as combinações completas devemos levar
     * em consideração as combinações com elementos distintos (combinações simples) e
     * as combinações com elementos repetidos.
     *
     * Ultima revisao: 07/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $elementos Quantidade de elementos para estudo
     * @param integer $tamanhoGrupo Quantidade de elementos para selecionar
     * @return integer
     */
    static public function CombinacaoCompleta($elementos, $tamanhoGrupo) {
        return GF_Calculo::CombinacaoSimples($elementos + $tamanhoGrupo - 1, $tamanhoGrupo);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public CombinacaoSimples($elementos, $tamanhoGrupo)">
    /**
     * Combinação simples são agrupamentos formados com os elementos de um conjunto que se
     * diferenciam somente pela natureza de seus elementos.
     * Considere A como um conjunto com n elementos k um natural menor ou igual a n.
     * Os agrupamentos de k elementos distintos cada um, que diferem entre si apenas pela
     * natureza de seus elementos são denominados combinações simples k a k, dos n elementos de A.
     *
     * Ultima revisao: 07/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $elementos Quantidade de elementos para estudo
     * @param integer $tamanhoGrupo Quantidade de elementos para selecionar
     * @return integer
     */
    static public function CombinacaoSimples($elementos, $tamanhoGrupo) {
        return GF_Calculo::Fatorial($elementos) / GF_Calculo::Fatorial($tamanhoGrupo) * GF_Calculo::Fatorial($elementos - $tamanhoGrupo);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ConjuntoInterseccao($conjuntoA, $conjuntoB, $_ = null)">
    /**
     * Quando os elementos de dois ou mais conjuntos relacionados são comuns
     * eles são chamados de conjunto interseção.
     * A intersecção dos conjuntos A e B é o conjunto constituído de todos os
     * elementos que pertencem simultaneamente a A e B.
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $conjuntoA Array com elementos do conjunto A
     * @param mixed $conjuntoB Array com elementos do conjunto B
     * @param mixed $_ (opcional)
     * @return mixed
     */
    static public function ConjuntoInterseccao($conjuntoA, $conjuntoB, $_ = null) {

        $lastConjunto = null;

        foreach (func_get_args () as $conjunto)
            if (is_null($lastConjunto))
                $lastConjunto = $conjunto;
            else if (!is_null($conjunto))
                $lastConjunto = array_intersect($lastConjunto, $conjunto);

        return $lastConjunto;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ConjuntoSubtracao($conjuntoA, $conjuntoB, $_ = null)">
    /**
     * Considere os conjuntos A e B, dizemos que a diferença entre esses dois conjuntos
     * é o conjunto formado pelos elementos que pertencem a A e não pertencem a B.
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $conjuntoA Array com elementos do conjunto A
     * @param mixed $conjuntoB Array com elementos do conjunto B
     * @param mixed $_ (opcional)
     * @return mixed
     */
    static public function ConjuntoSubtracao($conjuntoA, $conjuntoB, $_ = null) {

        $newConj = null;

        foreach (func_get_args () as $conjunto)
            if (is_null($newConj) && !is_null($conjunto))
                $newConj = $conjunto;
            else if (!is_null($conjunto))
                $newConj = array_diff($newConj, $conjunto);

        return $newConj;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ConjuntoUniao($conjuntoA, $conjuntoB, $_ = null)">
    /**
     * É quando dois ou mais conjuntos se unem, estabelecendo uma relação entre seus elementos.
     * A união do conjunto A e B é o conjunto formado pelos elementos pertencentes à A e B.
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $conjuntoA Array com elementos do conjunto A
     * @param mixed $conjuntoB Array com elementos do conjunto B
     * @param mixed $_ (opcional)
     * @return mixed
     */
    static public function ConjuntoUniao($conjuntoA, $conjuntoB, $_ = null) {

        $newConj = array();

        $conjuntos = func_get_args();

        foreach ($conjuntos as $conjunto)
            if (!is_null($conjunto))
                $newConj = array_merge($newConj, $conjunto);

        return $newConj;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Cossecante($angulo, $precisao = null)">
    /**
     * Calcula a cossecante de um angulo
     * 
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     * 
     * @since 1.00
     * @author Natanael Simoes
     * 
     * @param float $angulo Angulo para calcular
     * @param integer $precisao Precisao de casas decimais
     * @return float 
     */
    static public function Cossecante($angulo, $precisao = null) {
        return GF_Calculo::Precisao(1 / GF_Calculo::Seno($angulo), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Cosseno($angulo, $precisao = null)">
    /**
     * Calcula o cosseno de um angulo em graus
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Angulo em graus
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Cosseno($angulo, $precisao = null) {
        return GF_Calculo::Precisao(cos(deg2rad($angulo)), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Cotangente($angulo, $precisao = null)">
    /**
     * Calcula a cotangente de um angulo
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Angulo para calcular
     * @param integer $preicsao Precisao de casas decimais
     * @return float
     */
    static public function Cotangente($angulo, $preicsao = null) {
        return GF_Calculo::Precisao(1 / GF_Calculo::Tangente($angulo), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public DecimalParaBinario($valor)">
    /**
     * Converte um numero da base decimal para binario
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $valor Valor para conversao
     * @return string
     */
    static public function DecimalParaBinario($valor) {
        return decbin($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public DecimalParaHexadecimal($valor)">
    /**
     * Converte um numero da base decimal para hexadecimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $valor Valor para conversao
     * @return string
     */
    static public function DecimalParaHexadecimal($valor) {
        return dechex($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public DecimalParaOctal($valor)">
    /**
     * Converte um numero da base decimal para octal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $valor Valor para conversao
     * @return string
     */
    static public function DecimalParaOctal($valor) {
        return decoct($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Determinante($matriz)">
    static public function Determinante($matriz) {

        if (count($matriz) == count($matriz[0]))
            switch (count($matriz)) {
                case 1:

                    return $matriz[0][0];

                case 2:

                    return ( ( $matriz[0][0] * $matriz[1][1] ) - ( $matriz[0][1] * $matriz[1][0] ) );

                case 3: // REGRA DE SARRUS

                    $ordem = count($matriz);

                    $det = 0;

                    for ($i = 0; $i < $ordem; $i++)
                        for ($j = 0; $j < $ordem - 1; $j++)
                            array_push($matriz[$i], $matriz[$i][$j]);

                    for ($i = 0; $i < $ordem; $i++) {

                        $linha = $valor = 0;

                        $coluna = $i;

                        for ($j = 0; $j < $ordem; $j++) {
                            if ($j == 0)
                                $valor = $matriz[$linha][$coluna];
                            else
                                $valor *= $matriz[$linha][$coluna];
                            $linha++;
                            $coluna++;
                        }

                        $det += $valor;
                    }

                    for ($i = 0; $i < $ordem; $i++) {

                        $linha = $ordem - 1;

                        $valor = 0;

                        $coluna = $i;

                        for ($j = 0; $j < $ordem; $j++) {
                            if ($j == 0)
                                $valor = $matriz[$linha][$coluna];
                            else
                                $valor *= $matriz[$linha][$coluna];
                            $linha--;
                            $coluna++;
                        }

                        $det += ( -1) * $valor;
                    }


                    return $det;

                default: // REDUCAO POR REGRA DE CHIO E APLICACAO DE SARRUS AO ATINGIR ORDEM 3

                    $ordem = count($matriz);

                    while (count($matriz) > 3) {
                        for ($i = 1; $i < $ordem; $i++)
                            for ($j = 1; $j < $ordem; $j++)
                                $new_matriz[$i - 1][$j - 1] = $matriz[$i][$j] - ($matriz[$i][0] * $matriz[0][$j]);

                        $matriz = $new_matriz;
                    }

                    return GF_Calculo::Determinante($matriz);
            }
        else
            return 'Numero de linhas da matriz deve ser o mesmo de colunas.';
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Divisivel($numero, $divisor)">
    /**
     * Verifica se um numero e divisivel por um divisor
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $numero Numero em que sera aplicado o divisor
     * @param float $divisor Divisor da equacao
     * @return bool
     */
    static public function Divisivel($numero, $divisor) {
        return ($numero % $divisor == 0);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Distancia($pontoA = array(0,0), $pontoB = array(0,0), $precisao = null)">
    /**
     * Calcula distancia entre dois pontos no plano cartesiano
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $pontoA Array com o ponto x(A,B) que formara a semi-reta
     * @param mixed $pontoB Array com o ponto x(A,B) que formara a semi-reta
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Distancia($pontoA = array(0, 0), $pontoB = array(0, 0), $precisao = null) {
        return GF_Calculo::RaizQuadrada(GF_Calculo::Potencia($pontoB[0] - $pontoA[0], 2) + GF_Calculo::Potencia($pontoB[1] - $pontoA[1], 2), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public EquacaoSegundoGrau($a = null, $b = null, $c = null, $d = null, $x = null)">
    /**
     * Calcula uma equacao do segundo grau passando os valores por parametro
     * Parametro com valor nulo sera aquele procurado pelo metodo
     * A formula segue o seguinte esquema: a.x² + b.x + c = d
     * Em caso de serem todos os parametros preenchidos, o metodo verifica se
     * a igualdade e verdadeira na equacao do segundo grau
     * Quando se tenta achar o valor de $x o valor retornado sera um array de 2 posicoes
     * uma para cada raiz de x
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a Valor de a. Numero que multiplica x²
     * @param float $b Valor de b. Numero que multiplica x
     * @param float $c Valor de c. Numero sozinho no primeiro termo
     * @param float $d Valor de d. Igualdade para comparacao no segundo termo
     * @param float $x Valor de x. Geralmente a icgonita das questoes
     * @param integer $precisao Precisao de casas decimais dos valores retornados
     * @return bool|float|mixed
     */
    static function EquacaoSegundoGrau($a = null, $b = null, $c = null, $d = null, $x = null, $precisao = null) {
        switch (null || '') {

            case $x:

                $x = array();
                $numeroImaginario = false;

                $baskhara = GF_Calculo::Potencia($b, 2) - 4 * $a * ( $c - $d );

                if ($baskhara < 0) {

                    $baskhara *= - 1;

                    $numeroImaginario = true;
                }

                $x[0] = GF_Calculo::Precisao(( -1 * $b + GF_Calculo::RaizQuadrada($baskhara) ) / ( 2 * $a ), $precisao);

                $x[1] = GF_Calculo::Precisao(( -1 * $b - GF_Calculo::RaizQuadrada($baskhara) ) / ( 2 * $a ), $precisao);

                if ($numeroImaginario) {

                    $x[0] .= 'i';

                    $x[1] .= 'i';
                }

                return $x;

            case $a:

                return GF_Calculo::Precisao(( -1 * $b * $x - $c + $d ) / GF_Calculo::Potencia($x, 2), $precisao);

            case $b:

                return GF_Calculo::Precisao(( -1 * $a * GF_Calculo::Potencia($x, 2) - $c + $d ) / $x, $precisao);

            case $c:

                return GF_Calculo::Precisao(( -1 * $a * GF_Calculo::Potencia($x, 2) - $b * $x + $d), $precisao);

            case $d:

                return GF_Calculo::Precisao(( $a * GF_Calculo::Potencia($x, 2) + $b * $x + $c), $precisao);

            default:

                return ($a * GF_Calculo::Potencia($x, 2) + $b * $x + $c == $d);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public EquacaoTerceiro($a = null, $b = null, $c = null, $d = null, $e = null, $x = null)">
    /**
     * Calcula uma equacao do terceiro grau passando os valores por parametro
     * Parametro com valor nulo sera aquele procurado pelo metodo
     * A formula segue o seguinte esquema: a.x³ + b.x² + c.x + d = e
     * Em caso de serem todos os parametros preenchidos, o metodo verifica se
     * a igualdade e verdadeira na equacao do terceiro grau
     * Quando se tenta achar o valor de $x o valor retornado sera um array de 3 posicoes
     * uma para cada raiz de x
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a Valor de a. Numero que multiplica x³
     * @param float $b Valor de b. Numero que multiplica x²
     * @param float $c Valor de c. Numero que multiplica x
     * @param float $d Valor de d. Numero sozinho no primeiro termo
     * @param float $e Valor de e. Igualdade para comparacao no segundo termo
     * @param float $x Valor de x. Geralmente a icgonita das questoes
     * @param integer $precisao Precisao de casas decimais dos valores retornados
     * @return bool|float|mixed
     */
    static public function EquacaoTerceiroGrau($a = null, $b = null, $c = null, $d = null, $e = null, $x = null, $precisao = null) {
        switch (null) {
            case $x:

                $x = array();

                $A = $b / $a;
                $B = $c / $a;
                $C = ( $d - $e ) / $a;
                $P = $B - $A * $A / 3;
                $Q = $C - $A * $B / 3 + 2 * $A * $A * $A / 27;
                $D = $Q * $Q / 4 + $P * $P * $P / 27;

                if ($D < 0) {
                    $M = GF_Calculo::RaizQuadrada(-1 * $D);
                    $R = GF_Calculo::RaizQuadrada($Q * $Q / 4 + $M * $M);
                    $T = GF_Calculo::ArcoTangente(-1 * $Q / 2 / $R);
                    $x[0] = 2 * GF_Calculo::Potencia($R, 1 / 3) * GF_Calculo::Cosseno($T / 3) - $A / 3;
                    $x[1] = 2 * GF_Calculo::Potencia($R, 1 / 3) * GF_Calculo::Cosseno($T + 2 * M_PI) - $A / 3;
                    $x[2] = 2 * GF_Calculo::Potencia($R, 1 / 3) * GF_Calculo::Cosseno($T + 4 * M_PI) - $A / 3;
                } else {

                    $U3 = -1 * $Q / 2 + GF_Calculo::RaizQuadrada($D);

                    if ($U3 < 0)
                        $U = GF_Calculo::Potencia(-1 * $U3, 1 / 3);
                    else
                        $U = GF_Calculo::Potencia($U3, 1 / 3);

                    $V3 = -1 * $Q / 2 - GF_Calculo::RaizQuadrada($D);

                    if ($V3 < 0)
                        $V = GF_Calculo::Potencia(-1 * $V3, 1 / 3);
                    else
                        $V = GF_Calculo::Potencia($V3, 1 / 3);

                    $R1 = $U + $V - $A / 3;

                    $Delta = GF_Calculo::Potencia($A + $R1, 2) + 4 * $C / $R1;

                    $Real = -1 * ($A + $R1) / 2;

                    $K = abs($Delta);

                    $Imag = GF_Calculo::RaizQuadrada($K) / 2;

                    $x[0] = $R1;

                    if ($Delta < 0) {
                        $x[1] = $Real . '+' . $Imag . 'i';
                        $x[2] = $Real . '-' . $Imag . 'i';
                    } else {
                        $x[1] = GF_Calculo::Precisao($Real + $Imag, $precisao);
                        $x[2] = GF_Calculo::Precisao($Real - $Imag, $precisao);
                    }
                }


                return $x;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Fatorial($numero)">
    /**
     * Calcula o fatorial de um numero inteiro qualquer
     *
     * Ultima revisao: 07/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $numero Numero para ter fatorial calculado
     * @return integer
     */
    static public function Fatorial($numero) {
        if ($numero < 0 || gettype($numero) == 'double')
            return 'Nao e possivel calcular fatorial de numero negativo ou decimal.';
        if ($numero == 0 || $numero == 1)
            return 1;
        return $numero * GF_Calculo::Fatorial($numero - 1);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public GerarAleatorio($min = 0, $max = null)">
    /**
     * Gera um numero inteiro aleatorio
     *
     * Ultima revisao: 02/04/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $min Numero minimo
     * @param integer $max Numero maximo
     * @return integer
     */
    static public function GerarAleatorio($min = null, $max = null) {

        $min = (is_null($min)) ? GF_Calculo::Potencia(-2, 31) : $min;

        return is_null($max) ? mt_rand($min, mt_getrandmax()) : mt_rand($min, $max);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public GrausParaRadiano($angulo, $precisao = null)">
    /**
     * Transforma uma angulo em graus para radiano
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Valor do angulo em graus
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function GrausParaRadiano($angulo, $precisao = null) {
        return GF_Calculo::Precisao(deg2rad($angulo), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public HexadecimalParaBinario($hexadecimal)">
    /**
     * Converte hexadecimal em numero binario
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $hexadecimal Hexadecimal para converter
     * @return string
     */
    static public function HexadecimalParaBinario($hexadecimal) {
        return GF_Calculo::DecimalParaBinario(GF_Calculo::HexadecimalParaDecimal($hexadecimal));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public HexadecimalParaDecimal($hexadecimal)">
    /**
     * Converte hexadecimal em numero decimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $hexadecimal Hexadecimal para converter
     * @return integer
     */
    static public function HexadecimalParaDecimal($hexadecimal) {
        return hexdec($hexadecimal);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public HexadecimalParaOctal($hexadecimal)">
    /**
     * Converte hexadecimal em numero octal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $hexadecimal Hexadecimal para converter
     * @return string
     */
    static public function HexadecimalParaOctal($hexadecimal) {
        return GF_Calculo::DecimalParaOctal(GF_Calculo::HexadecimalParaDecimal($hexadecimal));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Impar($numero)">
    /**
     * Verifica se um numero e impar
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $numero Numero para verificar
     * @return bool
     */
    static public function Impar($numero) {
        return ($numero % 2 != 0);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public JurosComposto($capital = null, $taxa = null, $tempo = null, $juros = null, $precisao = null)">
    /**
     * Calcula o parametro que estiver nulo entre os parametros passados
     * utilizando a equacao geral de juros composto
     *
     * Juros composto é todo juros que é calculado a partir do montante, que é o capital inicial somado aos juros.
     *
     * Ultima revisao: 03/04/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $capital Capital
     * @param float $taxa Taxa de juros em funcao do tempo
     * @param float $tempo Tempo
     * @param float $juros Juros
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function JurosComposto($capital = null, $taxa = null, $tempo = null, $juros = null, $precisao = null) {
        switch (null || '') {
            case $juros:
                return GF_Calculo::Precisao(( GF_Calculo::Potencia((100 + $taxa) / 100, $tempo) - 1 ) * $capital, $precisao);

            case $capital:
                return GF_Calculo::Precisao($juros / ( GF_Calculo::Potencia((100 + $taxa) / 100, $tempo) - 1 ), $precisao);

            case $taxa:
                return GF_Calculo::Precisao(( 100 * GF_Calculo::Raiz(($juros / $capital) + 1, $tempo) ) - 100, $precisao);

            case $tempo:
                return GF_Calculo::Precisao(GF_Calculo::Logaritmo(($juros / $capital) + 1, (100 + $taxa) / 100), $precisao);
        }
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public JurosSimples($capital = null, $taxa = null, $tempo = null, $juros = null, $precisao = null)">
    /**
     * Calcula o parametro que estiver nulo entre os parametros passados
     * utilizando a equacao geral de juros simples
     *
     * Juros simples é todo juros que é determinado a partir do capital inicial,
     * por isso dizemos que o juros simples é diretamente proporcional ao capital
     * e ao tempo de aplicação.
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $capital Capital
     * @param float $taxa Taxa de juros em funcao do tempo
     * @param float $tempo Tempo
     * @param float $juros Juros
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function JurosSimples($capital = null, $taxa = null, $tempo = null, $juros = null, $precisao = null) {
        switch (null) {
            case $juros:
                return GF_Calculo::Precisao(( $capital * $taxa * $tempo ) / 100, $precisao);

            case $capital:
                return GF_Calculo::Precisao(( $juros * 100 ) / ( $taxa * $tempo ), $precisao);

            case $taxa:
                return GF_Calculo::Precisao(( $juros * 100 ) / ( $capital * $tempo ), $precisao);

            case $tempo:
                return GF_Calculo::Precisao(( $juros * 100 ) / ( $capital * $taxa ), $precisao);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Logaritmo($valor, $base = 10, $precisao = null)">
    /**
     * Retorna o logaritmo de um valor qualquer.
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor que se fara a funcao logaritmica
     * @param float $base Base da exponenciacao. Deixar em branco para logaritmo neperiano (base 10)
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Logaritmo($valor, $base = 10, $precisao = null) {
        return GF_Calculo::Precisao(log($valor, $base), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Maior($valorA, $valorB)">
    /**
     * Verifica se o valor A e maior que B
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valorA Qualquer variavel para comparar
     * @param mixed $valorB Qualquer variavel para comparar
     * @return bool
     */
    static public function Maior($valorA, $valorB) {
        return ($valorA > $valorB);
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MaiorOuIgual($valorA, $valorB)">
    /**
     * Verifica se o valor A e maior ou igual a B
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valorA Qualquer variavel para comparar
     * @param mixed $valorB Qualquer variavel para comparar
     * @return bool
     */
    static public function MaiorOuIgual($valorA, $valorB) {
        return ($valorA >= $valorB);
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MatrizOposta($matriz)">
    /**
     * A matriz oposta da matriz A é aquela que possui elementos opostos correspondentes ao da matriz A.
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $matriz Matriz para calcular a oposta
     * @return mixed
     */
    static public function MatrizOposta($matriz) {
        for ($i = 0; $i < count($matriz); $i++)
            for ($j = 0; $j < count($matriz[$i]); $j++)
                $matriz[$i][$j] *= - 1;
        return $matriz;
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MatrizSoma($matrizA, $matrizB, $_ = null)">
    /**
     * Soma valores de matrizes de mesma ordem
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $matrizA Primeira matriz
     * @param mixed $matrizB Segunda matriz
     * @param mixed $_ (opcional)
     * @return mixed
     */
    static public function MatrizSoma($matrizA, $matrizB, $_ = null) {
        $matrizes = func_get_args();

        foreach ($matrizes as $matriz)
            if (count($matrizA) != count($matriz))
                return 'Todas as matrizes devem ter mesmo numero de linha e colunas.';
            else
                for ($i = 0; $i < count($matrizA); $i++)
                    if (array_keys($matrizA[$i]) != array_keys($matriz[$i]))
                        return 'Todas as matrizes devem ter mesmo numero de linha e colunas.';

        $linhas = count($matrizes[0]);
        $colunas = count($matrizes[0][0]);

        foreach ($matrizes as $matriz) {

            for ($linha = 0; $linha < $linhas; $linha++)
                for ($coluna = 0; $coluna < $colunas; $coluna++)
                    $newMat[$linha][$coluna] += $matriz[$linha][$coluna];
        }

        return $newMat;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MatrizTransposta($matriz)">
    /**
     * Troca ordenada das linhas da matriz por colunas
     * 
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     * 
     * @since 1.00
     * @author Natanael Simoes
     * @param mixed $matriz Matriz para transposicao
     * @return mixed 
     */
    static public function MatrizTransposta($matriz) {
        for ($i = 0; $i < count($matriz); $i++)
            for ($j = 0; $j < count($matriz[$i]); $j++)
                $newMatriz[$j][$i] = $matriz[$i][$j];
        return $newMatriz;
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MaximoDivisorComum($valor1, $valor2, $_ = null)">
    /**
     * O máximo divisor comum (mdc) entre dois números naturais é obtido a partir
     * da interseção dos divisores naturais, escolhendo-se a maior.
     *
     * Ultima revisao: 05/05/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $valor1 Primeiro numero
     * @param integer $valor2 Segundo numero
     * @param integer $_ (opcional)
     * @return integer 
     */
    static public function MaximoDivisorComum($valor1, $valor2, $_ = null) {

        $valores = func_get_args();

        array_multisort($valores, SORT_DESC);

        for ($i = 1; $i < count($valores); $i++)
            if (!is_null($valores[$i])) {

                $valorA = $valores[0];

                $valorB = $valores[$i];

                while ($valorB != 0) {

                    $valorC = $valorA % $valorB;

                    $valorA = $valorB;

                    $valorB = $valorC;
                }

                $lastMax .= $valorA . ',';
            }


        $lastMax = substr($lastMax, 0, -1);

        if (count(split(',', $lastMax)) > 1)
            return eval(" return GF_Calculo::MaximoDivisorComum($lastMax); ");

        else
            return $lastMax;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Media($valores, $precisao = null)">
    /**
     * Calcula a media de valores
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array de valores reais
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Media($valores, $precisao = null) {
        return GF_Calculo::Precisao(array_sum($valores) / count($valores), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaAgrupado($tabela, $precisao = null)">
    /**
     * Calcula a média do intervalo de cada classe retornando um array unidimensional
     * com mesma quantidade de indices da primeira dimensao (caracteriza a quantidade
     * de classes) que aquele entrado por parametro
     *
     * O Modelo de entrada deve conter um Array que engloba todo o conjunto de dados
     * e para cada classse, um outro array, sendo o primeiro valor o limite inferior,
     * o segundo, o limite superior:
     *
     * array(
     *    array(limiteInferior, limiteSuperior),
     *    array(limiteInferior, limiteSuperior)
     * )
     *
     * Retorno para entrada acima deve obrigatoriamente retornar o array:
     *
     * array(mediaClasse1, mediaClasse2)
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $tabela Conjunto de dados para retirar a media
     * @param integer $precisao Precisao de casas decimais
     * @return mixed Array com as medias
     */
    static public function MediaAgrupado($tabela, $precisao = null) {

        $arReturn = array();

        foreach ($tabela as $classe) {
            array_push($arReturn, GF_Calculo::Media($classe, $precisao));
        }

        return $arReturn;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MedianaAgrupado($tabela, $precisao = null)">
    /**
     * Calcula a mediana num conjunto de dados agrupados
     *
     * O Modelo de entrada deve conter um Array que engloba todo o conjunto de dados
     * e para cada classse, um outro array, sendo o primeiro valor o limite inferior,
     * o segundo o limite superior e em terceiro a frequencia do intervalo:
     *
     * array(
     *    array(limiteInferior, limiteSuperior, frequencia),
     *    array(limiteInferior, limiteSuperior, frequencia)
     * )
     *
     * Retorna o valor da mediana em [0] e a classe em [1]
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $tabela Array contendo os dados agrupados
     * @param integer $precisao Precisao de casas decimais
     * @return mixed Array com o valor da mediana e a classe
     */
    static public function MedianaAgrupado($tabela, $precisao = null) {

        $classeModal = null;
        $frequenciaModal = 0;
        $frequenciaAnterior = 0;

        for ($pos = 0; $pos < count($tabela); $pos++) {
            if ($tabela[$pos][2] > $frequenciaModal) {
                $classeModal = $pos;
                $frequenciaModal = $tabela[$pos][2];
                $frequenciaAnterior += $tabela[$pos - 1][2];
            }
        }

        return array(GF_Calculo::Precisao($tabela[$classeModal][0] + ( ( 10 / 2 - 2 ) / 5 ) * ( $tabela[$classeModal][1] - $tabela[$classeModal][0] ), $precisao), $classeModal + 1);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaGeometrica($valores, $precisao = null)">
    /**
     * Calcula a media geometrica de um conjunto de valores
     *
     * A média geométrica é uma média muito útil em conjuntos de números que são
     * interpretados em ordem de seu produto, não de sua soma (tal e como ocorre com a média aritmética).
     * Por exemplo, as velocidades de crescimento.
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array contendo valores tirar as medias
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function MediaGeometrica($valores, $precisao = null) {
        return GF_Calculo::Potencia(array_product($valores), 1 / count($valores), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaHarmonica($valores, $precisao = null)">
    /**
     * Calcula a media harmonica de um conjunto de valores
     *
     * A média harmônica é uma média muito útil em conjuntos de números que se definem
     * em relação com alguma unidade, por exemplo a velocidade (distância por unidade de tempo).
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array contendo valores tirar as medias
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function MediaHarmonica($valores, $precisao = null) {

        foreach ($valores as $valor)
            $somaHarmonica += 1 / $valor;

        return GF_Calculo::Precisao(count($valores) / $somaHarmonica, $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaHeroniana($valor1, $valor2, $precisao = null)">
    /**
     * Calcula a media heroniana de dois numeros reais nao negativos
     *
     * Recebe seu nome de Herón de Alejandría, e usa-se para calcular o volume de um tronco,
     * pirâmide ou cone. O volume tanto faz ao produto da altura do frustum pela média heroniana
     * das áreas das duas caras paralelas.
     * A média heroriana de dois números A e B é uma média ponderada de sua média aritmética e sua média geométrica
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor1 Primeiro valor
     * @param float $valor2 Segundo valor
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function MediaHeroniana($valor1, $valor2, $precisao = null) {
        return GF_Calculo::Precisao(( 1 / 3 * ( $valor1 + GF_Calculo::RaizQuadrada($valor1 * $valor2) + $valor2 )), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaPonderada($valores, $precisao = null)">
    /**
     * Calcula a media ponderada de um conjunto de valores
     *
     * O array de entrada engloba outro array sendo este segundo formado pelo valor
     * seguido de seu peso, como em:
     *
     * array (
     *  array(valor1, peso1),
     *  array(valor2, peso2)
     * )
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array contendo valores e pesos para se tirar as medias
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function MediaPonderada($valores, $precisao = null) {

        foreach ($valores as $linha) {
            $mediaMuestral += $linha[0] * $linha[1];
            $pesos += $linha[1];
        }

        return GF_Calculo::Precisao($mediaMuestral / $pesos, $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MediaQuadratica($valores, $precisao = null)">
    /**
     * Calcula a media quadratica de um conjunto de valores
     *
     * Em matemática, a média quadrática, valor quadrático médio ou RMS (do inglês root mean square)
     * é uma medida estatística da magnitude de uma quantidade variável. Pode calcular para uma
     * série de valores discretos ou para uma função de variável contínua. O nome deriva do facto de
     * que é a raiz quadrada da média aritmética dos quadrados dos valores.
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $valores Array de valores
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function MediaQuadratica($valores, $precisao = null) {
        foreach ($valores as $valor)
            $somaQuadrado += GF_Calculo::Potencia($valor, 2);

        return GF_Calculo::RaizQuadrada($somaQuadrado / count($valores), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Menor($valorA, $valorB)">
    /**
     * Verifica se o valor A e menor que B
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valorA Qualquer variavel para comparar
     * @param mixed $valorB Qualquer variavel para comparar
     * @return bool
     */
    static public function Menor($valorA, $valorB) {
        return ( (!$podeSerIgual & $valorA < $valorB ) | ( $podeSerIgual & $valoA <= $valorB ) );
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MenorOuIgual($valorA, $valorB)">
    /**
     * Verifica se o valor A e menor ou igual a B
     *
     * Ultima revisao: 17/01/2011
     * Versao: 1.04
     *
     * @since 1.04
     * @author Natanael Simoes
     *
     * @param mixed $valorA Qualquer variavel para comparar
     * @param mixed $valorB Qualquer variavel para comparar
     * @return bool
     */
    static public function MenorOuIgual($valorA, $valorB) {
        return ($valoA <= $valorB);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MinimoMultiploComum($valor1, $valor2, $_ = null)">
    /**
     * O número múltiplo comum entre dois números naturais é obtido a partir da interseção
     * dos múltiplos naturais, escolhendo-se o menor excetuando o zero.
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $valor1 Primeiro valor
     * @param integer $valor2 Segundo valor
     * @param integer $_ (opcional)
     * @return integer
     */
    static public function MinimoMultiploComum($valor1, $valor2, $_ = null) {

        $valores = func_get_args();

        array_multisort($valores, SORT_DESC);

        for ($i = 1; $i < count($valores); $i++)
            if (!is_null($valores[$i]))
                $lastMax .= $valores[0] * $valores[$i] / GF_Calculo::MaximoDivisorComum($valores[0], $valores[$i]) . ',';

        $lastMax = substr($lastMax, 0, -1);

        if (count(split(',', $lastMax)) > 1)
            return eval(" return GF_Calculo::MinimoMultiploComum2($lastMax); ");

        else
            return $lastMax;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ModaAgrupado($tabela, $precisao = null)">
    /**
     * Calcula a moda num conjunto de dados agrupados
     *
     * O Modelo de entrada deve conter um Array que engloba todo o conjunto de dados
     * e para cada classse, um outro array, sendo o primeiro valor o limite inferior,
     * o segundo o limite superior e em terceiro a frequencia do intervalo:
     *
     * array(
     *    array(limiteInferior, limiteSuperior, frequencia),
     *    array(limiteInferior, limiteSuperior, frequencia)
     * )
     *
     * Retorna o valor da moda em [0] e a classe modal em [1]
     *
     * Ultima revisao: 04/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $tabela Array contendo os dados agrupados
     * @param integer $precisao Precisao de casas decimais
     * @return mixed Array com o valor da mediana e a classe
     */
    static public function ModaAgrupado($tabela, $precisao = null) {

        $classeModal = null;
        $frequenciaModal = 0;

        for ($pos = 0; $pos < count($tabela); $pos++) {
            if ($tabela[$pos][2] > $frequenciaModal) {
                $classeModal = $pos;
                $frequenciaModal = $tabela[$pos][2];
            }
        }

        $L1 = $tabela[$classeModal][0];
        $D1 = $frequenciaModal - $tabela[$classeModal - 1][2];
        $D2 = $frequenciaModal - $tabela[$classeModal + 1][2];
        $C = $tabela[$classeModal][1] - $tabela[$classeModal][0];

        return array(GF_Calculo::Precisao($L1 + ( ( $D1 / ( $D1 + $D2 ) ) * $C), $precisao), $classeModal + 1);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Modulo($valor)">
    /**
     * Calcula o modulo de um valor, tambem conhecido por valor absoluto.
     *
     * Está associado à idéia de distância de um ponto até sua origem (o zero), ou seja, a sua magnitude.
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Numero para ter o modulo calculado
     * @return float
     */
    static public function Modulo($valor) {
        return abs($valor);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public MultiplicacaoMatriz($matrizA, $matrizB, $_ = null)">
    /**
     * Multiplicacao entre valores de matrizes
     * 
     * So havera produto de A . B se o numero de colunas de A for igual ao 
     * numero de colunas de B. O produto gerado possui quantidade de linhas igual
     * a da matriz A e colunas como na B.
     * 
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     * 
     * @since 1.00
     * @author Natanael Simoes
     * 
     * @param mixed $matrizA Primeira matriz
     * @param mixed $matrizB Segunda matriz
     * @param mixed $_ (opcional)
     * @return mixed 
     */
    static public function MultiplicacaoMatriz($matrizA, $matrizB, $_ = null) {
        $matrizes = func_get_args();

        for ($i = 0; $i < count($matrizes) - 1; $i++)
            if (count($matrizes[$i][0]) != count($matrizes[$i + 1]))
                return 'Fail';

        foreach ($matrizes as $matriz) {

            if (is_null($matrizCalc))
                $matrizCalc = $matriz;
            else {

                $newMat = array();

                for ($i = 0; $i < count($matrizCalc); $i++) {

                    for ($j = 0; $j < count($matriz[0]); $j++) {

                        $soma = 0;

                        for ($k = 0; $k < count($matrizCalc[$i]); $k++) {

                            $soma += $matrizCalc[$i][$k] * $matriz[$k][$j];
                        }

                        $newMat[$i][$j] = $soma;
                    }
                }

                $matrizCalc = $newMat;
            }
        }

        return $matrizCalc;
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public OctalParaBinario($octal)">
    /**
     * Converte octal em numero binario
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $octal Octal para converter
     * @return string
     */
    static public function OctalParaBinario($octal) {
        return GF_Calculo::DecimalParaBinario(GF_Calculo::OctalParaDecimal($octal));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public OctalParaDecimal($octal)">
    /**
     * Converte octal em numero decimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $octal Octal para converter
     * @return integer
     */
    static public function OctalParaDecimal($octal) {
        return octdec($octal);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public OctalParaHexadecimal($octal)">
    /**
     * Converte octal em numero hexadecimal
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $octal Octal para converter
     * @return string
     */
    static public function OctalParaHexadecimal($octal) {
        return GF_Calculo::DecimalParaHexadecimal(GF_Calculo::OctalParaDecimal($octal));
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Par($numero)">
    /**
     * Verifica se um numero e par
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $numero Numero para verificar
     * @return bool
     */
    static public function Par($numero) {
        return ($numero % 2 == 0);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Pi($precisao = null)">
    /**
     * Valor de PI na forma real com opcao de precisao de casas decimais
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Pi($precisao = null) {
        return GF_Calculo::Precisao(pi(), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Pitagoras($a = null, $b = null, $h = null)">
    /**
     * Calcula um dos lados de um triangulo utilizando o Teorema de Pitagoras
     * O lado que estiver nulo sera calculado e sera este o valor de retorno
     * Caso todos os parametros sejam passados, o metodo procura saber se
     * os valores estao corretos, ou seja, se e possivel fazer um triangulo com
     * as medidas entradas
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a Tamanho de um dos catetos
     * @param float $b Tamanho de um dos catetos
     * @param float $h Tamanho da hipotenusa
     * @return float|bool
     */
    static public function Pitagoras($a = null, $b = null, $h = null) {

        switch (null) {

            case $h:

                return GF_Calculo::RaizQuadrada(GF_Calculo::Potencia($a, 2) + GF_Calculo::Potencia($b, 2));

            case $a:

                return GF_Calculo::RaizQuadrada(GF_Calculo::Potencia($h, 4) - GF_Calculo::Potencia($b, 2));

            case $b:

                return GF_Calculo::RaizQuadrada(GF_Calculo::Potencia($h, 4) - GF_Calculo::Potencia($a, 2));

            default:

                return (GF_Calculo::Potencia($h, 2) == GF_Calculo::Potencia($a, 2) + GF_Calculo::Potencia($b, 2));
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Potencia($valor, $expoente, $precisao = null)">
    /**
     * Eleva um valor a uma potencia
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para potencializar
     * @param float $expoente Expoente da potencia
     * @param integer $precisao Precisa de casas decimais
     * @return float
     */
    static public function Potencia($valor, $expoente, $precisao = null) {
        return GF_Calculo::Precisao(pow($valor, $expoente), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Precisao($valor, $precisao = null)">
    /**
     * Retorna um valor com precisao de casas decimais
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para avaliar
     * @param integer $precisao Precisao de casas decimais. Zero para o numero inteiro mais proximo
     * @return float
     */
    static public function Precisao($valor, $precisao = null) {
        return (is_null($precisao) || trim($precisao) == '') ? $valor : round($valor, $precisao);
    }

// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="static public Primo($numero)">
    /**
     * Verifica se um numero e primo
     *
     * Ultima revisao: 10/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param integer $numero Numero para verificar
     * @return bool
     */
    static public function Primo($numero) {
        switch ($numero) {
            case 2:
            case 3:
            case 5:
                return true;

            default:
                if (GF_Calculo::Divisivel($numero, 2))
                    return false;
                else if (GF_Calculo::Divisivel($numero, 3))
                    return false;
                else if (GF_Calculo::Divisivel($numero, 5))
                    return false;
                else
                    return true;
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ProgressaoGeometrica($a1, $q, $nTotal)">
    /**
     * É toda seqüência em que cada termo, a partir do segundo, é igual ao seu 
     * antecessor multiplicado por um número constante q (razão). 
     * 
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     * 
     * @since 1.00
     * @author Natanael Simoes
     * 
     * @param float $a1 Primeiro termo da progressao
     * @param float $q Razao da progressao
     * @param integer $nTotal Numero total de termos
     * @return mixed Retorna um array sendo esta a PG
     */
    static public function ProgressaoGeometrica($a1, $q, $nTotal) {
        for ($i = 1; $i <= $nTotal; $i++)
            $arPG['A' . ($i + 1)] = $a1 * GF_Calculo::Potencia($q, $i - 1);
        return $arPG;
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ProgressaoGeometrica_Produto($a1, $q, $n, $precisao = null)">
    /**
     * Calcula o produto dos N primeiros termos de uma PG
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a1 Primeiro termo da PG
     * @param float $q Razao da PG
     * @param integer $n Numero do ultimo termo para obter o produto
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ProgressaoGeometrica_Produto($a1, $q, $n, $precisao = null) {
        $pg = GF_Calculo::ProgressaoGeometrica($a1, $q, $n);
        return GF_Calculo::RaizQuadrada(GF_Calculo::Potencia($a1 * array_pop($pg), $n), $precisao);
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ProgressaoGeometrica_Soma($a1, $q, $n = null, $precisao = null)">
    /**
     * Soma dos N primeiros termos de uma PG
     * Caso N seja nulo, o metodo calculara a soma dos infinitos termos da PG
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a1 Primeiro termo da PG
     * @param float $q Razao da PG
     * @param integer $n Numero do ultimo termo para obter o produto
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function ProgressaoGeometrica_Soma($a1, $q, $n = null, $precisao = null) {
        if (is_null($n)) // CALCULA SOMA DOS INFINITOS TERMOS DA PG
            return GF_Calculo::Precisao($a1 / ( 1 - $q ), $precisao);
        else
            return GF_Calculo::Precisao(( $a1 * (1 - GF_Calculo::Potencia($q, $n) ) ) / (1 - $q), $precisao);
    }

    // </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public ProgressaoGeometrica($a1, $q, $n, $precisao = null)">
    /**
     * Retorna o termo N de uma PG
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $a1 Primeiro termo da PG
     * @param float $q Razao da PG
     * @param integer $n Numero do termo sendo procurado
     * @param integer $precisao Precisao de casas decimais
     * @return <type>
     */
    static public function ProgressaoGeometrica_Termo($a1, $q, $n, $precisao = null) {
        $pg = GF_Calculo::ProgressaoGeometrica($a1, $q, $n);
        return GF_Calculo::Precisao(array_pop($pg), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public RadianoParaGraus($radiano, $precisao = null)">
    /**
     * Transforma radianos em graus
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $radiano Radianos para transformar
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function RadianoParaGraus($radiano, $precisao = null) {
        return GF_Calculo::Precisao(rad2deg($radiano), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Raiz($valor, $radical, $precisao = null)">
    /**
     * Calcula uma raiz
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para retirar raiz
     * @param float $radical Radical/indice de potencializacao
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Raiz($valor, $radical, $precisao = null) {
        return GF_Calculo::Precisao(GF_Calculo::Potencia($valor, 1 / $radical), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public RaizCubica($valor, $precisao = null)">
    /**
     * Calcula a raiz cubica de um valor
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor para retirar a raiz cubica
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function RaizCubica($valor, $precisao = null) {
        return GF_Calculo::Raiz($valor, 3, $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public RaizQuadrada($valor, $precisao = null)">
    /**
     * Retira a raiz quadrada de um valor
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $valor Valor de que sera retirada a raiz quadrada
     * @param integer $precisao Precisa de casas decimais
     * @return float
     */
    static public function RaizQuadrada($valor, $precisao = null) {
        return GF_Calculo::Raiz($valor, 2, $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Secante($angulo, $precisao = null)">
    /**
     * Calcula a secante de um angulo
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Angulo para calcular
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Secante($angulo, $precisao = null) {
        return GF_Calculo::Precisao(1 / GF_Calculo::Cosseno($angulo), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Seno($angulo, $precisao = null)">
    /**
     * Calcula o seno de um angulo
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Angulo em graus
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Seno($angulo, $precisao = null) {
        return GF_Calculo::Precisao(sin(deg2rad($angulo)), $precisao);
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public SubtracaoMatriz($matrizA, $matrizB, $_ = null)">
    /**
     * Realiza a subtracao entre duas matrizes de mesma ordem
     *
     * Ultima revisao: 11/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $matrizA Primeira matriz
     * @param mixed $matrizB Segunda matriz
     * @param mixed $_ (opcional)
     * @return mixed
     */
    static public function SubtracaoMatriz($matrizA, $matrizB, $_ = null) {
        $matrizes = func_get_args();

        foreach ($matrizes as $matriz)
            if (count($matrizA) != count($matriz))
                return 'Todas as matrizes devem ter mesmo numero de linha e colunas.';
            else
                for ($i = 0; $i < count($matrizA); $i++)
                    if (array_keys($matrizA[$i]) != array_keys($matriz[$i]))
                        return 'Todas as matrizes devem ter mesmo numero de linha e colunas.';

        $linhas = count($matrizes[0]);
        $colunas = count($matrizes[0][0]);
        $sinal = false;

        foreach ($matrizes as $matriz) {

            for ($linha = 0; $linha < $linhas; $linha++)
                for ($coluna = 0; $coluna < $colunas; $coluna++)
                    if (!$sinal)
                        $newMat[$linha][$coluna] += $matriz[$linha][$coluna];
                    else
                        $newMat[$linha][$coluna] += ( -1) * $matriz[$linha][$coluna];

            $sinal = !$sinal;
        }

        return $newMat;
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Tales($termo1 = array(1,1), $termo2 = array(1,1))">
    /**
     * Calcula um dos itens da equivalencia de dois razoes utilizando o Teorema de Tales
     * O valor do array que estiver nulo sera aquele procurado pelo metodo
     * Se todos os valores estiverem preenchidos, entao o metodo verifica se
     * as duas razoes sao equivalentes
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param mixed $termo1 Array com os valores do primeiro termo
     * @param mixed $termo2 Array com os valores do segundo termo
     * @return float|bool
     */
    static public function Tales($termo1 = array(1, 1), $termo2 = array(1, 1)) {
        switch (null) {
            case $termo1[0]:

                return $termo1[1] * $termo2[0] / $termo2[1];

            case $termo1[1]:

                return $termo2[0] / $termo1[0] * $termo2[1];

            case $termo2[0]:

                return $termo2[1] * $termo1[0] / $termo1[1];

            case $termo2[1]:

                return $termo1[0] / $termo2[0] * $termo1[1];

            default:

                return ($termo1[0] / $termo1[1] == $termo2[0] / $termo2[1]);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Tales2($item1Termo1 = null, $item2Termo1 = null, $item1Termo2 = null, $item2Termo2 = null)">
    /**
     * Calcula um dos itens da equivalencia de dois razoes utilizando o Teorema de Tales
     * O valor do array que estiver nulo sera aquele procurado pelo metodo
     * Se todos os valores estiverem preenchidos, entao o metodo verifica se
     * as duas razoes sao equivalentes
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $item1Termo1 Valor do primeiro item do primeiro termo
     * @param float $item2Termo1 Valor do segundo item do primeiro termo
     * @param float $item1Termo2 Valor do primeiro item do segundo termo
     * @param float $item2Termo2 Valor do segundo item do segundo termo
     * @return float|bool
     */
    static public function Tales2($item1Termo1 = null, $item2Termo1 = null, $item1Termo2 = null, $item2Termo2 = null) {
        switch (null) {
            case $item1Termo1:

                return $item2Termo1 * $item1Termo2 / $item2Termo2;

            case $item2Termo1:

                return $item1Termo2 / $item1Termo1 * $item2Termo2;

            case $item1Termo2:

                return $item2Termo2 * $item1Termo1 / $item2Termo1;

            case $item2Termo2:

                return $item1Termo1 / $item1Termo2 * $item2Termo1;

            default:

                return ($item1Termo1 / $item2Termo1 == $item1Termo2 / $item2Termo2);
        }
    }

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="static public Tangente($angulo, $precisao = null)">
    /**
     * Tangente de um angulo
     *
     * Ultima revisao: 03/01/2011
     * Versao: 1.00
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param float $angulo Angulo em graus
     * @param integer $precisao Precisao de casas decimais
     * @return float
     */
    static public function Tangente($angulo, $precisao = null) {
        return GF_Calculo::Precisao(tan(deg2rad($angulo)), $precisao);
    }

// </editor-fold>

    static public function InputParaPonto($valor) {

        foreach (split(',', $valor) as $coord)
            $ponto[] = trim($coord);

        return $ponto;
    }

    static public function TextareaParaMatriz($valor) {


        foreach (split("\n", $valor) as $linha)
            $matriz[] = split(' ', $linha);

        return $matriz;
    }

}

?>