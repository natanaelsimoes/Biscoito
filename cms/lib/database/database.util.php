<?php

namespace Biscoito\Lib\Database;

use Biscoito\Lib\Objeto as Objeto;
use Biscoito\Lib\Util;

interface TIDatabaseUtil {

    public function TratarErro($pdoE, $obj, $comando);
}

class TDatabaseUtil {

    private $databaseUtil;
    private $configuracoes;

    public function __construct() {
        $this->configuracoes = $GLOBALS['_BiscoitoConfig']->database;
        eval("\$this->databaseUtil = new Biscoito\Lib\Database\T{$this->configuracoes->driver}Util;");
    }

    /**
     * Retorna o nome de classe equivalente ao passar o nome de uma tabela.
     * @param string $tabela
     * @return string Nome da classe equivalente 
     */
    public static function getClasseTabela($tabela) {
        $posicao = strpos($tabela, '_');
        $classe = ($posicao !== false) ? substr($tabela, 0, $posicao) : $tabela;
        return $classe;
    }

    public static function getClasseObjeto($obj) {
        $namespace = '';
        $namespace = get_class($obj);
        return TDatabaseUtil::getClasseNamespace($namespace);
    }

    public static function getClasseNamespace($namespace) {
        $explodedNamespace = null;
        $explodedNamespace = explode('\\', $namespace);
        return array_pop($explodedNamespace);
    }

    public static function getPastaNamespace($namespace) {
        $explodedNamespace = null;
        $explodedNamespace = explode('\\', $namespace);
        array_pop($explodedNamespace);
        return array_pop($explodedNamespace);
    }

    /**
     * Retorna o par�metro exibido na mensagem de erro do bando de dados.<br /><br />
     * Ex: Erro SQL retorna a mensagem "Coluna 'nome' n�o existe"<br />
     * Logo esta fun��o retornar� <i>nome</i>.
     * @param string $mensagem Mensagem de erro do banco de dados
     * @return string Par�metro do erro
     */
    public static function getParametroErro($mensagem) {
        $mensagem = explode("'", $mensagem);
        $new_msg_erro = explode('.', $mensagem[1]);
        return array_pop($new_msg_erro);
    }

    public static function getParametroErroCompleto($mensagem) {
        $mensagem = explode("'", $mensagem);
        return $mensagem[1];
    }

    /**
     * Retorna as rela��es que a classe tem com outras classes
     * @param string $classe Nome da classe
     * @return mixed Array com as rela��es 
     */
    public static function getRelacionamentosClasse($classe) {
        $relacaoClasse = get_class_vars($classe);
        return $relacaoClasse['__relacao'];
    }

    /**
     * Retorna o nome da tabela principal de um comando SQL
     * @param string $comando Comando SQL
     * @return string Nome da tabela
     */
    public static function getTabelaComando($comando) {
        $palavras = explode(' ', trim($comando));
        switch (strtoupper($palavras[0])) {
            case 'INSERT': case 'DELETE': return $palavras[2];
            case 'UPDATE': return $palavras[1];
            case 'SELECT':
                $campoInexistente = SQLUtil::retornaParametroErroCompleto(mysql_error());
                if (strpos($campoInexistente, '.') !== false) {
                    $mensagem = explode('.', $campoInexistente);
                    return $palavras[array_search($mensagem[0], $palavras) - 1];
                }
                return $palavras[array_search('FROM', $palavras) + 1];
        }
    }

    public static function getTabelaComandoChaveEstrangeira($comando) {
        $palavras = explode(' ', trim($comando));
        return $palavras[9];
    }

    public static function getTabelaMensagem($mensagem) {
        $mensagem = explode("'", $mensagem);
        $mensagem = explode(".", $mensagem[1]);
        return strtolower($mensagem[0]);
    }

    public static function MontarMensagemErro($codigo, $mensagem, $dica = '') {
        $mensagemErro = '';
        $mensagemErro = "ERR-DB-$codigo: $mensagem";
        $mensagemErro.= ( empty($dica)) ? "." : "[DICA: $dica.]";
        return $mensagemErro;
    }

