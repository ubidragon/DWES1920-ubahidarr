<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-25 21:09:15
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/banca.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea48adbc02b41_32331467',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c38119d5d766d4797e799116eacbd2aecb0cd89d' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/banca.tpl',
      1 => 1587841628,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:foot.tpl' => 1,
  ),
),false)) {
function content_5ea48adbc02b41_32331467 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<h2>Pantalla de Inicio</h2>

<form>
<input type="hidden" name="loginUser" value="<?php echo '<?php ';?>
echo reloadUser(); <?php echo '?>';?>
">
  <div class="container">
    <button type="submit" formaction="ultimosMovs.php" formmethod="post">Ultimos Movimientos</button>    
    <button type="submit" formaction="ingreso.php" formmethod="post">Ingreso</button>     
    <button type="submit" formaction="gastos.php" formmethod="post">Gasto</button>
    <button type="submit" formaction="eliminarMov.php" formmethod="post">Eliminar movimiento</button>
    <button type="submit" formaction="index.php">Salir</button>
  </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:foot.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
