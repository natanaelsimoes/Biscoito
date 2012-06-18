<?php

namespace Biscoito\Modulos\Administrador\View;

use Biscoito\Modulos\Administrador\Menu;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Biscoito - Painel Administrativo</title>
        <?php $GLOBALS['_Biscoito']->usarJQuery(); ?>
        <?php include_once('administrador.css.entrar.php'); ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#usuario').focus();
            });
        </script>
    </head>
    <body>
        <div id="corpo">
            <header>Biscoito - Painel Administrativo</header>
            <section>
                <form id="FrmLogin" method="post" action="<?php echo $GLOBALS['_Biscoito']->getSite() . 'usuario/login/'; ?>">
                    <fieldset class="glass black">
                        <p><?php echo $_SESSION['BISCOITO_SESSAO_MSG'] ?></p>
                        <p>
                            <label>Usuário:</label>
                            <input type="text" name="usuario" id="usuario" />
                        </p>
                        <p>
                            <label>Senha:</label>
                            <input type="password" name="senha" id="senha" />
                        </p>
                    </fieldset>
                    <p>
                        <button type="submit" class="glass white">Entrar</button>
                    </p>
                </form>
            </section>
        </div>
    </body>
</html>