    public static function getConfiguracaoClasse($classe) {

        global $_Biscoito;

        $filename = $refObj = null;

        $refObj = new \ReflectionClass($classe);

        $filenameFormat = '%s%s/config.xml';

        $filename = sprintf($filenameFormat, '', dirname($refObj->getFileName()));

        $nomeModulo = ($_Biscoito->getModulo() == 'administrador') ? $_Biscoito->getModuloAuxiliar() : $_Biscoito->getModulo();

        if (!file_exists($filename))
            $filename = sprintf($filenameFormat, 'modulos/', $nomeModulo);

        return simplexml_load_file($filename);
    }

    /**
     * Trata erros ocorridos durante a execu��o de SQL no banco de dados e cria as
     * estruturas necess�rias utilizando TORM para a execu��o com sucesso
     * do comando SQL.
     * 
     * @uses TORM
     * 
     * @param \PDOException $pdoE Exce��o disparada pela conex�o
     * @return bool Retorno falso causado por erro na configura��o da classe
     */
    public function TratarErro($pdoE, $obj, $comando) {
        return $this->databaseUtil->TratarErro($pdoE, $obj, $comando);
    }

}

class TMySQLUtil implements TIDatabaseUtil {

    private $namespace;
    private $tabela;
    private $obj;

    private function onCreateTable() {

        $orm = TORM::singleton();

        $configuracaoClasse = TDatabaseUtil::getConfiguracaoClasse($this->namespace);

        $classe = TDatabaseUtil::getClasseTabela($this->tabela);

        $onCreateEvent = "on{$classe}Create";

        foreach (explode('\n', $configuracaoClasse->sql->$onCreateEvent) as $comando)
            if (!empty($comando))
                $orm->ExecutarComando($comando, $this->obj);
    }

    /**
     *
     * @param \PDO $pdo
     * @param \PDOException $pdoE
     * @return boolean 
     */
    public function TratarErro($pdoE, $obj, $comando) {

        $orm = TORM::singleton();
        
        $this->obj = $obj;

        $this->namespace = get_class($this->obj);                

        switch ($pdoE->getCode()) {

            case 1005: // TABELA UTILIZADA DURANTE UM COMANDO DE ADICAO DE CHAVE ESTRANGEIRA NAO EXISTE

                $this->tabela = TDatabaseUtil::getTabelaComandoChaveEstrangeira($comando);

                $orm->CriarTabela($this->tabela, $this->obj);

                $this->onCreateTable($this->tabela, $this->obj);

                return true;

            case 1146: // TABELA NAO EXISTE

                $this->tabela = TDatabaseUtil::getClasseNamespace($this->namespace);

                $orm->CriarTabela($this->tabela, $this->obj);

                $this->onCreateTable($this->tabela, $this->obj);

                return true;

            case 1049: // DATABASE NAO EXISTE

                return true;

            case 1054: // CAMPO NAO EXISTE 

                $configuracaoClasse = array();

                $this->tabela = TDatabaseUtil::getClasseNamespace($this->namespace);

                #var_dump($this->tabela);

                $classe = TDatabaseUtil::getClasseTabela($this->tabela);

                #var_dump($classe);

                $configuracaoClasse = TDatabaseUtil::getConfiguracaoClasse($this->namespace);

                #var_dump($configuracaoClasse);

                $atributosClasse = array_keys(get_object_vars($configuracaoClasse->classes->$classe));

                #var_dump($atributosClasse);
                #var_dump($relacaoClasse);

                $campoInexistente = TDatabaseUtil::getParametroErro($pdoE->getMessage());

                #var_dump($campoInexistente); 

                if ((strpos($campoInexistente, '_id') === false) && (in_array($campoInexistente, $atributosClasse)))
                    $orm->AdicionarCampo($this->tabela, $campoInexistente, $configuracaoClasse->classes->$classe->$campoInexistente, $this->obj);

                else if (in_array($campoInexistente, $atributosClasse)) {

                    $configuracaoCampoInexistente = $configuracaoClasse->classes->$classe->$campoInexistente;

                    $nulo = ($configuracaoCampoInexistente['nulo'] == 'true') ? '' : 'NOT NULL';

                    $orm->AdicionarCampo($this->tabela, $campoInexistente, "INTEGER $nulo", $this->obj);

                    $tabelaEstrangeira = $GLOBALS['_Biscoito']->getClasseRelacionamento($this->tabela, $campoInexistente);

                    $nomeChaveEstrangeira = sprintf('fk_%s_%s', $this->tabela, $tabelaEstrangeira);

                    $orm->AdicionarChaveEstrangeira($nomeChaveEstrangeira, $this->tabela, $campoInexistente, $tabelaEstrangeira, 'id', $this->obj);
                } else if (substr($campoInexistente, 0, -3) == $defaultTable) {
                    $orm->AdicionarCampo($classe, $campoInexistente, 'INTEGER NOT NULL', $conexao);
                    $orm->AdicionarChaveEstrangeira('fk_' . $campoInexistente, SQLUtil::retornaTabelaComando($comando), $campoInexistente, $defaultTable, 'id', $conexao);
                }
                else
                    return false;

                return true;

            case 1062:

                header("Content-Type: text/html; charset=ISO-8859-1", true);

                echo 'Já existe um registro com estas informações. Por favor tente uma entrada diferente.';

                exit;

            default: echo TDatabaseUtil::MontarMensagemErro($pdoE->getCode(), $pdoE->getMessage(), $comando);

                exit;
        }
    }

}

