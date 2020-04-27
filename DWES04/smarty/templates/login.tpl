<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/custom.css">
    </head>
    <body> 
        <h2>Pantalla de Inicio</h2>
               {if isset($tiempo)}
                    <div>{$tiempo}</div>
                {/if}
                 {if isset($msg)}
                    <div>{$msg}</div>
                {/if}
        <form action="index.php" method="post">
            <div class="container">

                <label for="loginUser"><b>Usuario</b></label>
                <input type="text" placeholder="Introduzca usuario" name="loginUser" required>

                <label for="password"><b>Contraseña</b></label>
                <input type="password" placeholder="Introduzca Contraseña" name="password" required>
                    
                <button name="access" type="submit">Acceder como Usuario</button>
            </div>
        </form>
        {if isset($movs)}
            <div>{$movs}</div>
        {/if}
        <form action="index.php" method="post">            
            <div class="container">
                <p>¿Desea reiniciar tablas de la base de datos?</p>                 
                <button name="reset" type="submit">Reiniciar</button>
            </div>
        </form>
        {include file="foot.tpl"}
