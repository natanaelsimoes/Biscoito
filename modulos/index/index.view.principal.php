<?php

use Biscoito\Lib\Util\HTML;

$form = new HTML\TForm;

$form->AdicionarCampo(new HTML\TInput('Nome'));

$form->Renderizar();

?>