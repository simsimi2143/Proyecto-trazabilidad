<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trazabilidad UCT</title>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@800&family=Roboto&display=swap" rel="stylesheet">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/html5-qrcode"></script>
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

            #code_ambi{
                height: 50px;
                width: 360px;
                margin: 0 auto;
                font-weight: bold;
                font-size: 18pt;
                position: absolute;
                top: 90%;
                left: 4px;
                right: 2px;
            }
            #botones{
                position: absolute;
                top: 105%;
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

                <div class="row justify-content-center h-25">
                    <div id="video" class="col-md-4"></div>
                    <div id="lectorqr"></div>
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

                function docReady(fn) {
                    // see if DOM is already available
                    if (document.readyState === "complete"
                    || document.readyState === "interactive") {
                        // call on next available tick
                        setTimeout(fn, 1);
                    } else {
                        document.addEventListener("DOMContentLoaded", fn);
                    }
                }

                docReady(function(){
                    var resultContainer = document.getElementById('lectorqr');
                    
                    function onScanSuccess(respuesta) {
                        sonido.play();
                        document.getElementById('code_ambi').value=respuesta; //code_ambi es el input para escribir el QR
                        navigator.vibrate(1000);
                    }
                
                    var html5QrcodeScanner = new Html5QrcodeScanner(
                        "video", { fps: 10, qrbox: 250 });
                        html5QrcodeScanner.render(onScanSuccess);
                });
            </script>
        </div>
    
        <script src="{{ asset('js/app.js') }}" type="text/js"></script>
            
    </body>
</html>