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
<h2>Ultimos Movimientos</h2>
        {if  isset($msg)}
            <div class='navbarOk'><p>{$msg}</p></div>
        {/if}	
    <table>
         {if isset($movimientos)}
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            {foreach $movimientos as $mov}
                <tr><td>
                        {$mov->getFecha()}
                    </td><td>
                        {$mov->getConcepto()}
                    </td><td>
                        {$mov->getCantidad()}
                    </td>
                </tr>
            {/foreach}
        </tbody>            
        {else}
            <tr>    <th>No hay movimientos que mostrar</th>
            </tr>
        {/if}

{include file="foot.tpl"}