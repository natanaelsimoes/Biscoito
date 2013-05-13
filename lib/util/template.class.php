<?php
namespace Biscoito\Lib\Util;

// <editor-fold defaultstate="collapsed" desc="class Tag">
/**
 * 
 */
class TTag {

    /**
     * Nome da tag
     * 
     * @var string
     */
    private $name;

    /**
     * Array de atributos da tag
     * 
     * @var mixed
     */
    private $attributes;

    /**
     * Conteudo presente dentro desta tag. Podem ser outras tags e/ou texto
     * 
     * @var string|mixed
     */
    public $html;

    /**
     * Instancia uma tag
     * 
     * @param string $name Nome da tag
     * @param string $id Id da tag
     */
    function __construct($name, $id = null) {
        $this->name = $name;
        $this->attributes['id'] = $id;
        $this->html = '';
    }

    /**
     * Atribui valor a um atributo da tag
     * 
     * @param string $key Nome do atributo
     * @param string $value Valor do atributo
     */
    function setAttr($key, $value) {
        $this->attributes[$key] = $value;
    }

    /**
     * Adiciona tags ou textos na tag.<br />
     * Se houver mais que uma tag ou texto para inserir coloque-os seguidamente 
     * no mesmo comando separando por virgula
     * 
     * @param Tag|string $tag Um objeto Tag ou texto
     * @param Tag $_ (opcional)
     */
    function append($tag, $_ = null) {

        $params = func_get_args();

        foreach ($params as $tag)
            if (gettype($tag) == "object") {
                if ($tag->getAttr('id') != '')
                    $this->html[$tag->getAttr('id')] = $tag;
                else
                    $this->html[] = $tag;
            }
            else
                $this->html[] = $tag;
    }

    /**
     * Retorno o valor de um atributo da tag
     * @param string $key Nome do atributo
     * @return string Valor do atributo
     */
    function getAttr($key) {
        return $this->attributes[$key];
    }

    /**
     * Realiza um loop na tag que recursivamente monta o HTML da tag
     * e seus filhos.<br />
     * Esse codigo e utilizado pela classe Page para imprimir <head> e <body>.
     * 
     * @param Tag|string $tag Objeto Tag
     * @return string O HTML montado
     */
    static function __render($tag) {

        $content = '';

        if (is_object($tag)) {
            if (gettype($tag->html) == "array") {
                foreach ($tag->html as $new_tag)
                    $content.= Tag::__render($new_tag);

                return Tag::__getHTML($tag, $content);
            } else if (gettype($tag) == "object")
                return Tag::__getHTML($tag, $tag->html);
        }
        else
            return $tag;
    }

    /**
     * Imprime o HTML de uma tag
     * 
     * @param Tag $tag Objeto Tag
     * @param string $content Conteudo da tag
     * @return string O HTML montado
     */
    private static function __getHTML($tag, $content) {

        $html = '';

        $html.= "<$tag->name";

        if (!empty($tag->attributes))
            foreach ($tag->attributes as $key => $value)
                if (!empty($value))
                    $html.= " $key=\"$value\"";

        switch (strtolower($tag->name)) {
            case 'input':
            case 'meta':
            case 'hr':
            case 'br':
            case 'img':
                $html.= ' />';
                break;
            default:
                $html.= ">" . $content . "</$tag->name>";
                break;
        }

        return $html;
    }

}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="class Page">
class Page {

    /**
     * Doctype indica o tipo de documento e versao do HTML
     *  
     * @var string
     */
    private $doctype;

    /**
     * Tag que representa <body> no HTML
     * 
     * @var Tag 
     */
    private $body;

    /**
     * Tag que representa <head> no HTML 
     * @var Tag
     */
    private $head;

    /**
     * Referência as tags de referência de $body
     * $page->html['nome'] representa a uma tag de id 'nome' presente no primeiro nivel de <body>
     * 
     * @var mixed
     */
    public $html;

