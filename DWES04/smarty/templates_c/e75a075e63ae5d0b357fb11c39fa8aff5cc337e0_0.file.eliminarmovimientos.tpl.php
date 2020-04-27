<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 15:06:28
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/eliminarmovimientos.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea587542cc375_43884217',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e75a075e63ae5d0b357fb11c39fa8aff5cc337e0' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/eliminarmovimientos.tpl',
      1 => 1587906383,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea587542cc375_43884217 (Smarty_Internal_Template $_smarty_tpl) {
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
<h2>Eliminar Movimientos</h2>
        <?php if (isset($_smarty_tpl->tpl_vars['msg']->value)) {?>
            <div class='navbarOk'><p><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</p></div>
        <?php }?>
<form action="eliminarmovimientos.php" method="post">
<table>
        <?php if (isset($_smarty_tpl->tpl_vars['movimientos']->value)) {?>
            <thead>
                <tr><th></th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['movimientos']->value, 'mov');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mov']->value) {
?>
                <tr>
                  <td>
                      <input type="checkbox" name="codigoMov[]" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value->getCodigoMov();?>
"/>
                  </td>
                  <td>
                      <?php echo $_smarty_tpl->tpl_vars['mov']->value->getFecha();?>

                  </td>
                  <td>
                      <?php echo $_smarty_tpl->tpl_vars['mov']->value->getConcepto();?>

                  </td>
                  <td>
                      <?php echo $_smarty_tpl->tpl_vars['mov']->value->getCantidad();?>

                  </td>
                </tr>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>            
        <?php } else { ?>
            <tr>    <th>No hay movimientos que mostrar</th>
            </tr>
        <?php }?>
</table
  <div class="container">        
    <button type="submit" name="eliminar">Eliminar movimientos</button>
  </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
