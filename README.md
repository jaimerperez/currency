# currency

## Descripcion Basica
  Aplicación que permita al usuario conocer el precio de cambio
de una divisa a otra. El usuario deberá acceder a la web y aparecerán varios elementos
de un formulario:
• Una caja para introducir la cantidad de divisa que quiere convertir.
• Un selector que permita introducir a qué divisa corresponde.
• Otro selector que permita decidir a qué divisa quieres convertirlo.
• El resultado de la operación de cambio cuando se haga la operación.
• (Opcional) Un botón para ejecutar la consulta. Es opcional porque puedes hacer que
cuando los tres valores estén definidos, la consulta sea automática.


#### Donde encontrar el resultado

En la carpeta /src encontramos 3 carpetas que use para la aplicacion. 
La carpeta Entity que uso para poder acceder a los valores del formulario. 
La carpeta Controller que contiene el controlador de la aplicacion, y la carpeta Form donde creo los formularios que vamos a usar en la aplicacion.

### Como ejecutar la aplicacion

EN local haciendo **symfony serve:start** arranca la aplicacion y nos muestra una direccion que deberia de ser localhost:8000
En esa misma ruta seremos capaces de ver la aplicacion y probarla, simplemente anadiendo el valor y los tipos de divisas que queremos probar.
