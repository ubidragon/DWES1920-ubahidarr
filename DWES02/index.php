<?php
require_once("./includes/header.inc.php");
?>
<h2>Pantalla de Inicio</h2>

<form action="/action_page.php" method="post">
  <div class="container">
    <label for="uname"><b>Usuario</b></label>
    <input type="text" placeholder="Introduzca usuario" name="username" required>

    <label for="psw"><b>Contraseña</b></label>
    <input type="password" placeholder="Introduzca Contraseña" name="password" required>
        
    <button type="submit">Acceder como Usuario</button>
  </div>
</form>
<form action="/action_page.php" method="post">
  <div class="container">        
    <button type="submit">Acceder como Administrador</button>
  </div>
</form>

<?php
require_once './includes/pie.php';
?>