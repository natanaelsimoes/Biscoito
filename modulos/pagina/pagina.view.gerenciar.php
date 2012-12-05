<?php

use Biscoito\Modulos\Administrador\TAdministradorControl;

TAdministradorControl::CabecalhoModulo('Páginas', 'administrador');
?>

<header class="row-fluid page-header">
  <div class="span6"><h2>Lista de Páginas</h2></div>
  <div class="span6 align-right">
    <button type="button" onclick="_Biscoito.IrPara('administrador/pagina/adicionar')" class="btn btn-primary">
      <i class="icon-plus"></i>
      Adicionar Página
    </button>
  </div>
</header>

<div class="row-fluid">

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Nome</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($paginas)) :
        foreach ($paginas as $pagina): ?>
          <tr>
            <td><?php echo $pagina->getNome(); ?></td>
            <td class="align-right">
              <button class="btn" onclick="_Biscoito.IrPara('administrador/pagina/editar/<?php echo $pagina->getId() ?>')"><span class="icon icon-pencil"></span> Editar</button>
            </td>
          </tr>
          <?php
        endforeach;
      else :
        ?>
        <tr>
          <td>Não há páginas cadastradas.</td>
          <td></td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <div class="clear"></div>

</div>