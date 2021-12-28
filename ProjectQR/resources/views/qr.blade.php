<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        
        
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            
            .full-height { height: 100vh; }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref { position: relative; }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content { text-align: center; }

            .title { font-size: 84px; }
            
            .m-b-md { margin-bottom: 30px; }
        </style>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    </head>
    
    <body>
        <div class="content">
            <img src="https://lh3.googleusercontent.com/proxy/OEA8dsDGU_xUAG9ZDxUH14r2kU3v4JYfTJ5cQrrqmXRCMdh9utfe1Njh35y-3vt7kRMeAvBHL9Mt5pxW4DJ_8tDMPJExWObplpQwDO9hJfq7g-jrrVg" alt="uct" width="300" height="100">
            <h1>Modulo de Trazabilidad</h1>
            <h2>Bienvenido/a </h2>   

            <div class="contenedor">
                <div class="abs-center">
                    <div class="titulo">Escanéa o ingresa el código QR a registrar</div>
                    <video width="300" height="150" id="cam" controls="controls" autoplay="autoplay"></video>
                    <canvas id="qr" width="640" height="250"></canvas>
                </div>
            </div>

            <script>
                //camara es el nombre de la función que vamos a implementar
                window.addEventListener('load',camara);
        
                function camara(){
                    //creamos la variable vídeo, la cual invoca al elemento que tenga el id="cam" dentro del documento
                    var video = document.getElementById('cam');  
                    // getUserMedia es el método que permite acceder al hardware multimedia del pc, este metodo está contenido dentro del objeto navigator
                    navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.msGetUserMedia || navigator.mozGetUserMedia);
            
                    if(navigator.getUserMedia){ 
                        //como deseamos tener activado tanto audio, video, los ponemos en true,
                        //el segundo parámetro será una función a la cual le pondremos videocam como parámetro, el cual recibe el video a visualizar
                        navigator.getUserMedia({audio:true,video:true},function(videocam){
                            // ahora pasaremos la ruta de donde se va a tomar el video, para ello necesitamos convertir dicho video a una URL que pueda ser leida por la etiqueta de video.
                            //para ello hacemos uso del método createObjectURL del objeto URL, el cual pertenece al objeto window y después le pasamos el vídeo a convertir como parámetro, en este caso videocam
                            video.src = window.URL.createObjectURL(videocam);
                            //iniciamos la webcam de nuestro pc
                            video.play();
                        },
                
                        //función que muestra por consola los errores ocurridos en caso de haberlos
                        function (e){
                            console.log(e);
                        });
                    }else{
                        alert('tu navegador no es compatible');  
                    }
                }
            </script>

            <div class="col-md-4" style="text-align: center;">
                <input class="form-control text-center" type="text" placeholder="O escriba el código QR">
            </div>

            <button type="button" class="btn btn-success">Entrada</button>
            <button type="button" class="btn btn-danger">Salida</button>
        </div>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>

    </body>
</html>