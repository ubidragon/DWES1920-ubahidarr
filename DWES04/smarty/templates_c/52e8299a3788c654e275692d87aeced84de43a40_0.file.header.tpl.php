<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-26 20:13:53
  from '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ea5cf61a83836_65721171',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '52e8299a3788c654e275692d87aeced84de43a40' => 
    array (
      0 => '/home/ubidragon/Documentos/Formacion/Junta de Andalucia -  DAW/DWES/DWES1920/DWES04/smarty/templates/header.tpl',
      1 => 1587924832,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ea5cf61a83836_65721171 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/custom.css">
</head>
<?php if (isset($_smarty_tpl->tpl_vars['fondo']->value)) {?>
<body style="background-color : <?php echo $_smarty_tpl->tpl_vars['fondo']->value;?>
"> 
<?php } else { ?>
    <body style="background-color : grey"> 
<?php }?>
<form class="formNotBorder">   
		<ul class="navbar">
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="conta.php">Menu de usuario</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="ultimosmovimientos.php">Ultimos movimientos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="ingresos.php">Ingresos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="gastos.php">Gastos</button></li>
        	<li class="navbarChild"><button type="submit" formmethod="post" formaction="eliminarmovimientos.php">Eliminar movimientos</button></li>
			<li class="navbarChild"><button type="submit" formmethod="post" formaction="preferencias.php">Preferencias</button></li>
			<li class="navbarChild"><button name="exit" type="submit" formmethod="post" formaction="index.php">Cerrar Sesión</button></li>
		</ul>		
</form>
<?php }
}
