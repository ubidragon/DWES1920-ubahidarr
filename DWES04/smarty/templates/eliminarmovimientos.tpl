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
<h2>Eliminar Movimientos</h2>
        {if  isset($msg)}
            <div class='navbarOk'><p>{$msg}</p></div>
        {/if}
<form action="eliminarmovimientos.php" method="post">
<table>
        {if isset($movimientos)}
            <thead>
                <tr><th></th>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            {foreach $movimientos as $mov}
                <tr>
                  <td>
                      <input type="checkbox" name="codigoMov[]" value="{$mov->getCodigoMov()}"/>
                  </td>
                  <td>
                      {$mov->getFecha()}
                  </td>
                  <td>
                      {$mov->getConcepto()}
                  </td>
                  <td>
                      {$mov->getCantidad()}
                  </td>
                </tr>
            {/foreach}
        </tbody>            
        {else}
            <tr>    <th>No hay movimientos que mostrar</th>
            </tr>
        {/if}
</table
  <div class="container">        
    <button type="submit" name="eliminar">Eliminar movimientos</button>
  </div>
</form>
{include file="foot.tpl"}