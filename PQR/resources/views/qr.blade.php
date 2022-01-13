<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
        
        <style>
            html, body {
                color: #636b6f;
                font-family: 'Roboto', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0 auto;
            }

            small{
                text-align: center;
                color: #636b6f;
            }
            
            #principal{
                padding-top: 3%;
                display: block;
                text-align: center;
            }
            .separacion{
                padding: 3%;
                position: relative;
                display: block;
            }

            #previsualizacion{
                clip-path: inset(0 13% 48% 10%);
                width: 70%;
                display: absolute;
                text-align: center;
                margin-top: 0 auto;            
            }

            #video{
                width: auto;
                height: auto;
                justify-content: center;
                margin: 0 auto;
            }

            #code_ambi{
                height: 50px;
                width: 360px;
                margin: 0 auto;
                font-weight: bold;
                font-size: 18pt;
                position: absolute;
                top: 60%;
                left: 4px;
                right: 2px;
            }
            #botones{
                position: absolute;
                top: 75%;
                left: 4px;
                right: 2px;
            }

            #formulario{
                margin-bottom: 40px;
            }
        </style>

        <script>
            function isMobile(){
                return (
                    (navigator.userAgent.match(/Android/i)) ||
                    (navigator.userAgent.match(/webOS/i)) ||
                    (navigator.userAgent.match(/iPhone/i)) ||
                    (navigator.userAgent.match(/iPod/i)) ||
                    (navigator.userAgent.match(/iPad/i)) ||
                    (navigator.userAgent.match(/BlackBerry/i))
                );
            }
        </script>
    </head>
    
    <body>
        <div id="principal" class="content">
            <img src="{{ asset('UCT_logo.png') }}" alt="uct" width="150" height="50">
            <div class="separacion">
                <h2>Módulo de Trazabilidad</h2>
                <small>Bienvenido/a {{$n_com}}</small>

                <div class="titulo">Escanéa o ingresa el código QR a registrar</div><br>

                <!--Mediante la etiqueta video que esta dentro del div inciamos la llamada a la camara-->
                <div id="video">
                    <video name="previsualizacion" id="previsualizacion" autoplay></video>
                </div>

                <div>
                    <form id="formulario" action="{{route('qr')}}" method="post">
                        @csrf
                        <input class="container form-control text-center col-md-4" type="text" autofocus placeholder="O escriba el código QR" name="code_ambi" id="code_ambi" required><br>
        
                        <div id="botones">
                            <button name="t_traza" class="btn btn-success" value="ENTRADA">Entrada</button>
                            <button name="t_traza" class="btn btn-danger" value="SALIDA">Salida</button><br>
                        </div>
                    </form>
                </div>
            </div>

            
            <!-- {{-- script de implementación de la cámara scanner QR --}} -->
            <script type="text/javascript">
                // Inicializamos una variable la cual reproduce
                // sonido al momento de captar un qr
                var sonido = new Audio('js/sonidito.mp3');

                // Mediante esta sentencia iniciamos la llamada a la cámara
                // mediante el id que esta almacenado en la etiqueta video
                // definiendole un periodo de 5 segundos para capturar un elemento
                var scanner = new Instascan.Scanner({ 
                    video: document.getElementById('previsualizacion'), 
                    scanPeriod: 5, 
                    mirror: false 
                });


                // Al llamar a nuestra cámara preguntamos si es que estas existen en el 
                // dispositivo en el cual ocupamos, por ende si es que no se registran cámaras 
                // en el dispositivo arrojará un error y una alerta al usuario
                Instascan.Camera.getCameras().then(function(cameras) {
                    if(cameras.length > 1) {
                        scanner.start(cameras[1]);     // 1 es cámara trasera
                    }else if(cameras.length > 0) {     
                        scanner.start(cameras[0]);     // 0 es cámara frontal
                    }else{
                        console.error('No se han encontrado cámaras');
                        alert('No se encontraron cámaras');
                    }
                }).catch(function(e){
                    console.error(e);
                    alert("Error:" + e);
                });

                // Ahora mediante este segmento de código reproduciremos un sonido cada vez que la cámara lee el qr
                // y escribiendolo automáticamente en el input de qr para ahorrar trabajo al usuario.
                scanner.addListener('scan', function(respuesta) {
                    sonido.play();
                    document.getElementById('code_ambi').value=respuesta; //code_ambi es el input para escribir el QR
                    navigator.vibrate(1000);
                });

            </script>
        </div>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>