<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 20:13:44
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/conta.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea5cf58175783_34688907',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '01a03013f63f0c2c289348616a9e5985b1701390' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/conta.tpl',
      1 => 1587924811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea5cf58175783_34688907 (Smarty_Internal_Template $_smarty_tpl) {
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
<h2>Pantalla de Inicio</h2>
<form>
  <div class="container">
    <button type="submit" formaction="ultimosmovimientos.php" formmethod="post">Ultimos Movimientos</button>    
    <button type="submit" formaction="ingresos.php" formmethod="post">Ingreso</button>     
    <button type="submit" formaction="gastos.php" formmethod="post">Gasto</button>
    <button type="submit" formaction="eliminarmovimientos.php" formmethod="post">Eliminar movimiento</button>
    <button type="submit" formaction="preferencias.php" formmethod="post">Preferencias</button>
    <button name="exit" type="submit" formmethod="post" formaction="index.php">Cerrar Sesión</button>
  </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
