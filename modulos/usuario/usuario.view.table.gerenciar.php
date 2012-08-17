<?php

use Biscoito\Modulos\Usuario;
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
                    <td><?php echo sprintf('%s %s', $usuario->getNome(), $usuario->getSobrenome()); ?> <?php if (!$usuario->getStatus()) echo sprintf('(%s)',$usuario->getStatusStr()); ?></td>
                    <td><?php echo $usuario->getUsuario(); ?></td>
                    <td><button class="btn pull-right"><span class="icon icon-pencil"></span> Editar</button></td>
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