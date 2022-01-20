# Guía de como usar GitLab para Felipe

Al entrar a tu cuenta gitlab tienes que entrar a la carpeta del proyecto
> Sistemas Informáticos/traza.uct.cl.

Allí copias el enlace **HTTPS** que lo obtienes del botón azul que dice **Clone** en la parte superior derecha.

Luego seleccionas una carpeta, cualquiera que quieras para guardar la carpeta que vas a clonar del git. en mi caso ocupé la de Documentos.

Luego abres una CMD para ejecutar el comando de clonación en la carpeta que elegiste. 

Dentro del CMD te diriges a la ruta de la carpeta que quieres, en mi caso como la carpeta que utilice fue la de Documentos, la abrí en la CMD utilizando el comando ```cd Documents```.

Luego para clonar la carpeta del git se usa el comando ```$ git clone https://gitlab.uct.cl/sistemasinformaticos/traza.uct.cl.git```.

**https://gitlab.uct.cl/sistemasinformaticos/traza.uct.cl.git** este enlace es el que copiaste desde HTTPS.

Una vez clonada dentro de la CMD tienes que crearte una rama propia con el nombre que tu quieras mediante el siguiente comando ```$ git checkout -b nombreTuRama```. En mi caso la rama que creé se llama franco y la creé como ```$ git checkout -b franco```.

Después de crear tu rama la tienes que validar usando el siguiente comando ```git push --set-upstream origin nombreTuRama```.

Una vez hecho esto ya puedes trabajar en el proyecto desde git usando VSCode.

## Cambios Significativos
Cuando quieras subir actualizar tu rama en el repositorio de git y que se vean tus cambios en la página de gitlab tienes que usar los siguientes comandos dentro de tu carpeta git que clonaste anteriormente usando la CMD, puedes usarla directo desde VSCode.

Los comandos son:
```console
    $ git add .
    $ git commit -m "nombreCommit"
    $ git push		
```

En el commit le colocas el nombre que quieras a la actualización que hiciste.

git push es para que se suban los cambios al repositorio.

Los cambios que hiciste se actualizarán en tu rama, entonces para subirlos a la rama de desarrollo **developer** tienes que ir a la opción **Merge requests** que está en el menú a la izquierda de tu pantalla dentro del navegador en el sitio de gitlab.

Una vez dentro tienes que apretar el botón azul en la parte superior derecha que dice **New merge request**.

En esta parte tienes 2 opciones, la de **source branch** y la de **target branch**, en la primera tu escoges la rama que quiere hacer la actualización, en este caso será la tuya que tiene los nuevos cambios.

La segunda es donde seleccionas la rama que quieres actualizar, en este caso sera la **developer**.

Una vez hecho esto das click en el botón azul **Compare branches**.

En este parte no haces ningun cambio, solo te vas hasta el final y desmarcas la casilla **delete source** para luego dar siguiente con el botón **Create a merge request**.

Por ultimo te enviará a la ultima opción que es un botón verde que dice **Merge** al cual al hacerle click cargará los cambios y actualizará la rama que elegiste.

Con esto ya puedes trabajar super bien.