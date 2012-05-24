<?php

namespace Biscoito\Modulos\Usuario;

use Biscoito\Lib\Database\TObjeto;

define('USUARIO_TIPO_COMUM', 0);
define('USUARIO_TIPO_ADMINISTRADOR', 1);

class TUsuario extends TObjeto {

    private $nome;
    private $usuario;
    private $senha;
    private $ultimoLogin;
    
    /**
     * Tipo de Usuário: USUARIO_TIPO_COMUM ou USUARIO_TIPO_ADMINISTRADOR
     * @var integer
     */
    private $tipo;

    public function getNome() {
        return $this->nome;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getUltimoLogin() {
        return $this->ultimoLogin;
    }
    
    /**
     * Retorna o tipo de usuário
     * @return integer 0 - Comum | 1 - Administrador
     */
    public function getTipo() {
        return $this->tipo;
    }

    public function setNome($value) {
        $this->nome = $value;
    }

    public function setUsuario($value) {
        $this->usuario = $value;
    }

    public function setUltimoLogin($value) {
        $this->ultimoLogin = $value;
    }
    
    /**
     * Atribui um tipo ao usuário
     * @param integer $value USUARIO_TIPO_COMUM ou USUARIO_TIPO_ADMINISTRADOR
     */
    public function setTipo($value) {
        $this->tipo = $value;
    }

}

?>