    /**
     * Instancia nova pagina<br />
     * Por padrao o tipo de documento e XHTML 1.0 Transitional e o charset UTF-8<br />
     * Estao disponiveis as seguintes contantes para doctype: <br /><br />
     * <ul>
     * <li><b>HTML401F</b>: HTML 4.01 Frameset</li>
     * <li><b>HTML401S</b>: HTML 4.01 Strict</li>
     * <li><b>XHTML10F</b>: XHTML 1.0 Frameset</li>
     * <li><b>XHTML10S</b>: XHTML 1.0 Strict</li>
     * <li><b>XHTML10T</b>: XHTML 1.0 Transitional</li>
     * <li><b>XHTML11</b>: XHTML 1.1</li>
     * </ul>
     * 
     * @param string $pageTitle Titulo da pagina
     * @param string $doctype Tipo de documento (Utilize as constantes)
     * @param string $charset Codificacao da pagina
     */
    function __construct($pageTitle = 'Document Untitled', $doctype = XHTML10T, $charset = 'UTF-8') {

        switch ($doctype) {
            case HTML401S:
            case HTML401F:
            case XHTML10F:
            case XHTML10S:
            case XHTML10T:
            case XHTML11:
                $this->doctype = $doctype;
                break;
            default: throwError(ERR0001);
                exit;
        }

        $this->head = new Tag('head');

        $title = new Tag('title');

        $title->append($pageTitle);

        $metaContent = new Tag('meta', 'lang');

        $metaContent->setAttr('http-equiv', 'Content-Type');

        $metaContent->setAttr('content', "text/html; charset=$charset");

        $this->head->append($metaContent);

        $this->head->append($title);

        $this->body = new Tag('body');

        $this->html = $this->body->html;
    }

    /**
     * Adiciona uma tag link ao <head>
     * 
     * @param string $href Referencia do arquivo
     * @param string $rel O conteudo com o qual o arquivo esta relacionado (Padrao = stylesheet)
     * @param string $type Tipo de arquivo (Padrao = text/css)
     * @param string $media Em qual midia sera utilizado o arquvio (Padrao = screen)
     */
    function addLink($href, $rel = 'stylesheet', $type = 'text/css', $media = 'screen') {
        $link = new Tag('link', true);
        $link->setAttr('href', $href);
        $link->setAttr('rel', $rel);
        $link->setAttr('type', $type);
        $link->setAttr('media', $media);
        $this->head->append($link);
    }

    /**
     * Adiciona uma tag script ao <head>
     * 
     * @param string $src Caminho do arquivo de script
     * @param type $content Conteudo a ser colocado dentro da tag
     * @param type $type Tipo de script (Padrao = text/javascript)
     */
    function addScript($src, $content = '', $type = 'text/javascript') {
        $script = new Tag('script');
        $script->setAttr('src', $src);
        $script->setAttr('type', $type);
        $script->append($content);
        $this->head->append($script);
    }

    /**
     * Adiciona uma tag style ao <head>
     * 
     * @param string $content Conteudo a ser colocado dentro da tag
     * @param string $type Tipo de arquivo de estilo (Padrao = text/css)
     */
    function addStyle($content, $type = 'text/css') {
        $style = new Tag('style');
        $style->setAttr('type', $type);
        $style->append($content);
        $this->head->append($style);
    }

    /**
     * Adiciona tags ou conteudo direto no <body>
     * 
     * @param Tag|string $tag Tag ou string para ser incluida
     */
    function append($tag) {
        $this->body->append($tag);
        $this->html = $this->body->html;
    }

    /**
     * Ultimo metodo a ser executado, realiza a impressao de todo o HTML.
     */
    function render() {
        echo $this->doctype;
        echo '<html>';
        echo Tag::__render($this->head);
        echo Tag::__render($this->body);
        echo '</html>';
    }

}

// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="util FastTag">
/**
 * Funcao para montagem rapida de tags com menor complexidade
 * 
 * @param Tag $tag Objeto de Tag
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function __fastTag($tag, $params = null) {
    if (gettype($params) == "string")
        $tag->append($params);
    else {
        $tag->setAttr('id', $params[0]);
        $tag->setAttr('class', $params[1]);
        for ($i = 2, $max = count($params); $i < $max; $i++)
            $tag->append($params[$i]);
    }
    return $tag;
}

function button($id, $class, $type, $value) {
    $button = new Tag('button');
    $button->setAttr('id', $id);
    $button->setAttr('class', $class);
    $button->setAttr('type', $type);
    $button->append($value);
    return $button;
}

function label($id, $class, $for, $_ = null) {
    $label = new Tag('label');
    $label->setAttr('id', $id);
    $label->setAttr('class', $class);
    $label->setAttr('for', $for);

    $allPar = func_get_args();
    for ($i = 3, $maxArg = func_num_args(); $i < $maxArg; $i++)
        $label->append($allPar[$i]);

    return $label;
}

function p($id, $class, $_ = null) {
    $p = __fastTag(new Tag('p'), func_get_args());
    return $p;
}

function form($id, $method, $action, $_ = null) {
    $allPar = func_get_args();
    $params[] = $id;
    $params[] = ''; #class
    for ($i = 3, $maxArg = func_num_args(); $i < $maxArg; $i++)
        $params[] = $allPar[$i];
    $form = __fastTag(new Tag('form'), $params);
    $form->setAttr('method', $method);
    $form->setAttr('action', $action);
    return $form;
}

function table($id, $class, $_ = null) {
    $table = __fastTag(new Tag('table'), func_get_args());
    return $table;
}
function thead($id, $class, $_ = null) {
    $thead = __fastTag(new Tag('thead'), func_get_args());
    return $thead;
}
function tr($id, $class, $_ = null) {
    $tr = __fastTag(new Tag('tr'), func_get_args());
    return $tr;
}
function td($id, $class, $_ = null) {
    $td = __fastTag(new Tag('td'), func_get_args());
    return $td;
}
function th($id, $class, $_ = null) {
    $th = __fastTag(new Tag('th'), func_get_args());
    return $th;
}
function tbody($id, $class, $_ = null) {
    $tbody = __fastTag(new Tag('tbody'), func_get_args());
    return $tbody;
}

function input($id, $class, $type, $name, $value) {
    $input = __fastTag(new Tag('input'), array($id, $class));
    $input->setAttr('type', $type);
    $input->setAttr('name', $name);
    $input->setAttr('value', $value);
    return $input;
}

function select($id, $class, $_ = null) {
    $select = __fastTag(new Tag('select'), func_get_args());
    return $select;
}

function textarea($id, $class, $_ = null) {
    $textarea = __fastTag(new Tag('textarea'), func_get_args());
    return $textarea;
}

function option($class, $value, $selected, $_ = null) {
    $option = __fastTag(new Tag('option'), $id, $class, $_);
    $option->setAttr('selected', $selected);
    return $option;
}

function br($class = null) {
    $br = new Tag('br');
    $br->setAttr('class', $class);
    return $br;
}

/**
 * Link
 * 
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $href O caminho para redirecionamento
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function a($content, $href, $id = null, $class = null) {
    $a = __fastTag(new Tag('a'), $content, $id, $class);
    $a->setAttr('href', $href);
    return $a;
}

/**
 * Texto negrito
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @return Tag A tag montada
 */
function b($content) {
    $b = new Tag('b');
    $b->append($content);
    return $b;
}

/**
 * Div
 * 
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function div($id = null, $class = null, $_ = null) {
    return __fastTag(new Tag('div'), func_get_args());
}

/**
 * Titulo H1
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h1($id = null, $class = null, $_ = null) {
    return __fastTag(new Tag('h1'), func_get_args());
}

/**
 * Titulo H2
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h2($content, $id = null, $class = null) {
    return __fastTag(new Tag('h2'), $content, $id, $class);
}

/**
 * Titulo H3
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h3($content, $id = null, $class = null) {
    return __fastTag(new Tag('h3'), $content, $id, $class);
}

/**
 * Titulo H4
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h4($content, $id = null, $class = null) {
    return __fastTag(new Tag('h4'), $content, $id, $class);
}

/**
 * Titulo H5
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h5($content, $id = null, $class = null) {
    return __fastTag(new Tag('h5'), $content, $id, $class);
}

/**
 * Titulo H6
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function h6($content, $id = null, $class = null) {
    return __fastTag(new Tag('h6'), $content, $id, $class);
}

/**
 * Imagem
 * 
 * @param string $src Caminho para a imagem
 * @param string $alt Texto alternativo para a imagem
 * @param string|integer $width Largura da imagem
 * @param string|integer $height Altura da imagem
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function img($src, $alt, $width = null, $height = null, $id = null, $class = null) {
    $img = __fastTag(new Tag('img'), $content, $id, $class);
    $img->setAttr('src', $src);
    $img->setAttr('alt', $alt);
    $img->setAttr('width', $width);
    $img->setAttr('height', $height);
    return $img;
}

function li($id = null, $class = null, $_ = null) {
    return __fastTag(new Tag('li'), func_get_args());
}

/**
 * Span
 * 
 * @param Tag|string $content Conteudo da tag que pode ser outro objeto de tag ou texto 
 * @param string $id Id da tag
 * @param string $class Classe da tag
 * @return Tag A tag montada
 */
function span($id = null, $class = null, $_ = null) {
    return __fastTag(new Tag('span'), func_get_args());
}

function ul($id = null, $class = null, $_ = null) {
    return __fastTag(new Tag('ul'), func_get_args());
}

// </editor-fold>
?>
