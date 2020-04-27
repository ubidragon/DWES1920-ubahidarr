<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 18:40:43
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea5b98b520b88_64573416',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6ed8ada874c480e6a456bf875ded639b99ff4086' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/login.tpl',
      1 => 1587919228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea5b98b520b88_64573416 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/custom.css">
    </head>
    <body> 
        <h2>Pantalla de Inicio</h2>
               <?php if (isset($_smarty_tpl->tpl_vars['tiempo']->value)) {?>
                    <div><?php echo $_smarty_tpl->tpl_vars['tiempo']->value;?>
</div>
                <?php }?>
                 <?php if (isset($_smarty_tpl->tpl_vars['msg']->value)) {?>
                    <div><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</div>
                <?php }?>
        <form action="index.php" method="post">
            <div class="container">

                <label for="loginUser"><b>Usuario</b></label>
                <input type="text" placeholder="Introduzca usuario" name="loginUser" required>

                <label for="password"><b>Contraseña</b></label>
                <input type="password" placeholder="Introduzca Contraseña" name="password" required>
                    
                <button name="access" type="submit">Acceder como Usuario</button>
            </div>
        </form>
        <?php if (isset($_smarty_tpl->tpl_vars['movs']->value)) {?>
            <div><?php echo $_smarty_tpl->tpl_vars['movs']->value;?>
</div>
        <?php }?>
        <form action="index.php" method="post">            
            <div class="container">
                <p>¿Desea reiniciar tablas de la base de datos?</p>                 
                <button name="reset" type="submit">Reiniciar</button>
            </div>
        </form>
        <?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
