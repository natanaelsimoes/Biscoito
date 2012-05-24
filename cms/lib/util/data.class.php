<?php

/**
 * FUNCOES GLOBAIS :: DATA
 *
 * PHP versions 4 and 5
 *
 * Copyright (c) 2010 Natanael Simoes
 *
 * DESCRICAO
 *
 * @package     Funcoes Globais
 * @subpackage  Data
 * @category    Functions
 * @author      Natanael Simoes <natanael@fabricadecodigo.com.br>
 * @copyright   Copyright (c) 2010 Natanael Simoes
 * @license     http://www.opensource.org/licenses/lgpl-3.0.html LGPLv3
 * @version     1.04
 * @link        http://www.fabricadecodigo.com.br/
 */
class CMS_Data {

    // <editor-fold defaultstate="collapsed" desc="static public AdicionarDias($dias, $data = -1)">
    /**
     * Retorna uma data adicionando os dias passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     * @uses DateTime::__construct()
     * @uses DateTime::setDate()
     * @uses DateTime::format()
     *
     * @param integer $dias Dias para adicionar
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static public function AdicionarDias($dias, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data), GF_Data::Mes($data), GF_Data::Dia($data) + $dias);
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public AdicionarMeses($meses, $data = -1)">
    /**
     * Retorna uma data adicionando os meses passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     * @uses DateTime::__construct()
     * @uses DateTime::setDate()
     * @uses DateTime::format()
     *
     * @param integer $meses Meses para adicionar
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function AdicionarMeses($meses, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data), GF_Data::Mes($data) + $meses, GF_Data::Dia($data));
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public AdicionarAnos($anos, $data = -1)">
    /**
     * Retorna uma data adicionando os anos passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     * @uses DateTime::__construct()
     * @uses DateTime::setDate()
     * @uses DateTime::format()
     *
     * @param integer $anos Anos para adicionar
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function AdicionarAnos($anos, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data) + $anos, GF_Data::Mes($data), GF_Data::Dia($data));
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Ano($data = -1)">
    /**
     * Retorna o ano de uma data
     * 
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @uses GF_Data::ToPtBR()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static public function Ano($data = -1) {
        return substr(GF_Data::ToPtBR($data), 6, 4);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public DataCurta($data = -1)">
    /**
     * Retorna a data num formato curto: 01/01/11
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function DataCurta($data = -1) {
        return GF_Data::Dia($data) . '/' . GF_Data::Mes($data) . '/' . substr(GF_Data::Ano($data), 2, 2);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public DataLonga($data = -1)">
    /**
     * Retorna a data num formato longo: Domingo, 01 de Janeiro de 2011
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function DataLonga($data = -1) {
        return GF_Data::DiaSemana($data) . ', ' . GF_Data::Dia($data) . ' de ' . GF_Data::MesNome(GF_Data::Mes($data)) . ' de ' . GF_Data::Ano($data);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Dia($data = -1)">
    /**
     * Retorna o dia de uma data
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::ToPtBR()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function Dia($data = -1) {
        return substr(GF_Data::ToPtBR($data), 0, 2);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public DiaSemana($data = -1)">
    /**
     * Retorna o dia da semana de uma data
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::ToPtBR()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function DiaSemana($data = -1) {

        $data = GF_Data::ToPtBR($data);

        $diasemana = date("w", mktime(0, 0, 0, substr($data, 3, 2), substr($data, 0, 2), substr($data, 6, 4)));

        switch ($diasemana) {
            case 0: return "Domingo";
            case 1: return "Segunda-Feira";
            case 2: return "Terça-Feira";
            case 3: return "Quarta-Feira";
            case 4: return "Quinta-Feira";
            case 5: return "Sexta-Feira";
            case 6: return "Sábado";
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Formato($formato, $data = -1)">
    /**
     * Retorna uma data no formato desejado
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.03
     * @author Natanael Simoes
     *
     * @uses GF_Data::Ano()
     * @uses GF_Data::Dia()
     * @uses GF_Data::Mes()
     * @uses DateTime::__construct()
     * @uses DateTime::setDate()
     * @uses DateTime::format()
     *
     * @param string $formato Formato desejado: dd/mm/aaaa  d/m/Y   Y/m/d   m/d/Y    [etc]
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function Formato($formato, $data = -1) {

        $formato = str_replace('dd', 'd', $formato);
        $formato = str_replace('mm', 'm', $formato);
        $formato = str_replace('aaaa', 'Y', $formato);
        $formato = str_replace('aa', 'y', $formato);

        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data) + $anos, GF_Data::Mes($data), GF_Data::Dia($data));
        return $new_data->format($formato);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Mes($data = -1)">
    /**
     * Retorna o mes de uma data
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::ToPtBR()
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function Mes($data = -1) {
        return substr(GF_Data::ToPtBR($data), 3, 2);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public MesNome($data = -1)">
    /**
     * Retorna o nome de um mes
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @uses GF_Data::Mes()
     * 
     * @param string|integer $mes Pode ser o numero do mes (1-12) ou uma data. Caso a variavel nao seja informada, o mes atual sera utilizado
     * @return string
     */
    static function MesNome($mes = -1) {

        if ($mes == -1)
            $mes = date('M');
        else if (strlen($mes) >= 8)
            $mes = GF_Data::Mes($mes);

        switch ($mes) {
            case '01': case 1: return 'Janeiro';
            case '02': case 2: return 'Fevereiro';
            case '03': case 3: return 'Março';
            case '04': case 4: return 'Abril';
            case '05': case 5: return 'Maio';
            case '06': case 6: return 'Junho';
            case '07': case 7: return 'Julho';
            case '08': case 8: return 'Agosto';
            case '09': case 9: return 'Setembro';
            case '10': case 10: return 'Outubro';
            case '11': case 11: return 'Novembro';
            case '12': case 12: return 'Dezembro';
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public Saudacao()">
    /**
     * Retorna uma saudacao baseado no horario do dia
     * <code>
     * Se 18 <= horario <= 3 : Boa noite
     * Se horario >= 12      : Boa tarde
     * Se horario >= 4       : Bom dia
     * </code>
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @param integer $hora Hora para saudar. Se em branco, pega a hora atual
     * @return string
     */
    static function Saudacao($hora = -1) {

        if ($hora == -1)
            $hora = date('H');

        switch (true) {

            case $hora >= 18:

                return 'Boa noite';

            case ($hora >= 12 & $hora < 18):

                return 'Boa tarde';

            case ($hora >= 4 & $hora < 12):

                return 'Bom dia';

            case $hora <= 3:

                return 'Boa noite';
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public SubtrairDias($dias, $data = -1)">
    /**
     * Retorna uma data subtraindo os dias passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @param integer $dias Dias para subtrair
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function SubtrairDias($dias, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data), GF_Data::Mes($data), GF_Data::Dia($data) - $dias);
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public SubtrairMeses($meses, $data = -1)">
    /**
     * Retorna uma data subtraindo os meses passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @param integer $meses Meses para subtrair
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function SubtrairMeses($meses, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data), GF_Data::Mes($data) - $meses, GF_Data::Dia($data));
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public SubtrairAnos($anos, $data = -1)">
    /**
     * Retorna uma data subtraindo os anos passados por parametro
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.01
     * @author Natanael Simoes
     *
     * @param integer $anos Anos para subtrair
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function SubtrairAnos($anos, $data = -1) {
        $new_data = new DateTime();
        $new_data->setDate(GF_Data::Ano($data) - $anos, GF_Data::Mes($data), GF_Data::Dia($data));
        return $new_data->format('d/m/Y');
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ToPtBR($data = -1)">
    /**
     * Traduz um data para o padrao brasileiro, se necessario.
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.00
     * @author Natanael Simoes
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static function ToPtBR($data = -1) {

        if ($data == -1)
            return date('d/m/Y');

        else if (substr($data, 4, 1) >= '0' & substr($data, 4, 1) <= '9')
            return str_replace(array('-', '.'), '/', $data);

        else
            return substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="static public ToEnUS($data = -1)">
    /**
     * Traduz um data para o padrao ingles, se necessario.
     *
     * Ultima revisao: 06/01/2011
     * Versao: 1.04
     *
     * @since 1.02
     * @author Natanael Simoes
     *
     * @param string $data Caso uma data nao seja informada, a data atual sera utilizada
     * @return string
     */
    static public function ToEnUS($data = -1) {

        if ($data == -1)
            return date('Y-m-d');

        else if (substr($data, 4, 1) == '-' || substr($data, 4, 1) == '/' || substr($data, 4, 1) == '.')
            return str_replace(array('/', '.'), '-', $data);

        else
            return substr($data, 6, 4) . '-' . substr($data, 3, 2) . '-' . substr($data, 0, 2);

    }

    // </editor-fold>
}

?>
