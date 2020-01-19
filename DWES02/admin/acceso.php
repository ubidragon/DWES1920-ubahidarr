<?php
require_once("../includes/header.inc.php");
checkAdmin();
?>
<link rel="stylesheet" href="../css/custom.css">
<h2>Pantalla de Inicio</h2>

<form action="acceso.php" method="get">
  <div class="container">
    <label for="admin"><b>Usuario Administrador</b></label>
    <input type="text" placeholder="Introduzca usuario de administracion" name="admin" required>
    <label for="adminPassword"><b>Contraseña de administrador</b></label>
    <input type="password" placeholder="Introduzca Contraseña" name="adminPassword" required>
        
    <button type="submit">Acceder como Administrador</button>
  </div>
</form>
<form>
  <div class="container">        
    <button type="submit" formaction="<?php echo $uri; ?>">Acceder como Usuario</button>
  </div>
</form>
<?php
require_once '../includes/pie.php';
?>