<?php
global $_UsuarioLogado;
?>
<table class="table table-striped">
  <thead>
    <tr>      
      <th>Nome</th>
      <th>Nome de Usuário</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($usuarios)) :
      foreach ($usuarios as $usuario):
        ?>
        <tr>          
          <td>
            <?php echo sprintf('%s %s', $usuario->getNome(), $usuario->getSobrenome()); ?> 
            <?php if (!$usuario->getStatus()) : ?><span class="text-error"><?php echo sprintf('(%s)', $usuario->getStatusStr()); ?></span><?php endif; ?>
          </td>
          <td><?php echo $usuario->getUsuario(); ?></td>
          <td><button class="btn pull-right" onclick="_Biscoito.IrPara('administrador/usuario/editar/<?php echo $usuario->getId() ?>')"><span class="icon icon-pencil"></span> Editar</button></td>
        </tr>
        <?php
      endforeach;
    else :
      ?>
      <tr>
        <td>Não há usuários deste tipo.</td>
        <td></td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>