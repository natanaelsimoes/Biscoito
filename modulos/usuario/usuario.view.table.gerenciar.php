<?php

use Biscoito\Modulos\Usuario;
?>

<table class="table table-striped">           
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nome de Usu�rio</th>
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
                    <td><button class="btn pull-right">Editar</button></td>
                </tr>
                <?php
            endforeach;
        else :
            ?>
            <tr>
                <td>N�o h� usu�rios deste tipo.</td>
                <td></td>
            </tr>
        <?php endif; ?>

    </tbody>

</table>