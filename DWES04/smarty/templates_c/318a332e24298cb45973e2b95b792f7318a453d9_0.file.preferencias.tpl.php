<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 21:45:13
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/preferencias.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea5e4c9a25a91_28716420',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '318a332e24298cb45973e2b95b792f7318a453d9' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/preferencias.tpl',
      1 => 1587930309,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea5e4c9a25a91_28716420 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<table>
    <tbody>
        <tr>
            <td><i>Usuario: <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</i></td>
            <td><i>Inicio de sesión: <?php echo $_smarty_tpl->tpl_vars['fechaSesion']->value;?>
</i></td>
            <td><i>Total de ingresos: <?php echo $_smarty_tpl->tpl_vars['ingresos']->value;?>
</i></td>
            <td><i>Total de gastos: <?php echo $_smarty_tpl->tpl_vars['gastos']->value;?>
</i></td>
            <td><?php echo $_smarty_tpl->tpl_vars['presupuesto']->value;?>
</td>
        </tr>
    </tbody>
</table>
<div  id="contenido">
    <form action='preferencias.php' method='post'>
                <select name="color" required>
                    <option value="" >Elige color de fondo</option>
                    <option value="red" > red</option>
                    <option value="blue"> blue</option>
                    <option value="green" > green</option>
                    <option value="purple"> purple</option>
                    <option value="palegreen" > palegreen</option>                                        
                </select> 

                <input type="submit" value="Seleccionar" name="seleccionar" />
    </form>
    <form>  
    <input type="submit" value="Borrar Preferencias" name="borrar" formmethod="post" formaction="preferencias.php"/>
    </form>       
</div>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
