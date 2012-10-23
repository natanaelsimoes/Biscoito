<?php

namespace Biscoito\Lib\Util\HTML;

class TTag {

  /**
   * Nome da tag     
   * @var string
   */
  private $Nome;

  /**
   * Array de atributos da tag
   * @var mixed
   */
  private $Atributos;

  /**
   * Conteudo presente dentro desta tag. Podem ser outras tags e/ou texto     
   * @var string|mixed
   */
  protected $HTML;

  /**
   * Instancia uma tag
   * @param string $nome Nome da tag     
   */
  public function __construct($nome) {
    $this->Atributos = array();
    $this->HTML = '';
    $this->Nome = $nome;
  }

  /**
   * Atribui valor a um atributo da tag   
   * @param string $atributo Nome do atributo
   * @param string $valor Valor do atributo
   */
  public function setAtributo($atributo, $valor) {
    $this->Atributos[$atributo] = $valor;
  }

  public function setNome($value) {
    $this->Nome = $value;
  }

  /**
   * Adiciona tags ou textos na tag.<br />
   * Se houver mais que uma tag ou texto para inserir coloque-os seguidamente 
   * no mesmo comando separando por virgula
   * 
   * @param Tag|string $tag Um objeto Tag ou texto
   * @param Tag $_ (opcional)
   */
  public function Anexar($tag, $_ = null) {
    $params = func_get_args();
    foreach ($params as $tag) :
      if (gettype($tag) == "object") :
        if ($tag->getAtributo('id') != '') :
          $this->HTML[$tag->getAtributo('id')] = $tag;
        else :
          $this->HTML[] = $tag;
        endif;
      else :
        $this->HTML[] = $tag;
      endif;
    endforeach;
  }

  /**
   * Retorno o valor de um atributo da tag
   * @param string $atributo Nome do atributo
   * @return string Valor do atributo
   */
  public function getAtributo($atributo) {
    return $this->Atributos[$atributo];
  }

  /**
   * Realiza um loop na tag que recursivamente monta o HTML da tag
   * e seus filhos.<br />
   * Esse codigo e utilizado pela classe Page para imprimir <head> e <body>.
   * 
   * @param Tag|string $tag Objeto Tag
   * @return string O HTML montado
   */
  function Renderizar($tag = null) {
    $return = (is_null($tag));
    $tag = (!is_null($tag)) ? $tag : $this;
    $content = '';
    if (is_object($tag)) {
      if (gettype($tag->HTML) == "array") {
        foreach ($tag->HTML as $new_tag)
          $content.= $tag->Renderizar($new_tag);
        if (!$return)
          return $tag->__getHTML($tag, $content);
        else
          echo $tag->__getHTML($tag, $content);
      } else if (gettype($tag) == "object")
        return $tag->__getHTML($tag, $tag->HTML);
    }
    else
      return $tag;
  }

  /* static function Renderizar($tag = null) {   

    $content = '';

    if (is_object($tag)) {
    if (gettype($tag->HTML) == "array") {
    foreach ($tag->HTML as $new_tag)
    $content.= TTag::Renderizar($new_tag);

    return TTag::__getHTML($tag, $content);
    } else if (gettype($tag) == "object")
    return TTag::__getHTML($tag, $tag->HTML);
    }
    else
    return $tag;
    } */

  /**
   * Imprime o HTML de uma tag
   * 
   * @param Tag $tag Objeto Tag
   * @param string $conteudo Conteudo da tag
   * @return string O HTML montado
   */
  private static function __getHTML($tag, $conteudo) {

    $html = '';

    $html.= "<$tag->Nome";

    if (!empty($tag->Atributos))
      foreach ($tag->Atributos as $key => $value)
        if (!empty($value))
          $html.= " $key=\"$value\"";

    switch (strtolower($tag->Nome)) {
      case 'input':
      case 'meta':
      case 'hr':
      case 'br':
      case 'img':
        $html.= ' />';
        break;
      default:
        $html.= ">" . $conteudo . "</$tag->Nome>";
        break;
    }

    return $html;
  }

}

?>
