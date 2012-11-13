<?php

namespace Biscoito\Lib;

class TBiscoitoConfig {

  private static $instance;
  public $site;
  public $index;
  public $database;

  public function __construct() {
    $this->index = new TBiscoitoConfigIndex();
    $this->database = new TBiscoitoConfigDatabase();
    $xmlBiscoitoConfig = simplexml_load_file('config.xml');
    $this->site = strval($xmlBiscoitoConfig->site);
    $this->index->acao = strval($xmlBiscoitoConfig->index->acao);
    $this->index->controle = strval($xmlBiscoitoConfig->index->controle);
    $this->index->modulo = strval($xmlBiscoitoConfig->index->modulo);
    $this->database->base = strval($xmlBiscoitoConfig->database->base);
    $this->database->driver = strval($xmlBiscoitoConfig->database->driver);
    $this->database->senha = strval($xmlBiscoitoConfig->database->senha);
    $this->database->servidor = strval($xmlBiscoitoConfig->database->servidor);
    $this->database->usuario = strval($xmlBiscoitoConfig->database->usuario);
  }

  public static function singleton() {
    if (!isset(self::$instance)) {
      $c = __CLASS__;
      self::$instance = new $c;
    }
    return self::$instance;
  }

}

class TBiscoitoConfigDatabase {

  public $driver;
  public $servidor;
  public $usuario;
  public $senha;
  public $base;

}

class TBiscoitoConfigIndex {

  public $modulo;
  public $acao;
  public $controle;

}

?>