class TORM {

    private static $instance;

    public static function singleton() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    // <editor-fold defaultstate="collapsed" desc="public static function adicionarCampo($tabela, $nomeCampo, $informacaoCampo, &$conexao)">
    /**
     * Adiciona um campo a uma tabela
     * 
     * @param string $tabela Nome da tabela
     * @param string $nomeCampo Nome do campo
     * @param string $informacaoCampo Estrutura do Campo. (ex 'VARCHAR(50) NOT NULL')
     * @param resource $conexao Recurso de conexão com o banco de dados
     */
    public function AdicionarCampo($tabela, $nomeCampo, $informacaoCampo, $obj) {
        $comando = "ALTER TABLE $tabela ADD COLUMN $nomeCampo $informacaoCampo";
        return $this->ExecutarComando($comando, $obj);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public static function adicionarChaveEstrangeira($nomeChave, $tabelaLocal, $colunaLocal, $tabelaEstrangeira, $colunaEstrangeira, &$conexao)">
    /**
     * Adiciona um índice de chave estrangeira a uma tabela
     * 
     * @param string $nomeChave Nome do índice de chave estrangeira
     * @param string $tabelaLocal Nome da tabela onde a chave estrangeira será criada
     * @param string $colunaLocal Nome da coluna em que será aplicada a chave estrangeira
     * @param string $tabelaEstrangeira Nome da tabela em que a chave estrangeira se baseará
     * @param string $colunaEstrangeira Nome da coluna da tabela em que a chave estrangeira se baseará
     * @param resource $conexao Recurso de conexão com o banco de dados
     */
    public function AdicionarChaveEstrangeira($nomeChave, $tabelaLocal, $colunaLocal, $tabelaEstrangeira, $colunaEstrangeira, $obj) {
        $comando = "ALTER TABLE $tabelaLocal ADD FOREIGN KEY $nomeChave ($colunaLocal) REFERENCES $tabelaEstrangeira ($colunaEstrangeira) ON DELETE CASCADE ON UPDATE CASCADE";
        $this->ExecutarComando($comando, $obj);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public static function criarBaseDados($base, &$conexao)">
    /**
     * Cria uma base de dados no SGBD configurado
     * 
     * @param string $base Nome da base de dados
     * @param resource $conexao Recurso de conexão com o banco de dados
     */
    public function CriarBaseDados($base) {
        $comando = "CREATE DATABASE $base";
        return $this->ExecutarComando($comando, null);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public static function criarTabela($tabela, &$conexao)">
    /**
     * Cria uma tabela no banco de dados
     * 
     * @param string $tabela
     * @param resource $conexao Recurso de conexão com o banco de dados
     */
    public function CriarTabela($tabela, $obj) {
        $comando = "CREATE TABLE $tabela (id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT) ENGINE=INNODB CHARSET=latin1";
        return $this->ExecutarComando($comando, $obj);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="public static function executarComando($comando, &$conexao)">
    /**
     * Executa um comando SQL no banco de dados
     * 
     * @param string $comando Comando SQL
     * @param resource $conexao Recurso de conexão com o banco de dados
     */
    public function ExecutarComando($comando, $obj) {
        $conexao = new TDatabase;
        $conexao->AbrirConexao();
        return $conexao->ExecutarComando($comando, $obj);
    }

    // </editor-fold>
}

?>