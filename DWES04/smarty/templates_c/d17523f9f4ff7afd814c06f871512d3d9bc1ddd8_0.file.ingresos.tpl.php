<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 12:28:26
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/ingresos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea5624a98ece6_38403717',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd17523f9f4ff7afd814c06f871512d3d9bc1ddd8' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/ingresos.tpl',
      1 => 1587896901,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea5624a98ece6_38403717 (Smarty_Internal_Template $_smarty_tpl) {
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
<h2>Ingreso</h2>
        <?php if ($_smarty_tpl->tpl_vars['error']->value != '') {?>
            <div><span class='error'><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</span></div>
        <?php }?>
<form action="ingresos.php" method="post">
    <div class="container">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="<?php echo $_smarty_tpl->tpl_vars['login']->value;?>
" maxlength="20" readonly disabled> 
        <label for="fechaMov"><b>Fecha del movimiento</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaMov" value="<?php echo $_smarty_tpl->tpl_vars['fechaMov']->value;?>
" required>
    </div>
    <div class="container">
        <label for="cantidad"><b>Cantidad*</b></label>
        <input type="number" min="0" step="0.01" placeholder="Cantidad" name="cantidad" value="<?php echo $_smarty_tpl->tpl_vars['cantidad']->value;?>
" pattern="^[0-9]*\,[0-9][0-9]$" required> 
    </div>
    <div class="container">
        <label for="concepto"><b>Concepto</b></label><br/>
        <textarea type="textarea" name="concepto" placeholder="Concepto" cols="25" rows="1" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['concepto']->value;?>
" required></textarea>
    </div>
    <div class="container">
        <button type="submit" name="ingreso">Ingresar dinero</button>
    </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
