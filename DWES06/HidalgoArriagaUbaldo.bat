@echo off
setlocal EnableDelayedExpansion 

REM Cambia el nombre de este archivo .BAT y todos los archivos de autoevaluacion, etc. para que tengan tu nombre específico

REM Importante: El ZIP de entrega de tu tarea debe contener el fichero .BAT en la raíz y una carpeta con tu nombre que contenga todos los ficheros fuente y los ficheros de auto-evaluación

REM Cambia solo la siguiente línea para adaptarlo a tu nombre:

set nombreAlumno=HidalgoArriagaUbaldo




REM El resto del script no tienes que cambiarlo.

set num=6

set tarea=DWES0%num%
set nombreTarea=%nombreAlumno%_%tarea%_Tarea_E1
set nombreArchivo=%nombreAlumno%_%tarea%_Tarea
set autoevalucacion=%nombreAlumno%_%tarea%_Auto-evaluacion



Xcopy "%nombreTarea%" "C:\xampp\htdocs\dwes\tarea%num%\%nombreAlumno%" /I /E 




code.exe C:\xampp\htdocs\dwes\tarea%num%\%nombreAlumno%

start http://localhost/dwes/tarea%num%/%nombreAlumno%/index.php

start C:\xampp\htdocs\dwes\tarea%num%\%nombreAlumno%\%nombreArchivo%.pdf



exit
