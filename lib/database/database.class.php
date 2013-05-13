<?php

namespace Biscoito\Lib\Database;

interface TIDatabase {

  public function AbrirConexao($servidor, $usuario, $senha, $base);

  public function ExecutarComando($comando, $obj);

  public function getUltimoId();

  public function FecharConexao();

  public function Selecionar($comando, $obj = null, $pagina = 1, $quantidade = 0);
}

class TDatabase {

  /**
   * Objeto de conexao com banco de dados
   * @var PDO
   */
  private $conexao;

  /**
   * Indica se a conexao com o banco esta aberta
   * @var bool
   */
  private $conexaoAberta;

  /**
   * Objeto com as configuracoes do banco
   * @var TBiscoitoConfigDatabase 
   */
  private $configuracoes;

  /**
   * Utilitario para tratamento de mensagens de erro e ORM 
   * @var TDatabaseUtil
   */
  private $util;

  /**
   * Objeto para funcoes PDO
   * @var \PDOStatement
   */
  private $pdoStatement;

  /**
   * Ao criar o objeto carrega as configuracoes do arquivo principal para o banco de dados
   * @global mixed $_BiscoitoConfig 
   */
  public function __construct() {
    global $_BiscoitoConfig;
    $this->configuracoes = $_BiscoitoConfig->database;
    $this->util = new TDatabaseUtil;
    $this->conexaoAberta = false;
  }

  /**
   * Abre conexao com o banco de dados   
   */
  public function AbrirConexao() {
    try {
      switch (strtoupper($this->configuracoes->driver)) {
        case 'FIREBIRD':
          $this->conexao = new PDO("firebird:dbname={$this->configuracoes->servidor}:{$this->configuracoes->base}", $this->configuracoes->usuario, $this->configuracoes->senha);
          break;
        case 'MYSQL':
          $this->conexao = new \PDO("mysql:host={$this->configuracoes->servidor}; dbname={$this->configuracoes->base}", $this->configuracoes->usuario, $this->configuracoes->senha);
          break;
        case 'ORACLE':
          $this->conexao = new PDO("oci:dbname={$this->configuracoes->base}", $this->configuracoes->usuario, $this->configuracoes->senha);
          break;
        case 'POSTGRES':
          $this->conexao = new PDO("pgsql:host={$this->configuracoes->servidor}; dbname={$this->configuracoes->base}; user={$this->configuracoes->usuario}; password={$this->configuracoes->senha}; port={$this->configuracoes->porta}");
          break;
        case 'SQLITE':
          $this->conexao = new PDO("sqlite:{$this->configuracoes->servidor}");
          break;
        case 'SQLSERVER':
          $this->conexao = new PDO("mssql:host={$this->configuracoes->servidor},{$this->configuracoes->porta}; dbname={$this->configuracoes->base}", $this->configuracoes->usuario, $this->configuracoes->senha);
          break;
      }
      $this->conexaoAberta = true;
    } catch (\PDOException $e) {
      $this->util->TratarErro($e);
      $this->conexaoAberta = false;
    }
    if (!$this->conexaoAberta)
      die('ERR-DB-GERAL#001: Falha ao abrir conexão com banco. Verifique as configurações.');
  }

  /**
   * Executa um comando no banco de dados configurado
   * @param string $comando Comando SQL
   * @return integer|bool ID (int) = Quando ocorrer um INSERT bem sucedido ou TRUE|FALSE quando for executado outro tipo de comando
   */
  public function ExecutarComando($comando, $obj) {
    if ($this->conexaoAberta) {
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
          if (!$this->util->TratarErro($e, $obj, $comando))
            throw new \Exception('Ocorreu um erro durante a execução do ORM verifique se as configurações das classes utilizadas estão corretas.');
        }
      } while (!$bSQLExecuted);
    }
    else
      die('ERR-DB-GERAL#002: Tentativa de execução de comando com conexão fechada.');
  }

  /**
   * Fecha conexao com banco de dados
   */
  public function FecharConexao() {
    $this->conexaoAberta = false;
  }

  /**
   * Retorna a ultima chave primaria utilizada
   * @return mixed
   */
  public function getUltimoId() {
    return $this->conexao->lastInsertId();
  }

  /**
   * Executa um comando de selecao no banco de dados configurado
   * @param string $comando Comando SQL
   * @param mixed $obj Objeto sendo tratado
   * @param integer $pagina Numero da pagina para casos de paginacao
   * @param integer $quantidade Quantidade de itens desejado na selecao
   * @return mixed Array com a cole��o de dados retornados 
   */
  public function Selecionar($comando, $obj = null, $pagina = 1, $quantidade = 0) {
    $pagina--;
    $inicio = $pagina*$quantidade;
    if (!empty($quantidade))
      switch (strtoupper($this->configuracoes->driver)) {
        case 'MYSQL':
          $comando.= " LIMIT $inicio ,$quantidade ";
          break;
        case 'FIREBIRD':
          $skip = $quantidade * $pagina;
          $comando = substr($comando, 0, (strpos($comando, 'SELECT') + 6)) . " FIRST $quantidade SKIP {$skip} " . substr($comando, (strpos($comando, 'SELECT') + 6));
          break;
      }
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

}

?>