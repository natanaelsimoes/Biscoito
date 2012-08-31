<?php

namespace Biscoito\Plugins\CKEditor;

require_once('../../cms/lib/database/objeto.class.php');
require_once ('../../modulos/galeria/foto.class.php');

use Biscoito\Modulos\Galeria\TFoto;

$xmlBiscoitoConfig = simplexml_load_file('../../config.xml');
$site = strval($xmlBiscoitoConfig->site);
$foto = new TFoto();
$foto->Carregar(imagecreatefromjpeg($_FILES['upload']['tmp_name']));
$foto->Upload('../../modulos/galeria/fotos');
$caminho = explode('/', $foto->getCaminho());
echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $_REQUEST['CKEditorFuncNum'] . ', "' . $site . 'modulos/galeria/fotos/' . end($caminho) . '");</script>';
?>
