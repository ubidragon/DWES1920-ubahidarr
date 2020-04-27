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
<h2>Ingreso</h2>
        {if $error != ''}
            <div><span class='error'>{$error}</span></div>
        {/if}
<form action="ingresos.php" method="post">
    <div class="container">
        <label for="loginUser"><b>Login de usuario</b></label>
        <input type="text" name="loginUser" value="{$login}" maxlength="20" readonly disabled> 
        <label for="fechaMov"><b>Fecha del movimiento</b></label>
        <input type="date" placeholder="Fecha de nacimiento" name="fechaMov" value="{$fechaMov}" required>
    </div>
    <div class="container">
        <label for="cantidad"><b>Cantidad*</b></label>
        <input type="number" min="0" step="0.01" placeholder="Cantidad" name="cantidad" value="{$cantidad}" pattern="^[0-9]*\,[0-9][0-9]$" required> 
    </div>
    <div class="container">
        <label for="concepto"><b>Concepto</b></label><br/>
        <textarea type="textarea" name="concepto" placeholder="Concepto" cols="25" rows="1" maxlength="20" value="{$concepto}" required></textarea>
    </div>
    <div class="container">
        <button type="submit" name="ingreso">Ingresar dinero</button>
    </div>
</form>
{include file="foot.tpl"}