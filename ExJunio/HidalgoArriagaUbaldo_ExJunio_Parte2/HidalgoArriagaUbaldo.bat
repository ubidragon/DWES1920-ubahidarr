@echo off
setlocal EnableDelayedExpansion 

REM Cambia el nombre de este archivo .BAT y todos los archivos de autoevaluacion, etc. para que tengan tu nombre específico

REM Importante: El ZIP de entrega de tu tarea debe contener el fichero .BAT en la raíz y una carpeta con tu nombre que contenga todos los ficheros fuente y los ficheros de auto-evaluación

REM Cambia solo la siguiente línea para adaptarlo a tu nombre:

set nombreAlumno=HidalgoArriagaUbaldo




REM El resto del script no tienes que cambiarlo.




set nombreTarea=%nombreAlumno%_ExJunio_Parte2
set nombreArchivo=%nombreAlumno%_ExJunio_Parte2
set autoevalucacion=%nombreAlumno%_ExJunio_Auto-evaluacion



Xcopy "%nombreTarea%" "C:\xampp\htdocs\dwes\ExJunio\%nombreArchivo%" /I /E 




code.exe C:\xampp\htdocs\dwes\ExJunio\%nombreArchivo%

start http://localhost/dwes/ExJunio/%nombreArchivo%/index.php

start C:\xampp\htdocs\dwes\ExJunio\%nombreAlumno%\%nombreArchivo%.pdf



exit
