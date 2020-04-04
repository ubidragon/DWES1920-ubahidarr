<?php
require_once("./includes/header.inc.php");
?>
<h2>Okupa2</h2>
<h4>Pantalla de Inicio</h4>
<form>
  <div class="container">
    <button type="submit" formaction="usuario.php">Acceder como Usuario</button>
    <button type="submit" formaction="invitado.php">Acceder como Invitado</button>     
    <button type="submit" formaction="registro.php">Registrarse</button>
  </div>
</form>
<?php
require_once './includes/pie.php';
?>