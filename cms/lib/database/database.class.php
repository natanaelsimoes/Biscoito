<?php

namespace Biscoito\Lib\Database;

interface TIDatabase {

    public function AbrirConexao($servidor, $usuario, $senha, $base);

    public function ExecutarComando($comando, $obj);

    public function getUltimoId();

    public function FecharConexao();

    public function Selecionar($comando, $obj = null, $pagina = 0, $quantidade = 0);
}

class TDatabase {

    private $conexaoAberta;
    private $database;
    private $configuracoes;

    public function __construct() {
        $this->configuracoes = $GLOBALS['_BiscoitoConfig']->database;
        eval("\$this->database = new Biscoito\Lib\Database\T{$this->configuracoes->driver};");
        $this->conexaoAberta = false;
    }

    /**
     * Abre conex�o com o banco de dados
     * @param string $servidor Endere�o do servidor
     * @param string $usuario Nome de usu�rio
     * @param string $senha Senha
     * @param string $base Nome da base de dados
     */
    public function AbrirConexao() {
        $this->conexaoAberta =
                $this->database->AbrirConexao(
                $this->configuracoes->servidor
                , $this->configuracoes->usuario
                , $this->configuracoes->senha
                , $this->configuracoes->base);
        if (!$this->conexaoAberta)
            die('ERR-DB-GERAL#001: Falha ao abrir conex�o com banco. Verifique as configura��es.');
    }

    /**
     * Executa um comando no banco de dados configurado
     * @param string $comando Comando SQL
     * @return integer|bool ID (int) = Quando ocorrer um INSERT bem sucedido ou TRUE|FALSE quando for executado outro tipo de comando
     */
    public function ExecutarComando($comando, $obj) {
        if ($this->conexaoAberta)
            $this->database->ExecutarComando($comando, $obj);
        else
            die('ERR-DB-GERAL#002: Tentativa de execu��o de comando com conex�o fechada.');
    }

    /**
     * Fecha conexao com banco de dados
     */
    public function FecharConexao() {
        $this->conexaoAberta = !$this->database->FecharConexao();
    }

    public function getUltimoId() {
        $this->database->getUltimoId();
    }

    /**
     * Executa um comando de selecao no banco de dados configurado
     * @param string $comando Comando SQL
     * @param mixed $obj Objeto sendo tratado
     * @return mixed Array com a cole��o de dados retornados 
     */
    public function Selecionar($comando, $obj = null, $pagina = 1, $quantidade = 0) {
        return $this->database->Selecionar($comando, $obj, $pagina, $quantidade);
    }

}

class TMySQL implements TIDatabase {

    /**
     * Variavel que caracteriza a conexao com o banco de dados
     * @var \PDO
     */
    private $conexao;

    /**
     *
     * @var TDatabaseUtil
     */
    private $util;

    /**
     *
     * @var \PDOStatement
     */
    private $pdoStatement;

    public function AbrirConexao($servidor, $usuario, $senha, $base) {
        try {
            $this->conexao = new \PDO("mysql:dbname=$base;host=$servidor", $usuario, $senha);
            return true;
        } catch (\PDOException $e) {
            $this->util = new TDatabaseUtil;
            $this->util->TratarErro($e);
            return false;
        }
    }

    public function ExecutarComando($comando, $obj) {

        $bSQLExecuted = false;
        $pdoErrorInfo = null;

        do {
            try {
                $this->pdoStatement = $this->conexao->prepare($comando);
                $bSQLExecuted = $this->pdoStatement->execute();
                if (!$bSQLExecuted) {
                    $pdoErrorInfo = $this->pdoStatement->errorInfo();
                    throw new \PDOException($pdoErrorInfo[2], $pdoErrorInfo[1]);
                } else
                    return $this->pdoStatement->rowCount();
            } catch (\PDOException $e) {
                $this->util = new TDatabaseUtil;
                if (!$this->util->TratarErro($e, $obj, $comando))
                    throw new \Exception('Ocorreu um erro durante a execu��o do ORM verifique se as configura��es das classes utilizadas est�o corretas.');
            }
        } while (!$bSQLExecuted);
    }

    public function Selecionar($comando, $obj = null, $pagina = 1, $quantidade = null) {

        $pagina--;
        
        if (!empty($quantidade))
            $comando.= " LIMIT $pagina ,$quantidade ";

        $this->ExecutarComando($comando, $obj);

        $objs = array();

        if (is_null($obj)) {

            while ($objFetched = $this->pdoStatement->fetchObject())
                array_push($objs, $objFetched);

            return $objs;
        } else {

            $class = get_class($obj);

            while ($objFetched = $this->pdoStatement->fetchObject()) {

                $objClass = new $class;

                $objClass->CarregarObjeto($objFetched);

                array_push($objs, clone($objClass));
            }

            return $objs;
        }
    }

    public function FecharConexao() {
        return true;
    }

    public function getUltimoId() {
        return $this->conexao->lastInsertId();
    }

}

?>