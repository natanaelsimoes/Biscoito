<?php
namespace Biscoito\Modulos\Administrador\Breadcrumbs;

class TBreadcrumb {
    
    private $classe;
    
    private $nome;
    
    private $url;
    
    public function getClasse() { return $this->classe; }
    
    public function getNome() { return $this->nome; }
    
    public function getURL() { return $this->url; }
    
    public function setClasse($value) { $this->classe = $value; }
    
    public function setNome($value) { $this->nome = $value; }
    
    public function setURL($value) { $this->url = $value; }
    
}
?>
