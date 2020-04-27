{include file="header.tpl"}
<table>
    <tbody>
        <tr>
            <td><i>Usuario: {$nombre}</i></td>
            <td><i>Inicio de sesión: {$fechaSesion}</i></td>
            <td><i>Total de ingresos: {$ingresos}</i></td>
            <td><i>Total de gastos: {$gastos}</i></td>
            <td>{$presupuesto}</td>
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
{include file="foot.tpl"}