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
<div  id="contenido">
    <form action='preferencias.php' method='post'>
                <select name="color" required>
                    <option value="" >Elige color de fondo</option>
                    <option value="red" > red</option>
                    <option value="blue"> blue</option>
                    <option value="green" > green</option>
                    <option value="purple"> purple</option>
                    <option value="palegreen" > palegreen</option>                                        
                </select> 

                <input type="submit" value="Seleccionar" name="seleccionar" />
    </form>
    <form>  
    <input type="submit" value="Borrar Preferencias" name="borrar" formmethod="post" formaction="preferencias.php"/>
    </form>       
</div>
{include file="foot.tpl"}